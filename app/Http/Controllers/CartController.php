<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    ///////// For User ///////////
    //Add Cart function
    public  function AddCart(Request $request)
    {
        // // logger($request->toArray());
        // logger(Auth::user()->toArray());
        try {
            if (Auth::user()) {
                $existId =  Cart::where('product_id', $request->productId)->value('product_id');
                // logger($existId);
                if ($existId ==  $request->productId) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Your product has already existed in your cart!',
                    ], 422);
                } else {
                    //data arrange
                    $data = [
                        'user_id' => Auth::user()->id,
                        'product_id' => $request->productId
                    ];
                    //insert to database
                    Cart::create($data);
                    return response()->json([
                        'status' => true,
                        'message' => 'Your product has been added to your cart!',
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'You are not authenticated!',
                ], 401);
            }
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    //Cart data retrive from database
    public  function CartData()
    {
        logger(Auth::user());
        try {
            if (Auth::user()) {
                $data = Cart::where('carts.user_id', Auth::user()->id)
                    ->select('carts.*', 'products.image as product_image', 'products.name as product_name', 'products.price as product_price')
                    ->leftJoin('products', 'products.id', 'carts.product_id')
                    ->orderBy('id', 'desc')
                    ->get();
                return response()->json([
                    'status' => true,
                    'message' => 'cart data',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'You are not authenticated!',
                ], 401);
            }
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public  function cartDelete(Request $request)
    {
        // // logger($request->toArray());
        // logger(Auth::user()->toArray());
        try {
            if (Auth::user()) {
                Cart::where('carts.user_id', Auth::user()->id)->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Your product has been added to your cart!',
                    ], 200);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'You are not authenticated!',
                    ], 401);
                }
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public  function cartItemDelete($id)
    {
        // // logger($request->toArray());
        // logger(Auth::user()->toArray());
        try {
            if (Auth::user()) {
                Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $id)->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Your product has been deleted',
                    ], 200);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'You are not authenticated!',
                    ], 401);
                }
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
