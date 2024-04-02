<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
/////////////////// For User /////////////////////
//register for user
public function userRegister(Request $request){
        try {
             //validation for user
   //rules
   $rules = [
    'userName' => 'required| string',
    'userEmail' =>  'required|email|unique:users,email',
    'userPhone' => 'required |  numeric',
    'userAddress' => 'required| string',
    'userPassword' => 'required |string | min:8'
];
//messages
    $messages = [
      'userName.required' => '*Please write your name...',
      'userEmail.required' => '*Please write your email...',
      'userEmail.email' => '*Please write email format...',
      'userEmail.unique' => '*Email must be unique...',
      'userPhone.required' => '*Please write your phone number...',
      'userPhone.numeric' => '*Please write only numbers...',
      'userAddress.required' => '*Please write your address...',
      'userPassword.required' => '*Please write your password...',
    ];
    //validation Method
       $validateUser =   Validator::make($request->all(),$rules,$messages);
     //if validation errors is exist,  return errors to frontend
       if($validateUser->fails()){
        return response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validateUser->errors()
        ], 401);
    }
    //user creation
    $user = User::create([
            'name' => $request->userName,
            'phone' => $request->userPhone,
            'address' => $request->userAddress,
            'email' => $request->userEmail,
            'password' =>  Hash::make($request->userPassword),
            'role' =>   $request->role
    ]);


     $token = JWTAuth::fromUser($user, ['exp' =>  now()->addYears(10)->timestamp]);
   //if user is created then respon json to frontend
   return $this->respondWithToken($token);

        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }


}

protected function respondWithToken($token)
{
    if (!$token) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to generate token',
        ], 500);
    }
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => 24 * 60,
        'user' => Auth::user()
    ]);
}


    //////////////////////// For Admin /////////////////////////////////
    //admin register page
    public function registerPage(){
        return view('admin.register');
    }
    // admin register process codes
    public function register(Request $request)
    {
        //recall function vali for validation
        $this->vali($request);
        //recall function dataArrange for data  arranging
        $data =    $this->dataArrange($request);
        //for image
           if ($request->hasFile('adminImage')) {
               //if image exists
               //keep in local storage
             $imgName = uniqid().$request->file('adminImage')->getClientOriginalName();
               $request->file('adminImage')->storeAs('public/admin', $imgName);
            //keep  in database
             $data['image'] = $imgName;
           }
        //insert to database
        User::create($data);
        return view('admin.login');
    }
   ////private function for admin register
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'name' => $request->adminName,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'email' => $request->adminEmail,
            'password' =>  Hash::make($request->adminPassword),
            'role' =>   $request->role
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'adminName' => 'required| string',
            'adminEmail' => 'required |  email  | unique:users,email',
            'adminPhone' => 'required |  numeric',
            'adminAddress' => 'required| string',
            'adminPassword' => 'required |string'
        ];

        Validator::make($request->all(), $rules)->validate();
    }
}
