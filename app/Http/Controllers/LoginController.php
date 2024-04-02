<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
////////////////// For User /////////////////
//user login
  public function userLogin (Request $request){
    //   logger($request->toArray());
    try {
        //validation
        $validateUser = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //if validation error is exist then response to frontend
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 422);
        }
        //if the datas in request is not exist in database or not user
        $credentials = request(['email', 'password']);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'error' => 'Unauthorized',
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }
          //if successs login
           return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  now()->addDay()->timestamp
        ]);;
    } catch (\Throwable $th) {
        //for server error or other errors
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
  }


//   public function refreshToken()
//   {
//       try {
//         //   // Extract refresh token from the request
//         //   $access_token = $request->input('access_token');

//         //   // Validate refresh token
//         //   if (!$access_token) {
//         //       return response()->json(['error' => 'Refresh token is required'], 400);
//         //   }

//           // Attempt to refresh access token
//           $newAccessToken = Auth::guard('api')->refresh();

//           // Return the new access token to the client
//           return response()->json(['access_token' => $newAccessToken], 200);
//       } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//           return response()->json(['error' => 'Refresh token expired'], 401);
//       } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//           return response()->json(['error' => 'Invalid refresh token'], 401);
//       } catch (\Throwable $th) {
//           return response()->json(['error' => $th->getMessage()], 500);
//       }
//   }

//   protected function respondWithToken($token)
//   {
//       if (!$token) {
//           return response()->json([
//               'status' => false,
//               'message' => 'Failed to generate token',
//           ], 500);
//       }
//       return response()->json([
//           'access_token' => $token,
//           'token_type' => 'bearer',
//           'expires_in' =>  now()->addDay()->timestamp,
//           'user' => Auth::user()
//       ]);
//   }

   //////////////// For Admin  //////////////////////////////
    //login
    public function loginPage(){
        return view('admin.login');
    }
    //login process codes
public function login(Request $request)
    {
        //login validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //login process
        //if login process is okay
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
                return redirect('/admin/dashboard');
            }
            //if login process is not okay
            //login error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }
}
