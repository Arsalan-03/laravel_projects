<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signUp', [\App\Http\Controllers\UserController::class, 'signUp'])->name('signUp');
Route::post('/postSignUp', [\App\Http\Controllers\UserController::class, 'postSignUp']);

Route::get('/signIn', [\App\Http\Controllers\UserController::class, 'signIn'])->name('signIn');
Route::post('/postSignIn', [\App\Http\Controllers\UserController::class, 'postSignIn']);

Route::post('/signOut', [\App\Http\Controllers\UserController::class, 'signOut'])->name('signOut');

Route::get('/catalog', [\App\Http\Controllers\ProductController::class, 'catalog'])->name('catalog');
Route::post('/postCatalog', [\App\Http\Controllers\ProductController::class, 'postCatalog']);

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/editProfile', [\App\Http\Controllers\UserController::class, 'getEditProfileForm'])->name('editProfile');
Route::post('/postEditProfile', [\App\Http\Controllers\UserController::class, 'postEditProfile']);

Route::post('/addProduct', [\App\Http\Controllers\ProductController::class, 'addProduct'])->name('addProduct');


Route::get('/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::post('/addToCart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::post('/deleteToCart', [\App\Http\Controllers\CartController::class, 'deleteToCart'])->name('deleteToCart');
