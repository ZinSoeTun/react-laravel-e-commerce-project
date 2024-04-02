<?php

namespace App\Http\Controllers;

use App\Models\CardItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    ///////////// User Codes ///////////////////
    //card item insert into database
    public  function totalPrice(Request $request)
    {
        // logger($request->subTotal);
        // logger($request->productTotalPrice);
        // logger(Auth::user());
        try {
            //auth user
            if (Auth::user()) {
                //then
                Order::create([
                    'user_id' => Auth::user()->id,
                    'subTotal' => $request->productTotalPrice,
                    'productPrice_shipping' => $request->subTotal
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Your products has ordered to your cart!',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Your are not authenticated!',
                ], 401);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'hello something went wrongs',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    ///////////// Admin Codes /////////
    //order list
    public function orderList()
    {
        $orderData = Order::paginate(4);
        return view('admin.orderList', compact('orderData'));
    }
    //order list detail
    public function orderListDetail($id)
    {
        $data = User::where('users.id', $id)
            ->select(
                'users.*',
                'orders.subTotal as allProduct_price',
                'orders.productPrice_shipping as total_price',
                'orders.id as order_id',
                'orders.created_at as orderCreated_date'
            )
            ->leftJoin('orders', 'users.id', 'orders.user_id')
            ->first();

        $item = CardItem::where('card_items.user_id', $id)->get();
        $newData = []; // Initialize an empty array

        foreach ($item as $item) {
            // Fetch product data for each card item
            $list = Product::where('products.id', $item->product_id)
                ->select('products.*', 'card_items.qty as qty', 'card_items.total as total_price')
                ->leftJoin('card_items', 'products.id', 'card_items.product_id')
                ->first(); // Use first() instead of get()

            // Add fetched product data to $data5 array
            if ($data) {
                $newData[] = $list;
            }
        }
        return view('admin.orderDetail', compact('data', 'newData'));
    }
      //order delete
      public function orderListDelete($id,$userId)
      {
           Order::where('id', $id)->delete();
           CardItem::where('user_id', $userId)->delete();
          return back();
      }
}
