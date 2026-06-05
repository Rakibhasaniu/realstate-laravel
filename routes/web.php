<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/login', function () {
    return view('admin.login');
})->name('login');
Route::get('/register', function () {
    return 'Register page coming soon';
})->name('register');
