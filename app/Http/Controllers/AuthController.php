<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function cekLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Login successful.');
        }

        return redirect()
            ->route('login')
            ->with('error', 'Login failed. Periksa Username/Password.');
    }
}