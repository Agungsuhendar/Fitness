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

use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'tentang'])->name('tentang');
Route::get('/fitness-{slug}', [PageController::class, 'areaLanding'])->name('area.fitness');
Route::get('/les-renang-{slug}', [PageController::class, 'areaLanding'])->name('area.landing');

Route::get('/sitemap.xml', function() {
    $path = public_path('sitemap.xml');
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'text/xml']);
    }
    
    $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $xml .= '<url><loc>' . url('/') . '</loc><priority>1.0</priority></url>';
    $xml .= '<url><loc>' . url('/tentang-kami') . '</loc><priority>0.8</priority></url>';
    $xml .= '<url><loc>' . url('/lokasi') . '</loc><priority>0.8</priority></url>';
    $xml .= '<url><loc>' . url('/harga') . '</loc><priority>0.8</priority></url>';
    $xml .= '<url><loc>' . url('/faq') . '</loc><priority>0.7</priority></url>';
    $xml .= '<url><loc>' . url('/kontak') . '</loc><priority>0.7</priority></url>';
    
    $areas = ['sleman', 'bantul', 'ugm', 'kota-jogja', 'kulon-progo'];
    foreach ($areas as $areaSlug) {
        $xml .= '<url><loc>' . url('/les-renang-' . $areaSlug) . '</loc><priority>0.9</priority></url>';
    }
    
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'text/xml']);
});

Route::get('/clear-cache', function() {
    $dir = storage_path('framework/views');
    $count = 0;
    if (is_dir($dir)) {
        foreach (glob($dir . '/*') as $file) {
            if (is_file($file) && basename($file) !== '.gitignore') {
                @unlink($file);
                $count++;
            }
        }
    }
    return "View cache cleared successfully! ({$count} compiled views removed)";
});

// Programs
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');

// Content Pages
Route::get('/lokasi', [PageController::class, 'lokasi'])->name('lokasi');
Route::get('/harga', [PageController::class, 'harga'])->name('harga');
Route::get('/testimoni', [PageController::class, 'testimoni'])->name('testimoni');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/kalkulator', [PageController::class, 'kalkulator'])->name('kalkulator');
Route::get('/quiz', [PageController::class, 'quiz'])->name('quiz');
Route::get('/member', [PageController::class, 'memberDashboard'])->name('member.dashboard');
Route::get('/pelatih', [PageController::class, 'pelatih'])->name('pelatih');
Route::get('/tulis-testimoni', [PageController::class, 'tulisTestimoni'])->name('tulis-testimoni');
Route::post('/tulis-testimoni', [PageController::class, 'storeTestimonial'])->name('testimoni.store');
Route::get('/kelas', [PageController::class, 'kelas'])->name('kelas');
Route::post('/kelas/booking', [LeadController::class, 'storeClassBooking'])->name('kelas.booking');

// Search Global
Route::get('/search', [PageController::class, 'search'])->name('search');

// Blog System
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Lead Generation Form Actions
Route::post('/daftar', [LeadController::class, 'storeRegistration'])->name('lead.register');
Route::post('/trial', [LeadController::class, 'storeTrial'])->name('lead.trial');
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimoni.store');
Route::post('/check-promo', [LeadController::class, 'checkPromo'])->name('promo.check');

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
    Route::resource('coaches', AdminCoachController::class);
    Route::resource('testimonials', AdminTestimonialController::class);
    Route::post('/testimonials/{testimonial}/toggle-approve', [AdminTestimonialController::class, 'toggleApprove'])->name('testimonials.toggle-approve');
    Route::resource('videos', AdminVideoController::class);
    Route::resource('features', AdminFeatureController::class);
    
    // Lead Entries
    Route::get('/registrations', [AdminLeadController::class, 'registrations'])->name('registrations');
    Route::get('/trials', [AdminLeadController::class, 'trials'])->name('trials');

    // Site Settings Management
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

// Admin Leads Dashboard & CSV Export Public Access
Route::get('/admin/leads', [LeadController::class, 'adminLeadsIndex'])->name('admin.leads.index');
Route::get('/admin/leads/export', [LeadController::class, 'exportCsv'])->name('admin.leads.export');
Route::post('/admin/leads/{id}/status', [LeadController::class, 'updateStatus'])->name('admin.leads.status');

// Admin Reception Check-in Kiosk
Route::get('/admin/checkin', [LeadController::class, 'adminCheckinIndex'])->name('admin.checkin.index');
Route::post('/admin/checkin/scan', [LeadController::class, 'processCheckin'])->name('admin.checkin.scan');

// E-Invoice & Admin Payment Approval Gate
Route::get('/invoice', [LeadController::class, 'showInvoice'])->name('invoice.show');
Route::get('/admin/payments', [LeadController::class, 'adminPaymentsIndex'])->name('admin.payments.index');
Route::post('/admin/payments/{id}/approve', [LeadController::class, 'approvePayment'])->name('admin.payments.approve');
Route::post('/admin/payments/{id}/reject', [LeadController::class, 'rejectPayment'])->name('admin.payments.reject');
