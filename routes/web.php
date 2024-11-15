<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
//Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
}); */
