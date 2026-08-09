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
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminIntegrationController;
use App\Http\Controllers\Admin\AdminPosController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPromoController;
use App\Http\Controllers\Admin\AdminWaBroadcastController;
use App\Http\Controllers\Admin\AdminClassController;
use App\Http\Controllers\Admin\AdminInventoryLogController;
use App\Http\Controllers\Admin\AdminAiToolsController;
use App\Http\Controllers\Admin\AdminAiForecastingController;
use App\Http\Controllers\Admin\AdminPurchaseOrderController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\AiPlannerController;
use App\Http\Controllers\AiChatbotController;
use App\Http\Controllers\PaymentController;

Route::get('/test-qris-api', [PaymentController::class, 'testQrisApi']);
Route::get('/debug-ipaymu-check', function(\Illuminate\Http\Request $request) {
    $va = \App\Models\Setting::get('ipaymu_va', '0000002447990145');
    $apiKey = \App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
    $isProduction = \App\Models\Setting::get('ipaymu_is_production', '0') === '1';
    $baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';

    $id = strtoupper(trim($request->input('id', 'FL-MBR-0020')));
    $user = \App\Models\User::where('member_card_id', $id)->orWhere('id', $id)->first();
    $payment = \App\Models\Payment::where('order_id', $id)->orWhere('order_id', 'like', '%'.$id.'%')->first();

    $results = [];

    // Test 1: POST /api/v2/transaction with id / referenceId / transactionId
    $payloads = [
        ['referenceId' => 'FL-MBR-0020'],
        ['transactionId' => 223514],
        ['id' => 223514],
        ['id' => 'FL-MBR-0020'],
    ];

    foreach ($payloads as $idx => $p) {
        $json = json_encode($p);
        $hash = strtolower(hash('sha256', $json));
        
        // Method A: sha256 hash body
        $sigA = hash_hmac('sha256', "POST:" . $va . ":" . $hash . ":" . $apiKey, $apiKey);
        $resA = \Illuminate\Support\Facades\Http::timeout(4)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $sigA,
            'timestamp' => date('YmdHis'),
        ])->post($baseUrl . '/api/v2/transaction', $p);

        // Method B: unhashed body string
        $sigB = hash_hmac('sha256', "POST:" . $va . ":" . $json . ":" . $apiKey, $apiKey);
        $resB = \Illuminate\Support\Facades\Http::timeout(4)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $sigB,
            'timestamp' => date('YmdHis'),
        ])->post($baseUrl . '/api/v2/transaction', $p);

        $results['payload_' . $idx] = [
            'payload' => $p,
            'sigA_status' => $resA->status(),
            'sigA_body' => $resA->json() ?: $resA->body(),
            'sigB_status' => $resB->status(),
            'sigB_body' => $resB->json() ?: $resB->body(),
        ];
    }

    return response()->json([
        'va_used' => $va,
        'is_production' => $isProduction,
        'user' => $user,
        'payment' => $payment,
        'results' => $results
    ]);
});

