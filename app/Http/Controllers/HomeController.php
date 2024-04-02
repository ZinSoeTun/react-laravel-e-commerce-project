<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //admin dashboard
    public function home(){
        return view('admin.dashboard');
    }
}
