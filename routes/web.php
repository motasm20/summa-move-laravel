<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPerformanceController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\AdminUserController;

Route::middleware([ 
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin' // Zorg ervoor dat alleen admins toegang hebben tot de admin routes
])->group(function () {
    Route::resource('admin/exercises', AdminController::class)->names('admin.exercises');
    Route::resource('admin/performances', AdminPerformanceController::class)->names('admin.performances');
    Route::resource('admin/users', AdminUserController::class)->names('admin.users');

});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin', // Zorg ervoor dat alleen admins toegang hebben tot de dashboard route
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
