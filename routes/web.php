<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\AdminCategoryController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (Breeze or Jetstream)
require __DIR__ . '/auth.php';

// Redirect dashboard depending on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('tasks.index');
})->middleware(['auth'])->name('dashboard');

// USER ROUTES
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tasks
    Route::resource('tasks', TaskController::class);

    // Categories
    Route::resource('categories', CategoryController::class);
});

/// 🧠 Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminTaskController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [AdminTaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/{task}/edit', [AdminTaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [AdminTaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [AdminTaskController::class, 'destroy'])->name('tasks.destroy');

    // Categories
    Route::resource('categories', AdminCategoryController::class);
});

