<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProgramApiController;
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\AiChatbotController;
use App\Http\Controllers\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes for Mobile App (Flutter) & External Integrations
|--------------------------------------------------------------------------
|
| Rute API di bawah terisolasi dari rute web biasa (routes/web.php).
| Semua rute ini akan memiliki prefix otomatis '/api'.
|
*/

Route::prefix('v1')->group(function () {

    // Authentication Routes with Rate Limiting (Max 5 attempts per minute)
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('/auth/login', [AuthController::class, 'login']);
        Route::post('/auth/register', [AuthController::class, 'register']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::get('/member/dashboard', [MemberApiController::class, 'dashboard']);
    });

    // Public API Routes with Rate Limiting (Max 60 requests per minute)
    Route::middleware('throttle:60,1')->group(function () {
        Route::get('/programs', [ProgramApiController::class, 'index']);
        Route::get('/programs/{identifier}', [ProgramApiController::class, 'show']);
        Route::get('/member/demo-dashboard', [MemberApiController::class, 'dashboard']);
        
        // AI Chatbot Handoff Endpoint for Flutter
        Route::post('/chatbot', [AiChatbotController::class, 'ask']);
        
        // Promo Voucher & Lead Pendaftaran Endpoint
        Route::post('/check-promo', [LeadController::class, 'checkPromo']);
        Route::post('/register-lead', [LeadController::class, 'storeRegistration']);
    });
});
