<?php

use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
Route::get('/home', [HomeController::class, 'index']);

Route::get('/', [HelloController::class, 'index']);
Route::get('/hello/{name}', [HelloController::class, 'sayHello']);

Route::get('/welcome', [GreetingsController::class, 'welcome']);
Route::get('/hello/{name}/{npm}', [GreetingsController::class, 'greet']);

#-----
#Practicum #3
use App\Http\Controllers\PortfolioController;

Route::get('/home', [PortfolioController::class, 'home']);
Route::get('/profil', [PortfolioController::class, 'profil']);
Route::get('/pendidikan', [PortfolioController::class, 'pendidikan']);
Route::get('/keahlian', [PortfolioController::class, 'keahlian']);

// Route untuk halaman utama
Route::redirect('/', '/home');
#--------

#Practicum #5.1
use App\Http\Controllers\NilaiController; 
  
Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
#---------
#Practicum #5.2
use App\Http\Controllers\MahasiswaController; 
  
Route::resource('mahasiswa', MahasiswaController::class); 
#---------
#Practicum #task
Route::get('/nilai/{mahasiswaId}', [NilaiController::class, 'showNilaiMahasiswa'])->name('tampilnilai');
#---------
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