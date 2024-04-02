<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Designer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //////////////////// For User /////////////////////
    public function  userProductDetail($id)
    {
        try {
            //refrive from database
            $product =  Product::find($id);
            $category = $product->category;
            $designer = $product->designer;
            //response to  frondend
            return response()->json([
                'status' => true,
                'product' => $product,
                'designer' => $designer,
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }












    //////////////////// For Admin /////////////////////
    //create product page
    public function createProductPage()
    {
        $category = Category::get();
        $designer = Designer::get();
        return view('admin.createProduct', compact('category', 'designer'));
    }

    //create product function
    public function createProduct(Request $request)
    {
        //  dd($request->toArray());
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //image for create create function
        //check for image is exist or not
        if ($request->hasFile('productImage')) {
            //get originalname from image
            $imgName = uniqid() . $request->file('productImage')->getClientOriginalName();
            //store in local storage
            $request->file('productImage')->storeAs('public/product', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //create category
        Product::create($data);
        //return back if success
        return back()->with(['success' => 'Product has been created!']);
    }

    //product list
    public function productList()
    {
        $productData = Product::paginate(5);
        return view('admin.productList', compact('productData'));
    }
    //edit category page
    public function editProductPage($id)
    {
        $productData = Product::find($id);
        $category = Category::get();
        $designer = Designer::get();
        return view('admin.productEdit', compact('productData', 'designer', 'category'));
    }
    //product update
    public function edit($id, Request $request)
    {
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //for image update function
        if ($request->hasFile('productImage')) {
            //if image is already exist in local storage
            $productImg = Category::where('id', $id)->value('image');
            //then delete
            if ($productImg != NULL) {
                //delete image from storage
                Storage::delete('public/product/' . $productImg);
            }
            //get originalname from image
            $imgName = uniqid() . $request->file('productImage')->getClientOriginalName();
            //store in local storage
            $request->file('productImage')->storeAs('public/product', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //product update in db
        Product::where('id', $id)->update($data);
        //return back if success
        return back()->with(['success' => 'Your Product Data Has Been Updated!']);
    }
    //detail product page
    public function detail($id)
    {
        $productData =  Product::find($id);
        return view('admin.productListDetail', compact('productData'));
    }
    //delete product page
    public function delete($id)
    {
        $productImg =  Product::where('id', $id)->value('image');
        if ($productImg !== Null) {
            Storage::delete('public/product/' . $productImg);
        }
        Product::where('id', $id)->delete();
        return back()->with(['success' => ' The product you choiced Has Been Deleted!']);
    }



    ////private function for admin create products
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'category_id' => $request->category,
            'designer_id' => $request->designer,
            'name' => $request->productName,
            'price' => $request->productPrice,
            'description' => $request->productDescription,
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'designer' => 'required',
            'category' => 'required',
            'productName' => 'required| string',
            'productPrice' => 'required| string',
            'productDescription' => 'required |  string',
            'productImage' => ' required | image |  mimes:png,jpg,jpeg'
        ];

        Validator::make($request->all(), $rules)->validate();
    }
}
