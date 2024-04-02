<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
//////////////////// For User /////////////////////
//user category
public function  userCategory (){
    try {
      //refrive from database
   $category =  Category::get();
   //response to  frondend
   return response()->json([
           'status' => true,
           'data'=> $category
   ]);
    } catch (\Throwable $th) {
       //for server or other errors
       return response()->json([
          'status' => false,
          'message' => $th->getMessage()
      ], 500);
    }
}

//user category dynamic
public function  proCatData ($id){
    try {
      //refrive from database
   $category =  Category::find($id);
   $product = $category->product;
   //response to  frondend
   return response()->json([
           'status' => true,
           'category'=> $category,
           'product' => $product,
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
    //create category page
    public function createCategoryPage()
    {
        return view('admin.createCategory');
    }

    //create category function
    public function createCategory(Request $request)
    {
        // dd($request->toArray());
        //recall function for validation
        $this->vali($request);
        //recall function for data arrange
        $data = $this->dataArrange($request);
        //image for create create function
        //check for image is exist or not
        if ($request->hasFile('categoryImage')) {
            //get originalname from image
            $imgName = uniqid() . $request->file('categoryImage')->getClientOriginalName();
            //store in local storage
            $request->file('categoryImage')->storeAs('public/category', $imgName);
            //store in database
            $data['image'] = $imgName;
        }
        //create category
        Category::create($data);
        //return back if success
        return back()->with(['success' => 'Category has been created!']);
    }

    //category list
    public function categoryList()
    {
       $categoryData = Category::paginate(5);
        return view('admin.categoryList', compact('categoryData'));
    }
     //edit category page
     public function editCategoryPage($id)
     {
         $categoryData = Category::where('id', $id)->first();
         return view('admin.categoryEdit', compact('categoryData'));
     }
     //category update
     public function edit($id, Request $request)
     {
         //recall function for validation
         $this->vali($request);
         //recall function for data arrange
         $data = $this->dataArrange($request);
         //for image update function
         if ($request->hasFile('categoryImage')) {
             //if image is already exist in local storage
             $categoryImg = Category::where('id', $id)->value('image');
             //then delete
             if ($categoryImg != NULL) {
                 //delete image from storage
                 Storage::delete('public/category/' . $categoryImg);
             }
             //get originalname from image
             $imgName = uniqid() . $request->file('categoryImage')->getClientOriginalName();
             //store in local storage
             $request->file('categoryImage')->storeAs('public/category', $imgName);
             //store in database
             $data['image'] = $imgName;
         }
         //category update in db
         Category::where('id', $id)->update($data);
         //return back if success
         return back()->with(['success' => 'Your Category Data Has Been Updated!']);
     }
     //detail category page
     public function detail($id)
     {
         $categoryData =  Category::where('id', $id)->first();
         return view('admin.categoryDetail', compact('categoryData'));
     }
     //delete category page
     public function delete($id)
     {
         $categoryImg =  Category::where('id', $id)->value('image');
         if ($categoryImg !== Null) {
             Storage::delete('public/category/' . $categoryImg);
         }
         Category::where('id', $id)->delete();
         return back()->with(['success' => ' The category you choiced Has Been Deleted!']);
     }






    ////private function for admin create categories
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'name' => $request->categoryName,
            'description' => $request->categoryDescription,
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'categoryName' => 'required| string',
            'categoryDescription' => 'required |  string',
            'categoryImage' => ' required | image |  mimes:png,jpg,jpeg'
        ];

        Validator::make($request->all(), $rules)->validate();
    }
}
