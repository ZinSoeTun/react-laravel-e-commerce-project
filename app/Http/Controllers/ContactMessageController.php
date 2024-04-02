<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{


    /////////////////// For User /////////////////////
    //contact message
    public function contactMessage(Request $request)
    {
        logger($request->toArray());
        try {
            //rules
            $rules = [
                'firstName' => 'required| string',
                'surName' =>  'required| string',
                'emailAddress' => 'required | email',
                'country' => 'required| string'
            ];
            //validation Method
            $validateUserContact =   Validator::make($request->all(), $rules);
            //if validation errors is exist,  return errors to frontend
            if ($validateUserContact->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUserContact->errors()
                ], 422);
            }
            //user creation
             contactMessage::create([
                'firstName' => $request->firstName,
                'surName' => $request->surName,
                'email' => $request->emailAddress,
                'phone' => $request->phone,
                'streetAddress' =>  $request->streetAddress,
                'orderNumber' =>   $request->orderNumber,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'city' => $request->city,
                'message' => $request->message
            ]);

            //if contact message is created then respon json to frontend
            return response()->json([
                'status' => true,
                'message' => 'Contact Message has been created!'
            ], 200);
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    ///////////  for Admin //////////////////
    //contact message
    public function createContactMessage()
    {
       $message = ContactMessage::paginate(4);
        return view('admin.contactMessage', compact('message'));
    }
     //contact message
     public function messsageDetail($id)
     {
        $mesDetail = ContactMessage::where('id',$id)->first();
        // dd($mesDetail->toArray());
         return view('admin.contactMessageDetail', compact('mesDetail'));
     }
      //contact message
    public function messageDelete($id)
    {
         ContactMessage::where('id',$id)->delete();
        return back();
    }
}
