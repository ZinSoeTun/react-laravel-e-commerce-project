<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //admin list
    public function adminList()
    {
        $admin = User::where('role', 'admin')->get();
        return view('admin.adminList', compact('admin'));
    }
    //admin list detail
    public function adminListDetail($id)
    {
        $adminDetail = User::where('id', $id)->first();
        return view('admin.adminListDetail', compact('adminDetail'));
    }
    //admin list delete
    public function adminListDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['success' => ' The admin you choiced Has Been Deleted!']);
    }

    //user list
    public function userList()
    {
        $user = User::where('role', 'user')->get();
        return view('admin.userList', compact('user'));
    }
    //user list detail
    public function userListDetail($id)
    {
        $userDetail = User::where('id', $id)->first();
        return view('admin.userListDetail', compact('userDetail'));
    }
    //user list delete
    public function userListDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['success' => ' The user you choiced Has Been Deleted!']);
    }
}
