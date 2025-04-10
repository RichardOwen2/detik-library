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

Route::controller(LoginController::class)->group(function () {
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');
        Route::post('register', 'register');
    });
});

Route::middleware('auth')->group(function () {
    Route::middleware('not_role:admin,admin.books.index')->group(function () {
        Route::prefix('category')->group(function () {
            Route::controller(User\CategoryController::class)->group(function () {
                Route::get('/', 'index')->name('categories.index');
                Route::post('/', 'store')->name('categories.store');
                Route::post('/{id}', 'update')->name('categories.update');
                Route::delete('/{id}', 'destroy')->name('categories.destroy');

                Route::get('/datatable', 'datatable')->name('categories.datatable');
            });
        });

        Route::controller(User\BookController::class)->group(function () {
            Route::get('/', 'index')->name('books.index');
            Route::post('/', 'store')->name('books.store');
            Route::get('/book/{id}', 'show')->name('books.show');
            Route::post('/book/{id}', 'update')->name('books.update');
            Route::delete('/book/{id}', 'destroy')->name('books.destroy');
            Route::get('/export', 'export')->name('books.export');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::prefix('category')->group(function () {
                Route::controller(Admin\CategoryController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.categories.index');
                    Route::post('/', 'store')->name('admin.categories.store');
                    Route::post('/{id}', 'update')->name('admin.categories.update');
                    Route::delete('/{id}', 'destroy')->name('admin.categories.destroy');

                    Route::get('/datatable', 'datatable')->name('admin.categories.datatable');
                });
            });

            Route::controller(Admin\BookController::class)->group(function () {
                Route::get('/', 'index')->name('admin.books.index');
                Route::post('/', 'store')->name('admin.books.store');
                Route::get('/book/{id}', 'show')->name('admin.books.show');
                Route::post('/book/{id}', 'update')->name('admin.books.update');
                Route::delete('/book/{id}', 'destroy')->name('admin.books.destroy');
                Route::get('/export', 'export')->name('admin.books.export');
            });
        });
    });
});
