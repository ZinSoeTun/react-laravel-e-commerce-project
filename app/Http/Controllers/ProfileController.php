<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /////////////////// For User //////////////
    public function userProfile()
    {
        try {
             //user data retrive
        $data = Auth::user();
        logger($data);
        //response user data
        return response()->json([
            'status' => true,
            'user' =>   $data
        ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => true,
                'message' =>   $th->getMessage()
            ],500);
        }
    }
    //user edit function
    public  function userProfileEdit(Request $request)
    {
        try {
            //validation for user
            //rules
            $rules = [
                'userName' => 'required| string',
                'userPhone' => 'required |  numeric',
                'userAddress' => 'required| string',
            ];

            //validation Method
            $validateUser =   Validator::make($request->all(), $rules);
            //if validation errors is exist,  return errors to frontend
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            //recall function dataArrange for data  arranging
            $data =    [
                'name' => $request->userName,
                'phone' => $request->userPhone,
                'address' => $request->userAddress,
            ];
            //for image
            if ($request->hasFile('userImg')) {
                //if exist delete in local storage
                $dbImage =   User::where('id', Auth::user()->id)->value('image');
                if ($dbImage == !NULL) {
                    Storage::delete('public/profile/' . $dbImage);
                }
                //for data update
                $imgName = uniqid() . $request->file('userImg')->getClientOriginalName();
                //image save in local storage
                $request->file('userImg')->storeAs('public/profile/', $imgName);
                //image save in database
                $data['image'] = $imgName;
            }
            //updata to database
            User::where('id', Auth::user()->id)->update($data);
            //if user is created then respon json to frontend
            return response()->json([
                'status' => true,
                'message' => 'User  has been updated!',
            ], 200);
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    //for user profile image edit function
    public function profileImage(Request $request)
    {
        try {
            //for image
            $dbImage = User::where('id', Auth::user()->id)->value('image');
            if ($dbImage != NULL) {
                //delete image from storage
                Storage::delete('public/user/profile/' . $dbImage);
            }
            $imgName = uniqid() . $request->file('file')->getClientOriginalName();
            //store in public
            $request->file('file')->storeAs('public/user/profile/', $imgName);
            //store in database
            User::where('id', Auth::user()->id)->update([
                'image' => $imgName
            ]);
            //if user is created then respon json to frontend
            return response()->json([
                'status' => true,
                'message' => 'User image has been updated!',
            ], 200);
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    //profile image retrive function
    public function profileImageGet()
    {
        try {
            //retrive image from database if condition is  true
            $userImg =  User::where('id', Auth::user()->id)->value('image');
            //response to frondend
            return response()->json([
                'status' => true,
                'data' => $userImg
            ], 200);
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    //user profile password change function
    public function userPasswordChange(Request $request)
    {
        try {
            //validation for user
            //rules
            $rules = [
                'oldPassword' => 'required',
                'newPassword' => 'required | min:6 |different:oldPassword',
                'comfirmPassword' => 'required |same:newPassword',
            ];

            //validation Method
            $validateUserPassword =   Validator::make($request->all(), $rules);
            //if validation errors is exist,  return errors to frontend
            if ($validateUserPassword->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation password error',
                    'errors' => $validateUserPassword->errors()
                ], 401);
            }
            //password is correct or not check process
            //retrive from password that equal  login user from database
            $userData = User::where('id', Auth::user()->id)->first();
            $userPassword = $userData->password;
            //password check for old and database password
            if (Hash::check($request->oldPassword, $userPassword)) {
                $newPassword = Hash::make($request->newPassword);
                //passoword update
                User::where('id', Auth::user()->id)->update(['password' => $newPassword]);
                //response to frondend
                return response()->json([
                    'status' => true,
                    'message' => 'your password has been uptaded!',
                ], 200);
            } else {
                //response to frondend
                return response()->json([
                    'status' => false,
                    'message' => 'Old password do not match',
                ], 404);
            };
        } catch (\Throwable $th) {
            //for server or other errors
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }















    //////////////////////////// For Admin ///////////////////////////
    //admin profile page
    public function profile()
    {
        return view('admin.profile');
    }
    //admin profile edit process codes
    public function edit(Request $request)
    {
        //recall function vali for validation
        $this->vali($request);
        //recall function dataArrange for data  arranging
        $data =    $this->dataArrange($request);
        //for image
        //if image is already existed in local storage
        if ($request->hasFile('image')) {
            //retrive from database that equal id
            $existImg =  User::where('id', Auth::user()->id)->value('image');
            if ($existImg !== Null) {
                //if exist then delete in local storage
                Storage::delete('public/admin/' . $existImg);
            }
            //keep in local storage
            $imgName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/admin', $imgName);
            //keep  in database
            $data['image'] = $imgName;
        }
        //updata to database
        User::where('id', Auth::user()->id)->update($data);
        return back()->with(['success' => 'Your Profile has been updated!']);
    }
    //admin password change
    public function changePassword(Request $request)
    {
        //callback function for validation
        $this->passwordVali($request);
        //password is correct or not check process
        //retrive from password that equal  login user from database
        $userData = User::where('id', Auth::user()->id)->first();
        $userPassword = $userData->password;
        //password check for old and database password
        if (Hash::check($request->oldPassword, $userPassword)) {
            $newPassword = Hash::make($request->newPassword);
            //passoword update
            User::where('id', Auth::user()->id)->update(['password' => $newPassword]);
            //if success return to login page
            Auth::guard('web')->logout();
            return redirect()->route('admin.login.page');
        } else {
            //if not success
            return back()->with(['error' => 'Old password do not match']);
        };
    }








    ////private function for admin profile
    //private function for data arrange
    private function dataArrange($request)
    {
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
    //private function for validation edit
    private function vali($request)
    {
        $rules = [
            'name' => 'required| string',
            'phone' => 'required |  numeric',
            'address' => 'required| string',
        ];

        Validator::make($request->all(), $rules)->validate();
    }
    //private function for password validation
    private function passwordVali($request)
    {
        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required | min:6 |different:oldPassword',
            'comfirmPassword' => 'required |same:newPassword',
        ];
        Validator::make($request->all(), $rules)->validate();
    }
}
