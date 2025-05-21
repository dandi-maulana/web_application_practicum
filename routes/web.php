<?php

use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HelloController::class, 'index']);
Route::get('/hello/{name}', [HelloController::class, 'sayHello']);

Route::get('/welcome', [GreetingsController::class, 'welcome']);
Route::get('/hello/{name}/{npm}', [GreetingsController::class, 'greet']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return 'Selamat Datang Di Aplikasi Laravel';
});

Route::get('/hello/{name}', function ($name) {
    return 'Hello, ' . $name . '!';
});


Route::get('/hello/{name}/{npm}', function ($name , $npm) {
    return 'Hello, ' . $name . ' ' . $npm . '!';
});