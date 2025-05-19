<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return view('Selamat Datang di aplikasi laravel!');
    }
    
    public function sayHello($name)
    {
        return 'Hello, ' . $name . '!';
    }
}
