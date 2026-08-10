<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProgramApiController;
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\AiChatbotController;
use App\Http\Controllers\LeadController;

use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\WorkoutLogApiController;
use App\Http\Controllers\Api\NutritionLogApiController;
use App\Http\Controllers\Api\LeaderboardApiController;
use App\Http\Controllers\Api\BranchApiController;
use App\Http\Controllers\Api\TutorialApiController;
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\Api\MembershipPlanApiController;
use App\Http\Controllers\Api\TrainingProgramApiController;
use App\Http\Controllers\Api\StaffAttendanceApiController;

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

    // Authentication Routes
    Route::middleware('throttle:60,1')->group(function () {
        Route::post('/auth/login', [AuthController::class, 'login']);
        Route::post('/auth/register', [AuthController::class, 'register']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::get('/member/dashboard', [MemberApiController::class, 'dashboard']);
        
        // Member Booking Endpoints (Authenticated)
        Route::get('/bookings', [BookingApiController::class, 'index']);
        Route::post('/bookings', [BookingApiController::class, 'store']);

        // Member Payment & Transaction Endpoints
        Route::post('/payments/checkout', [PaymentApiController::class, 'checkout']);
        Route::post('/payments/simulate/{orderId}', [PaymentApiController::class, 'simulate']);
        Route::get('/payments/history', [PaymentApiController::class, 'history']);

        // Member Workout Tracker & Rest Timer Logs
        Route::get('/workout-logs', [WorkoutLogApiController::class, 'index']);
        Route::post('/workout-logs', [WorkoutLogApiController::class, 'store']);

        // Member Nutrition & AI Meal Scanner Logs
        Route::get('/nutrition-logs', [NutritionLogApiController::class, 'index']);
        Route::post('/nutrition-logs', [NutritionLogApiController::class, 'store']);

        // Member Leaderboard XP & Rewards
        Route::get('/leaderboard', [LeaderboardApiController::class, 'index']);
        Route::post('/leaderboard/redeem', [LeaderboardApiController::class, 'redeem']);

        // Member Branch Locator & Live Crowd Meter
        Route::get('/branches', [BranchApiController::class, 'index']);

        // Member Video Tutorial & Form Guide
        Route::get('/tutorials', [TutorialApiController::class, 'index']);

        // Member Notification & Reminders Center
        Route::get('/notifications', [NotificationApiController::class, 'index']);
        Route::post('/notifications/mark-read', [NotificationApiController::class, 'markRead']);

        // Member Flexible Membership Plans Catalog
        Route::get('/membership-plans', [MembershipPlanApiController::class, 'index']);

        // Member Enterprise Training Programs & Progress Tracking
        Route::get('/training/exercises', [TrainingProgramApiController::class, 'exercises']);
        Route::get('/training/program-templates', [TrainingProgramApiController::class, 'templates']);
        Route::get('/training/my-program', [TrainingProgramApiController::class, 'myProgram']);
        Route::post('/training/workout-sessions/start', [TrainingProgramApiController::class, 'startSession']);
        Route::post('/training/workout-sessions/complete', [TrainingProgramApiController::class, 'completeSession']);
        Route::get('/training/progress', [TrainingProgramApiController::class, 'getProgress']);
        Route::post('/training/progress', [TrainingProgramApiController::class, 'storeProgress']);
    });

    // Public API Routes with Rate Limiting (Max 60 requests per minute)
    Route::middleware('throttle:60,1')->group(function () {
        Route::get('/programs', [ProgramApiController::class, 'index']);
        Route::get('/programs/{identifier}', [ProgramApiController::class, 'show']);
        Route::get('/member/demo-dashboard', [MemberApiController::class, 'dashboard']);
        
        // Public Booking Fallback for Mobile App / Demo
        Route::get('/bookings/public', [BookingApiController::class, 'index']);
        Route::post('/bookings', [BookingApiController::class, 'store']);
        
        // Payment Gateway Checkout & Simulation for Mobile App
        Route::post('/payments/checkout', [PaymentApiController::class, 'checkout']);
        Route::post('/payments/simulate/{orderId}', [PaymentApiController::class, 'simulate']);
        Route::get('/payments/history', [PaymentApiController::class, 'history']);

        // Workout Tracker Logs for Mobile App
        Route::get('/workout-logs', [WorkoutLogApiController::class, 'index']);
        Route::post('/workout-logs', [WorkoutLogApiController::class, 'store']);

        // Nutrition & AI Meal Scanner Logs for Mobile App
        Route::get('/nutrition-logs', [NutritionLogApiController::class, 'index']);
        Route::post('/nutrition-logs', [NutritionLogApiController::class, 'store']);

        // Leaderboard XP & Rewards for Mobile App
        Route::get('/leaderboard', [LeaderboardApiController::class, 'index']);
        Route::post('/leaderboard/redeem', [LeaderboardApiController::class, 'redeem']);

        // Branch Locator & Live Crowd Meter for Mobile App
        Route::get('/branches', [BranchApiController::class, 'index']);

        // Video Tutorial & Form Guide for Mobile App
        Route::get('/tutorials', [TutorialApiController::class, 'index']);

        // Notification & Reminders Center for Mobile App
        Route::get('/notifications', [NotificationApiController::class, 'index']);
        Route::post('/notifications/mark-read', [NotificationApiController::class, 'markRead']);

        // Flexible Membership Plans Catalog for Mobile App
        Route::get('/membership-plans', [MembershipPlanApiController::class, 'index']);

        // Enterprise Training Programs & Progress Tracking for Mobile App / Demo
        Route::get('/training/exercises', [TrainingProgramApiController::class, 'exercises']);
        Route::get('/training/program-templates', [TrainingProgramApiController::class, 'templates']);
        Route::get('/training/my-program', [TrainingProgramApiController::class, 'myProgram']);
        Route::post('/training/workout-sessions/start', [TrainingProgramApiController::class, 'startSession']);
        Route::post('/training/workout-sessions/complete', [TrainingProgramApiController::class, 'completeSession']);
        Route::get('/training/progress', [TrainingProgramApiController::class, 'getProgress']);
        Route::post('/training/progress', [TrainingProgramApiController::class, 'storeProgress']);

        // Flutter Mobile HR Professional Staff Attendance Endpoints (Face AI & Geofencing GPS)
        Route::prefix('staff')->group(function () {
            Route::post('/clock-in', [StaffAttendanceApiController::class, 'clockIn']);
            Route::post('/clock-out', [StaffAttendanceApiController::class, 'clockOut']);
            Route::get('/shift-today', [StaffAttendanceApiController::class, 'todayShift']);
            Route::get('/attendance-history', [StaffAttendanceApiController::class, 'history']);
        });

        // AI Chatbot Handoff Endpoint for Flutter
        Route::post('/chatbot', [AiChatbotController::class, 'ask']);
        
        // Promo Voucher & Lead Pendaftaran Endpoint
        Route::post('/check-promo', [LeadController::class, 'checkPromo']);
        Route::post('/register-lead', [LeadController::class, 'storeRegistration']);
    });
});
