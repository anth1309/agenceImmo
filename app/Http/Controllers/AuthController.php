<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }
        return redirect()->route('blog.auth.login')->withErrors(['email' => "L'email ou le mot de passe est incorrect"])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('blog.auth.login');
    }
}
