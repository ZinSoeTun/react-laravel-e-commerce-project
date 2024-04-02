<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;


class LogoutController extends Controller
{
    ///////////////// For User /////////////////
    public function userLogout()
    {
        logger(Auth::user());
        Auth::guard('api')->logout();
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ], 200);
    }





    //////////////// For admin //////////////////////////
    //logout process codes
    public function logout(Request $request)
    {
        //logout process
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //redirect to
        return redirect()->route('admin.login.page');
    }
}
