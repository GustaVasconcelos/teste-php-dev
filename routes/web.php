<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\SubCategory\SubCategoryController;
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

    Route::prefix('/produtos')->as('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/criar', [ProductController::class, 'create'])->name('create');
        Route::post('/criar', [ProductController::class, 'store'])->name('store');
        Route::delete('/excluir', [ProductController::class, 'destroy'])->name('destroy');

        Route::prefix('/editar')->group(function () {
            Route::get('/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        });
    });
    Route::prefix('categorias')->as('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/criar', [CategoryController::class, 'create'])->name('create');
        Route::post('/criar', [CategoryController::class, 'store'])->name('store');
        Route::delete('/excluir', [CategoryController::class, 'destroy'])->name('destroy');
    
        Route::prefix('/editar')->group(function () {
            Route::get('/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
        });
    
        Route::prefix('/subcategorias')->as('subcategories.')->group(function () {
            Route::get('/filtrar/{id}', [SubCategoryController::class, 'getByCategoryId'])->name('filter');
            Route::get('/{id}', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/criar/{id}', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/criar/{id}', [SubCategoryController::class, 'store'])->name('store');
            Route::delete('/excluir', [SubCategoryController::class, 'destroy'])->name('destroy');
        
            Route::prefix('/editar')->group(function () {
                Route::get('/{categoryId}/{id}', [SubCategoryController::class, 'edit'])->name('edit');
                Route::put('/{categoryId}/{id}', [SubCategoryController::class, 'update'])->name('update');
            });
        });
    });

    Route::get('/desconectar', [AuthController::class, 'logout'])->name('logout');
});

