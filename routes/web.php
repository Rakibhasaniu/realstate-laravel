<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('front.about');
})->name('about');
// Route::get('/login', function () {
//     return view('admin.login');
// })->name('login');

//USER

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('user_dashboard');
    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::post('/profile_submit',[UserController::class,'profile_submit'])->name('profile_submit');
});
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'register_submit'])->name('register_submit');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
    Route::get('/forget-password', [UserController::class, 'forget_password_form'])->name('forget_password');
    Route::post('/forget-password', [UserController::class, 'forget_password'])->name('forget_password_submit');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::post('/reset-password/{token}/{email}',[UserController::class,'reset_password'])->name('reset_password');

//ADMIN
Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin_dashboard');
     Route::get('/admin_profile',[AdminController::class,'admin_profile'])->name('admin_profile');
     Route::post('/admin_profile_submit',[AdminController::class,'admin_profile_submit'])->name('admin_profile_submit');
});
Route::prefix('admin')->group(function () {
    Route::get('/',function(){
        return redirect()->route('admin_login');
    });
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password_form'])->name('admin.forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password'])->name('admin.forget_password_submit');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin_logout');
    Route::post('/reset-password/{token}/{email}',[AdminController::class,'reset_password'])->name('admin_reset_password');
});