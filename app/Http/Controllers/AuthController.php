<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    function loginHandler(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, true)) {
            return back()->withErrors([
                'email' => 'Username Or Password Wrong'
            ]);
        }

        return redirect()->route('dashboard');
    }

    function registerHandler(Request $request)
    {
        $registeredUser = $request->validate([
            'email' => "required|email|unique:users",
            'password' => ['required', 'confirmed', Password::min(8)],
            'fullname' => 'required',
            'username' => 'required|unique:users',
        ]);

        $registeredUser['password'] = Hash::make($registeredUser['password']);

        $user = User::create($registeredUser);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
