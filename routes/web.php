<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;
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
    Route::middleware('not_role:admin')->group(function () {
        Route::prefix('category')->group(function () {
            Route::controller(User\CategoryController::class)->group(function () {
                Route::get('/', 'index')->name('categories.index');
                Route::post('/', 'store')->name('categories.store');
                Route::put('/{id}', 'update')->name('categories.update');
                Route::delete('/{id}', 'destroy')->name('categories.destroy');
            });
        });

        Route::controller(User\BookController::class)->group(function () {
            Route::get('/', 'index')->name('books.index');
            Route::post('/', 'store')->name('books.store');
            Route::get('/{id}', 'show')->name('books.show');
            Route::put('/{id}', 'update')->name('books.update');
            Route::delete('/{id}', 'destroy')->name('books.destroy');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::prefix('category')->group(function () {
                Route::controller(Admin\CategoryController::class)->group(function () {
                    Route::get('/', 'index')->name('categories.index');
                    Route::post('/', 'store')->name('categories.store');
                    Route::put('/{id}', 'update')->name('categories.update');
                    Route::delete('/{id}', 'destroy')->name('categories.destroy');
                });
            });

            Route::controller(Admin\BookController::class)->group(function () {
                Route::get('/', 'index')->name('books.index');
                Route::post('/', 'store')->name('books.store');
                Route::get('/{id}', 'show')->name('books.show');
                Route::put('/{id}', 'update')->name('books.update');
                Route::delete('/{id}', 'destroy')->name('books.destroy');
            });
        });
    });
});
