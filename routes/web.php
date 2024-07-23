<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('showLoginForm');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/cadastro', [UserController::class, 'create'])->name('create');
Route::post('/cadastro', [UserController::class, 'store'])->name('store');

Route::prefix('categorias')->as('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/criar', [CategoryController::class, 'create'])->name('create');
    Route::post('/criar', [CategoryController::class, 'store'])->name('store');
    Route::delete('/excluir', [CategoryController::class, 'destroy'])->name('destroy');

    Route::prefix('/editar')->group(function () {
        Route::get('/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    });
});

// Rotas de usuário
Route::group(['middleware' => ['auth.check']], function () {
    Route::get('/home', function() {
        return view('pages.home');
    })->name('home');



    Route::get('/desconectar', [AuthController::class, 'logout'])->name('logout');
});