use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminWorkoutLogController;
use App\Http\Controllers\Admin\AdminNutritionLogController;
use App\Http\Controllers\Admin\AdminLeaderboardController;
use App\Http\Controllers\Admin\AdminBranchController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminMembershipPlanController;
use App\Http\Controllers\Admin\AdminTrainingProgramController;
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
// Member Authentication Routes
Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MemberAuthController::class, 'login']);
Route::get('/register', [MemberAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [MemberAuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [MemberAuthController::class, 'logout'])->name('logout');

Route::get('/kalkulator', [PageController::class, 'kalkulator'])->name('kalkulator');
Route::get('/quiz', [PageController::class, 'quiz'])->name('quiz');
Route::get('/member', [PageController::class, 'memberDashboard'])->name('member.dashboard');
Route::get('/member/ai-planner', [AiPlannerController::class, 'index'])->name('member.ai-planner');
Route::post('/member/ai-planner/generate', [AiPlannerController::class, 'generate'])->name('member.ai-planner.generate');
Route::get('/member/ai-coach-match', [AiPlannerController::class, 'coachMatchIndex'])->name('member.ai-coach-match');
Route::post('/member/ai-coach-match/process', [AiPlannerController::class, 'processCoachMatch'])->name('member.ai-coach-match.process');
Route::get('/member/ai-vision', [AiPlannerController::class, 'visionIndex'])->name('member.ai-vision');
Route::post('/member/ai-vision/process', [AiPlannerController::class, 'processVision'])->name('member.ai-vision.process');
Route::post('/api/ai-chatbot/ask', [AiChatbotController::class, 'ask'])->name('ai-chatbot.ask');
Route::get('/pelatih', [PageController::class, 'pelatih'])->name('pelatih');
Route::get('/tulis-testimoni', [PageController::class, 'tulisTestimoni'])->name('tulis-testimoni');
Route::post('/tulis-testimoni', [PageController::class, 'storeTestimonial'])->name('testimoni.store');
Route::get('/kelas', [PageController::class, 'kelas'])->name('kelas');
Route::post('/kelas/booking', [LeadController::class, 'storeClassBooking'])->name('kelas.booking');
Route::get('/toko', [PageController::class, 'toko'])->name('toko');
Route::post('/toko/order', [LeadController::class, 'storeOrder'])->name('toko.order');
Route::get('/virtual-tour', [PageController::class, 'virtualTour'])->name('virtual-tour');

// PWA Web Manifest Route
Route::get('/manifest.json', function () {
    $siteLogo = site_setting('site_logo', 'images/logo.png');
    $logoUrl = \Illuminate\Support\Str::startsWith($siteLogo, 'http') ? $siteLogo : url('/') . '/' . ltrim($siteLogo, '/');
    $title = site_setting('site_seo_title', 'FitLife Center Jogja - Gym & Personal Trainer');
    $shortName = site_setting('hero_title', 'FitLife Hub');
    $desc = site_setting('site_seo_description', 'Pusat fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta.');

    return response()->json([
        'id' => '/',
        'name' => $title,
        'short_name' => $shortName,
        'description' => $desc,
        'start_url' => '/',
        'scope' => '/',
        'display' => 'standalone',
        'orientation' => 'portrait',
        'background_color' => '#060907',
        'theme_color' => '#0a0f0d',
        'icons' => [
            [
                'src' => $logoUrl,
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'any maskable'
            ],
            [
                'src' => $logoUrl,
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'any maskable'
            ]
        ]
    ], 200, [
        'Content-Type' => 'application/manifest+json; charset=utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'no-cache, no-store, must-revalidate',
    ]);
});

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
Route::match(['get', 'post'], '/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Superadmin & Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
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
        Route::get('/leads', [LeadController::class, 'adminLeadsIndex'])->name('leads.index');
        Route::get('/leads/export', [LeadController::class, 'exportCsv'])->name('leads.export');
        Route::post('/leads/{id}/status', [LeadController::class, 'updateStatus'])->name('leads.status');

        // Site Settings Management
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // API Integrations (Midtrans & Wablas WA Gateway)
        Route::get('/integrations', [AdminIntegrationController::class, 'index'])->name('integrations.index');
        Route::post('/integrations', [AdminIntegrationController::class, 'update'])->name('integrations.update');
        Route::post('/integrations/test-wa', [AdminIntegrationController::class, 'testWhatsApp'])->name('integrations.test-wa');

        // Financial Reports & CSV Export
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [AdminReportController::class, 'exportCsv'])->name('reports.export');

        // User & Role RBAC Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users/staff', [AdminUserController::class, 'storeStaff'])->name('users.store-staff');
        Route::post('/users/permissions', [AdminUserController::class, 'updateMenuPermissions'])->name('users.update-permissions');
        Route::put('/users/{id}/role', [AdminUserController::class, 'updateRole'])->name('users.update-role');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Promo Codes & Voucher Management
        Route::get('/promos', [AdminPromoController::class, 'index'])->name('promos.index');
        Route::post('/promos', [AdminPromoController::class, 'store'])->name('promos.store');
        Route::delete('/promos/{id}', [AdminPromoController::class, 'destroy'])->name('promos.destroy');

        // Mass WhatsApp Broadcast Engine
        Route::get('/wa-broadcast', [AdminWaBroadcastController::class, 'index'])->name('wa-broadcast.index');
        Route::post('/wa-broadcast/send', [AdminWaBroadcastController::class, 'sendBroadcast'])->name('wa-broadcast.send');

        // Studio Group Fitness Classes Schedule
        Route::get('/classes', [AdminClassController::class, 'index'])->name('classes.index');
        Route::post('/classes', [AdminClassController::class, 'store'])->name('classes.store');
        Route::delete('/classes/{id}', [AdminClassController::class, 'destroy'])->name('classes.destroy');

        // Inventory Stock Mutation Log
        Route::get('/inventory-log', [AdminInventoryLogController::class, 'index'])->name('inventory-log.index');
        Route::post('/inventory-log/restock', [AdminInventoryLogController::class, 'storeRestock'])->name('inventory-log.restock');

        // Workout Tracker Logs & Rest Timer Activity
        Route::get('/workout-logs', [AdminWorkoutLogController::class, 'index'])->name('workout_logs.index');
        Route::delete('/workout-logs/{id}', [AdminWorkoutLogController::class, 'destroy'])->name('workout_logs.destroy');

        // Nutrition & AI Meal Scanner Logs
        Route::get('/nutrition-logs', [AdminNutritionLogController::class, 'index'])->name('nutrition_logs.index');
        Route::delete('/nutrition-logs/{id}', [AdminNutritionLogController::class, 'destroy'])->name('nutrition_logs.destroy');

        // Leaderboard XP & Rewards Admin Panel
        Route::get('/leaderboard', [AdminLeaderboardController::class, 'index'])->name('leaderboard.index');
        Route::post('/leaderboard/{id}/add-xp', [AdminLeaderboardController::class, 'addBonusXp'])->name('leaderboard.add-xp');

        // Branch Locator & Crowd Meter Management
        Route::get('/branches', [AdminBranchController::class, 'index'])->name('branches.index');
        Route::post('/branches', [AdminBranchController::class, 'store'])->name('branches.store');
        Route::post('/branches/{id}/update-crowd', [AdminBranchController::class, 'updateCrowd'])->name('branches.update-crowd');

        // Pusat Notifikasi & Push Broadcast Member
        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/send', [AdminNotificationController::class, 'sendBroadcast'])->name('notifications.send');
        Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy'])->name('notifications.destroy');

        // Kelola Paket Keanggotaan Gym Fleksibel
        Route::get('/membership-plans', [AdminMembershipPlanController::class, 'index'])->name('membership_plans.index');
        Route::post('/membership-plans', [AdminMembershipPlanController::class, 'store'])->name('membership_plans.store');
        Route::put('/membership-plans/{id}', [AdminMembershipPlanController::class, 'update'])->name('membership_plans.update');
        Route::post('/membership-plans/{id}/toggle-active', [AdminMembershipPlanController::class, 'toggleActive'])->name('membership_plans.toggle-active');
        Route::delete('/membership-plans/{id}', [AdminMembershipPlanController::class, 'destroy'])->name('membership_plans.destroy');

        // AI Member Churn Risk Predictor, AI Copywriter & AI Forecasting
        Route::get('/ai-churn', [AdminAiToolsController::class, 'churnIndex'])->name('ai-churn.index');
        Route::get('/ai-copywriter', [AdminAiToolsController::class, 'copywriterIndex'])->name('ai-copywriter.index');
        Route::post('/ai-copywriter/generate', [AdminAiToolsController::class, 'generateCopy'])->name('ai-copywriter.generate');
        Route::get('/ai-forecasting', [AdminAiForecastingController::class, 'index'])->name('ai-forecasting.index');
    });

    // 2. Member Management & Presensi Kiosk (Admin, Receptionist, Coach)
    Route::middleware(['role:admin,receptionist,coach,staff,trainer'])->group(function () {
        Route::resource('members', AdminMemberController::class);
        Route::get('/checkin', [LeadController::class, 'adminCheckinIndex'])->name('checkin.index');
        Route::post('/checkin/scan', [LeadController::class, 'processCheckin'])->name('checkin.scan');

        // Modul Training Programs & Kurikulum Latihan
        Route::get('/training-programs', [AdminTrainingProgramController::class, 'index'])->name('training_programs.index');
        Route::post('/training-programs/templates', [AdminTrainingProgramController::class, 'storeTemplate'])->name('training_programs.templates.store');
        Route::post('/training-programs/assign', [AdminTrainingProgramController::class, 'assignProgram'])->name('training_programs.assign');
        Route::delete('/training-programs/templates/{id}', [AdminTrainingProgramController::class, 'destroyTemplate'])->name('training_programs.templates.destroy');
    });

    // 3. POS Kasir & Payments Verification (Admin, Receptionist)
    Route::middleware(['role:admin,receptionist'])->group(function () {
        Route::get('/pos', [AdminPosController::class, 'index'])->name('pos.index');
        Route::get('/pos/search-members', [AdminPosController::class, 'searchMembers'])->name('pos.search-members');
        Route::post('/pos/checkout', [AdminPosController::class, 'checkout'])->name('pos.checkout');
        Route::get('/pos/check-status/{id}', [AdminPosController::class, 'checkTransactionStatus'])->name('pos.check-status');
        Route::get('/pos/receipt/{id}', [AdminPosController::class, 'showReceipt'])->name('pos.receipt');
        Route::post('/pos/verify-pin', [AdminPosController::class, 'verifyPin'])->name('pos.verify-pin');
        Route::post('/pos/open-shift', [AdminPosController::class, 'openShift'])->name('pos.open-shift');
        Route::post('/pos/close-shift', [AdminPosController::class, 'closeShift'])->name('pos.close-shift');
        Route::post('/pos/cash-movement', [AdminPosController::class, 'recordCashMovement'])->name('pos.cash-movement');
        Route::get('/pos/active-shift', [AdminPosController::class, 'getActiveShiftInfo'])->name('pos.active-shift');
        Route::get('/products', [AdminPosController::class, 'productsIndex'])->name('pos.products');
        Route::get('/products/{id}/barcode', [AdminPosController::class, 'printBarcodeLabel'])->name('products.barcode');
        Route::post('/products', [AdminPosController::class, 'storeProduct'])->name('products.store');
        Route::put('/products/{id}', [AdminPosController::class, 'updateProduct'])->name('products.update');
        Route::post('/products/{id}/opname', [AdminPosController::class, 'stockOpname'])->name('products.opname');
        Route::delete('/products/{id}', [AdminPosController::class, 'destroyProduct'])->name('products.destroy');

        // Purchase Order (PO) Supplier Routes
        Route::get('/purchase-orders', [AdminPurchaseOrderController::class, 'index'])->name('purchase-orders.index');
        Route::get('/purchase-orders/create', [AdminPurchaseOrderController::class, 'create'])->name('purchase-orders.create');
        Route::post('/purchase-orders', [AdminPurchaseOrderController::class, 'store'])->name('purchase-orders.store');
        Route::get('/purchase-orders/{id}', [AdminPurchaseOrderController::class, 'show'])->name('purchase-orders.show');
        Route::post('/purchase-orders/{id}/receive', [AdminPurchaseOrderController::class, 'receiveGoods'])->name('purchase-orders.receive');
        Route::post('/suppliers', [AdminPurchaseOrderController::class, 'storeSupplier'])->name('suppliers.store');

        Route::get('/payments', [LeadController::class, 'adminPaymentsIndex'])->name('payments.index');
        Route::post('/payments/{id}/approve', [LeadController::class, 'approvePayment'])->name('payments.approve');
        Route::post('/payments/{id}/reject', [LeadController::class, 'rejectPayment'])->name('payments.reject');
    });

});

// Member Protected Routes
Route::post('/member/progress', [PageController::class, 'updateMemberProgress'])->middleware(['auth'])->name('member.progress');
Route::post('/member/book-trainer', [PageController::class, 'bookTrainerSlot'])->middleware(['auth'])->name('member.book-trainer');

// Public E-Invoice & Payment Gateway Routes
Route::get('/invoice', [LeadController::class, 'showInvoice'])->name('invoice.show');
Route::post('/payment/snap-token', [PaymentController::class, 'createSnapToken'])->name('payment.snap');
Route::post('/api/midtrans/webhook', [PaymentController::class, 'handleWebhook'])->name('payment.webhook')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/api/ipaymu/webhook', [PaymentController::class, 'handleIpaymuWebhook'])->name('payment.ipaymu.webhook')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/payment/simulate-success/{orderId}', [PaymentController::class, 'simulatePaymentSuccess'])->name('payment.simulate')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/payment/simulate-pending/{orderId}', [PaymentController::class, 'simulatePaymentPending'])->name('payment.simulate-pending')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/api/payment-status', [PaymentController::class, 'checkStatus'])->name('payment.check-status');
