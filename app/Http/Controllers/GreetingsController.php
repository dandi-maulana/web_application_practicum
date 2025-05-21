<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingsController extends Controller
{
    public function welcome()
    {
        return 'Selamat Datang di aplikasi laravel!';
    }
    
    public function greet($name, $npm)
    {
        return 'Hello, ' . $name . ' ' . $npm .'!';
    }
}
