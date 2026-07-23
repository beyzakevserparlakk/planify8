<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EtkinlikController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Etkinlikler
Route::get('/etkinlikler', [EtkinlikController::class, 'index'])->name('etkinlikler.index');
Route::get('/etkinlikler/create', [EtkinlikController::class, 'create'])->name('etkinlikler.create')->middleware('auth');
Route::post('/etkinlikler', [EtkinlikController::class, 'store'])->name('etkinlikler.store')->middleware('auth');
Route::get('/etkinlikler/{slug}', [EtkinlikController::class, 'show'])->name('etkinlikler.show');
