<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signUp', [\App\Http\Controllers\UserController::class, 'signUp'])->name('signUp');
Route::post('/postSignUp', [\App\Http\Controllers\UserController::class, 'postSignUp']);

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/postLogin', [\App\Http\Controllers\UserController::class, 'postLogin']);

Route::post('/signOut', [\App\Http\Controllers\UserController::class, 'signOut'])->name('signOut');

Route::get('/catalog', [\App\Http\Controllers\ProductController::class, 'catalog'])->name('catalog');
Route::post('/postCatalog', [\App\Http\Controllers\ProductController::class, 'postCatalog']);

Route::middleware('auth')->get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::middleware('auth')->get('/editProfile', [\App\Http\Controllers\UserController::class, 'getEditProfileForm'])->name('editProfile');
Route::post('/postEditProfile', [\App\Http\Controllers\UserController::class, 'postEditProfile']);

Route::middleware('auth')->post('/addProduct', [\App\Http\Controllers\ProductController::class, 'addProduct'])->name('addProduct');

Route::middleware('auth')->get('/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::middleware('auth')->post('/addToCart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::middleware('auth')->post('/deleteToCart', [\App\Http\Controllers\CartController::class, 'deleteToCart'])->name('deleteToCart');
