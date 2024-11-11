<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('signup', [AuthController::class, "Auth_index"])->name('Auth.index');
Route::post('signup', [AuthController::class, "signup"])->name('signup');
Route::post('login', [AuthController::class, "login"])->name('login');
Route::view('login', 'auth.signup_login');

// Admin Routes (Custom Guard)
Route::get('admin/login', [AdminController::class, "admin_login"])->name('admin.login');
Route::post('admin/login', [AdminController::class, "login"])->name('admin.login');

// Protected Routes for Regular Users
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'app.index')->name('app.index');
    Route::view('user/index', 'user.index')->name('user.index');
    Route::get('logout', [AuthController::class, "logout"])->name('User.logout');

});

// Protected Routes for Admin Users (Custom Guard)
// Route::middleware(['auth:admin'])->group(function () {
//     Route::view('dashboard', 'app.index')->name('app.index');
//     // Route::view('admin/dashboard', 'admin.index')->name('admin.index');
//     Route::get('admin/logout', [AdminController::class, "admin_logout"])->name('admin.logout');
// });




