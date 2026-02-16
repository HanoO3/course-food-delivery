<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HomeController; 
use Inertia\Inertia;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('restaurant/{restaurant}', [RestaurantController::class, 'show'])
    ->name('restaurant');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__ . '/vendor.php'; 
require __DIR__ . '/customer.php'; 

