<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function signUp()
    {
        return view('user.signUp');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postSignUp(SignUpRequest $request)
    {
        $validatedData = $request->validated();

        User::query()->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('login');
    }

    public function postLogin(SignInRequest $request)
    {
        $validatedData = $request->validated();

        if (!Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return redirect()->route('login');
        }
        return redirect()->route('catalog');
    }

    public function signOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function getEditProfileForm()
    {
        return view('user.editProfile');
    }

    public function postEditProfile(SignUpRequest $request) {

        $validatedData = $request->validated();

        User::query()->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('profile');
    }
}
