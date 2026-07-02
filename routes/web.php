<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/contato', [HomeController::class, 'contato'])->name('contato');

// Route::get('users',[UserController::class,'index'])->middleware(['auth', 'verified'])
// ->name('users.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    /**
     * Rotas do usuário
     */
    Route::get('users',[UserController::class,'index'])->name('users.index');   
    Route::get('users/edit/{user}',[UserController::class,'show'])->name('users.show');   
    Route::get('users/show/{user}',[UserController::class,'show'])->name('users.show');   
    
});

require __DIR__.'/settings.php';
