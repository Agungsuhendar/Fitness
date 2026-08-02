<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminLeadController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'tentang'])->name('tentang');

// Programs
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');

// Content Pages
Route::get('/lokasi', [PageController::class, 'lokasi'])->name('lokasi');
Route::get('/harga', [PageController::class, 'harga'])->name('harga');
Route::get('/testimoni', [PageController::class, 'testimoni'])->name('testimoni');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Search Global
Route::get('/search', [PageController::class, 'search'])->name('search');

// Blog System
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Lead Generation Form Actions
Route::post('/daftar', [LeadController::class, 'storeRegistration'])->name('lead.register');
Route::post('/trial', [LeadController::class, 'storeTrial'])->name('lead.trial');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return redirect()->route(Illuminate\Support\Facades\Auth::check() ? 'admin.dashboard' : 'admin.login');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Management
    Route::resource('programs', AdminProgramController::class);
    Route::resource('faqs', AdminFaqController::class);
    Route::resource('posts', AdminPostController::class);
    
    // Lead Entries
    Route::get('/registrations', [AdminLeadController::class, 'registrations'])->name('registrations');
    Route::get('/trials', [AdminLeadController::class, 'trials'])->name('trials');
});
