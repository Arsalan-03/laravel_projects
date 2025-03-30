<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{

    public function signUp()
    {
        return view('user.signUp');
    }

    public function signIn()
    {
        return view('user.signIn');
    }

    public function postSignUp(SignUpRequest $request)
    {
        $validatedData = $request->validated();

        User::query()->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('signIn');
    }

    public function postSignIn(SignInRequest $request)
    {
        $validatedData = $request->validated();

        if (!Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return redirect()->route('signIn');
        }
        session('user_id', Auth::id());
        return redirect()->route('signUp');
    }
}
