<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');
        Route::post('register', 'register');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
});
