<?php

namespace App\Http\Controllers;

use App\Models\CardItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardItemController extends Controller
{
  //card item insert into database
  public  function cartItem(Request $request)
  {
    // logger( $request->newCartData);
    try {
      //auth user
      if (Auth::user()) {
        //then
        foreach ($request->newCartData as $data) {
          CardItem::create([
            'user_id' => Auth::user()->id,
            'product_id' => $data['product_id'],
            'qty' =>  $data['qty'],
            'total' => $data['total']
          ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Your products has ordered to your cart!',
        ], 200);
      }else {
        return response()->json([
            'status' => false,
            'message' => 'Your are not authenticated!',
        ], 401);
      }
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'status' => false,
        'message' => $th->getMessage()
    ], 500);
    }
  }
}
