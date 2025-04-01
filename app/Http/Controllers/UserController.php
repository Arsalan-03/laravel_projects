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
        return redirect()->route('catalog');
    }

    public function signOut()
    {
        Auth::logout();
        return redirect()->route('signIn');
    }

    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.profile', compact('user'));
        } else {
            return redirect()->route('signIn');
        }
    }

    public function getEditProfileForm()
    {
      if (Auth::check()) {
          return view('user.editProfile');
      }  else {
          return redirect()->route('signIn');
      }
    }

    public function postEditProfile(SignUpRequest $request) {
        if (Auth::check()) {
            $validatedData = $request->validated();

            User::query()->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
        } else {
            return redirect()->route('signIn');
        }
        return redirect()->route('profile');
    }
}
