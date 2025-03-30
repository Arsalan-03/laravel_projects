<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signUp', [\App\Http\Controllers\AuthController::class, 'signUp'])->name('signUp');
Route::post('/postSignUp', [\App\Http\Controllers\AuthController::class, 'postSignUp']);

Route::get('/signIn', [\App\Http\Controllers\AuthController::class, 'signIn'])->name('signIn');
Route::post('/postSignIn', [\App\Http\Controllers\AuthController::class, 'postSignIn']);
