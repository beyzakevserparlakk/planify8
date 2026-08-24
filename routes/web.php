<?php

use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EtkinlikController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// İletişim Sayfası
Route::get('/iletisim', [ContactController::class, 'index'])->name('contact');
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/iletisim', [ContactController::class, 'send'])->name('contact.send');

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

// Admin Paneli
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Etkinlikler Yönetimi
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::patch('/events/{id}/status', [AdminEventController::class, 'updateStatus'])->name('events.status');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // Slider Yönetimi
    Route::get('/sliders', [AdminSliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [AdminSliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders', [AdminSliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/{id}/edit', [AdminSliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/{id}', [AdminSliderController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{id}', [AdminSliderController::class, 'destroy'])->name('sliders.destroy');

    // Kullanıcı Yönetimi
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // İletişim Mesajları Yönetimi
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{id}/toggle-read', [AdminContactMessageController::class, 'toggleRead'])->name('messages.toggleRead');
    Route::delete('/messages/{id}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

    // İletişim & Sosyal Medya Ayarları
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
