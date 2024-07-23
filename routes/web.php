<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('showLoginForm');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/cadastro', [UserController::class, 'create'])->name('create');
Route::post('/cadastro', [UserController::class, 'store'])->name('store');

// Rotas de usuário
Route::group(['middleware' => ['auth.check']], function () {
    Route::get('/home', function() {
        return view('pages.home');
    })->name('home');

    Route::get('/desconectar', [AuthController::class, 'logout'])->name('logout');
});

