<?php

use App\Http\Controllers\CardItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefreshController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//authentication routes
Route::prefix('user')->group(function () {
    // user register route
    Route::post('/register/userRegister', [RegisterController::class, 'userRegister']);
    //user login route
    Route::post('/login/userLogin', [LoginController::class, 'userLogin']);
       //user refresh token route
       Route::post('/token/refresh', [LoginController::class, 'refreshToken']);
});

//routes before authenticated
Route::prefix('user')->group(function () {
   //user product
Route::get('/product', [ProductController::class, 'userProduct']);
//user category
Route::get('/category', [CategoryController::class, 'userCategory']);
//user category
Route::get('/category/dynamic/{id}', [CategoryController::class, 'proCatData']);
//user product detail
Route::get('/product/dynamic/{id}', [ProductController::class, 'userProductDetail']);
//user contact message
Route::post('/contact/message', [ContactMessageController::class, 'contactMessage']);
});


//routes after authenticated
Route::middleware('auth:api')->group(function () {
    //Authentication routes
    Route::prefix('user')->group(function () {
        //user logout route
        Route::post('/logout/userLogout', [LogoutController::class, 'userLogout']);
        //user profile route
        Route::get('/profile', [ProfileController::class, 'userProfile']);
        //user profile edit
        Route::post('/profile/edit', [ProfileController::class, 'userProfileEdit']);
        //user profile image edit
        Route::post('/profile/edit/image', [ProfileController::class, 'profileImage']);
        //user profile image retrive
        Route::get('/profile/edit/image/retrive/{id}', [ProfileController::class, 'profileImageGet']);
        //user profile password change
        Route::post('/profile/edit/passwordChange', [ProfileController::class, 'userPasswordChange']);
        //user cart add function
        Route::post('/product/cart/add', [CartController::class, 'AddCart']);
        //user cart data retrive
        Route::get('/product/cart/retrive', [CartController::class, 'CartData']);
        //user cart item data send
        Route::post('/product/cart/cartItem', [CardItemController::class, 'cartItem']);
        //user cart price total data send
        Route::post('/product/cart/cartItem/order/totalPrice', [OrderController::class, 'totalPrice']);
         //user cart delete
         Route::get('/product/cart/cartItem/delete', [CartController::class, 'cartDelete']);
          //user cart item delete
          Route::get('/product/cart/cartItem/items/delete/{id}', [CartController::class, 'cartItemDelete']);
    });
});
