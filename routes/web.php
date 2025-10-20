<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function() {
    return view('welcome');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Dashboard redirect
Route::get('/dashboard', function(){
    return redirect()->route('tasks.index');
})->middleware(['auth'])->name('dashboard');

// Tasks
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TaskController::class,'index'])->name('dashboard');

    // CRUD for tasks
    Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class,'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class,'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class,'destroy'])->name('tasks.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});




require __DIR__.'/auth.php';
