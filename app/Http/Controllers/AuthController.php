<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }
        
        return Inertia::render('Auth/Login', [
            'errors' => [
                'email' => 'These credentials do not match our records.'
            ]
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
