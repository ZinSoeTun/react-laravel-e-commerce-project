<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Admin Routes
Route::prefix('/admin')->group(function () {
    // login and register pages routes
    Route::get('/register/page', [RegisterController::class, 'registerPage'])->name('admin.register.page');
    Route::get('/login/page', [LoginController::class, 'loginPage'])->name('admin.login.page');
    //register and login  route
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});

///admin middleware
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Routes
    Route::prefix('/admin')->group(function () {

        //prevent-back url
        Route::middleware(['prevent-back-history'])->group(function () {
            // admin dashboard
            Route::get('/dashboard',[HomeController::class,'home'])->name('admin.dashboard');
            //admin profile routes
            Route::get('/profile', [ProfileController::class, 'profile'])->name('admin.profile');
            Route::post('/profile/editProfile', [ProfileController::class, 'edit'])->name('admin.profile.editProfile');
            Route::post('/profile/changePassoword', [ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');

             //admin logout route
        Route::post('/logout', [LogoutController::class, 'logout'])->name('admin.logout');

        // Category routes
        Route::prefix('/categories')->group(function () {
              // create routes
            Route::get('/create/page', [CategoryController::class, 'createCategoryPage'])->name('create.category');
            Route::post('/create', [CategoryController::class, 'createCategory'])->name('create.category.function');
             // list routes
            Route::get('/list', [CategoryController::class, 'categoryList'])->name('category.list');
            Route::get('/list/edit/page/{id}', [CategoryController::class, 'editCategoryPage'])->name('edit.category');
            Route::post('/list/edit/{id}', [CategoryController::class, 'edit'])->name('create.category.edit');
            Route::get('/list/detail/{id}', [CategoryController::class, 'detail'])->name('category.detail');
            Route::get('/list/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        });

        // product routes
        Route::prefix('/products')->group(function () {
            Route::get('/create/page', [ProductController::class, 'createProductPage'])->name('create.product');
            Route::post('/create', [ProductController::class, 'createProduct'])->name('create.product.function');
            Route::get('/list', [ProductController::class, 'productList'])->name('product.list');
            Route::get('/list/edit/page/{id}', [ProductController::class, 'editProductPage'])->name('edit.product');
            Route::post('/list/edit/{id}', [ProductController::class, 'edit'])->name('create.product.edit');
            Route::get('/list/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
            Route::get('/list/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        });

        // Account routes(User nd Admin list)
        Route::prefix('/account')->group(function () {
            // admin routes
            Route::get('/admin/list', [AccountController::class, 'adminList'])->name('account.admin.adminList');
            Route::get('/admin/list/detail/{id}', [AccountController::class, 'adminListDetail'])->name('account.admin.adminList.detail');
            Route::get('/admin/list/delete/{id}', [AccountController::class, 'adminListDelete'])->name('account.admin.adminList.delete');
            //user routes
            Route::get('/user/list', [AccountController::class, 'userList'])->name('account.admin.userList');
            Route::get('/user/list/detail/{id}', [AccountController::class, 'userListDetail'])->name('account.admin.userList.detail');
            Route::get('/user/list/delete/{id}', [AccountController::class, 'userListDelete'])->name('account.admin.userList.delete');
        });

        // contact message routes
        Route::get('/create/contact/message', [ContactMessageController::class, 'createContactMessage'])->name('create.contact.message');
        Route::get('/create/contact/detail/{id}', [ContactMessageController::class, 'messsageDetail'])->name('create.contact.message.detail');
        Route::get('/create/contact/delete/{id}', [ContactMessageController::class, 'messageDelete'])->name('create.contact.message.delete');

          // order  routes
          Route::get('/order/list', [OrderController::class, 'orderList'])->name('order.list.orderlist');
          Route::get('/order/list/detail/{id}', [OrderController::class, 'orderListDetail'])->name('order.list.orderlist.detail');
          Route::get('/order/list/delete/{id}/{userId}', [OrderController::class, 'orderListDelete'])->name('order.list.orderlist.delete');

        // room routes
        Route::prefix('/rooms')->group(function () {
            // create routes
            Route::get('/create/page', [RoomController::class, 'createRoomPage'])->name('create.room');
            Route::post('/create', [RoomController::class, 'createRoom'])->name('create.room.function');
            // list routes
            Route::get('/list', [RoomController::class, 'roomList'])->name('room.list');
            Route::get('/list/edit/page/{id}', [RoomController::class, 'editRoomPage'])->name('edit.room');
            Route::post('/list/edit/{id}', [RoomController::class, 'edit'])->name('create.room.edit');
            Route::get('/list/detail/{id}', [RoomController::class, 'detail'])->name('room.detail');
            Route::get('/list/delete/{id}', [RoomController::class, 'delete'])->name('room.delete');
        });

        // designer routes
        Route::prefix('/designers')->group(function () {
             // create routes
            Route::get('/create/page', [DesignerController::class, 'createDesignerPage'])->name('create.designer');
            Route::post('/create', [DesignerController::class, 'createDesigner'])->name('create.designer.function');
              // list routes
            Route::get('/list', [DesignerController::class, 'designerList'])->name('designer.list');
            Route::get('/list/edit/page/{id}', [DesignerController::class, 'editDesignerPage'])->name('edit.designer');
            Route::post('/list/edit/{id}', [DesignerController::class, 'edit'])->name('create.designer.edit');
            Route::get('/list/detail/{id}', [DesignerController::class, 'detail'])->name('designer.detail');
            Route::get('/list/delete/{id}', [DesignerController::class, 'delete'])->name('designer.delete');
        });
        });
    });
});
