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


//modul 8
use App\Http\Controllers\FileUploadController;

Route::get('/upload', [FileUploadController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [FileUploadController::class, 'storeFile'])->name('upload.store');
Route::get('/files', [FileUploadController::class, 'listFiles'])->name('files.list');
Route::delete('/files/{filename}', [FileUploadController::class, 'deleteFile'])->name('files.delete');
Route::get('/files/download/{filename}', [FileUploadController::class, 'downloadFile'])->name('files.download');
//------
use App\Http\Controllers\ScanController;

Route::get('/scankode', [ScanController::class, 'scanKode']);
// Route::post('/scan', [ScanController::class, 'processScan']);

Route::get('/scan-data-produk', fn() => view('scandataproduk'));
Route::post('/scan-produk', [ScanController::class, 'processScanProduk']);


//modul 10
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);

//module 6//------
//praktikum 1 sekaligus tugas 1
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//praktikum 2 sekaligus tugas 1
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::post('/login', [AuthController::class, 'cekLogin'])->name('cek-login');

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::get('/logout', function () {
//         Auth::logout();
//         return redirect()->route('login')->with('success', 'Anda logged out.');
//     })->name('logout');
// });
//-------

//modul 7
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [UserController::class, 'showHome'])->name('home');
    
    Route::middleware(['role:admin'])->group(function () {
        Route::get('admin', [UserController::class, 'showAdmin'])->name('admin');
    });
    
    Route::middleware(['role:owner'])->group(function () {
        Route::get('owner', [UserController::class, 'showOwner'])->name('owner');
    });
});

Route::middleware(['auth', 'check.age'])->group(function () {
    Route::get('/adult-content', function () {
        return view('adult');
    })->name('adult.content');
});