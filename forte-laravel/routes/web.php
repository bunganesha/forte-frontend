<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Sensors\SensorController;
use App\Http\Controllers\API\LogTableController;
use App\Http\Controllers\Resources\ReportController;
use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Dashboard\PowerController;
use App\Http\Controllers\Dashboard\CreditScoreController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\API\MQTTController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing.lp-awal');
})->name('home');

Route::get('/about', function () {
    return view('landing.lp-about');
})->name('about');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.process');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (User/Operator)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard & Main Views
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Fetch Data Routes
    Route::prefix('api')->group(function () {
        Route::get('/fetch-data', [DashboardController::class, 'fetchData'])->name('fetch.data');
        Route::get('/camera/status', [DashboardController::class, 'cameraStatus'])->name('camera.status');
        Route::get('/fetch-mqtt-data', [MQTTController::class, 'getLatestData'])->name('mqttfetch.data');
    });

    // Power Management
    Route::prefix('power')->group(function () {
        Route::get('/', [PowerController::class, 'index'])->name('power');
        Route::prefix('api')->group(function () {
            Route::get('/log-table', [PowerController::class, 'logTable']);
            Route::get('/chart-power', [PowerController::class, 'chartPower']);
            Route::get('/prediction', [PowerController::class, 'prediction']);
            Route::get('/monthly-comparison', [PowerController::class, 'monthlyComparison']);
        });
    });

    // Sensor Dashboard
    Route::get('/sensor/dashboard', [SensorController::class, 'dashboard'])->name('sensor.dashboard');

    // Map & Tables
    Route::get('/map', function () {
        return view('operator.map');
    })->name('map');

    Route::get('/table-data', [LogTableController::class, 'index'])->name('table-data');

    // Settings Pages
    Route::prefix('settings')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('settings.profile');

        Route::get('/wifi', function () {
            return view('landing.lp-setting-wifi');
        })->name('settings.wifi');

        Route::get('/controller', function () {
            return view('landing.lp-setting-controller');
        })->name('settings.controller');

        Route::get('/', function () {
            return view('landing.lp-setting');
        })->name('settings.index');
    });

    // Report Routes for Users
    Route::resource('reports', ReportController::class)
        ->only(['index', 'store']);

    // Credit Score Routes
    Route::get('/credit-score', [CreditScoreController::class, 'show'])->name('credit-score.show');
    Route::prefix('api/credit-score')->group(function () {
        Route::get('/info', [CreditScoreController::class, 'getScoreInfo'])->name('credit-score.info');
        Route::get('/history', [CreditScoreController::class, 'getHistory'])->name('credit-score.history');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES (role: admin|supervisor)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin|supervisor'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // User Management
    Route::resource('users', UserController::class)->except(['show', 'create', 'edit'])->names('admin.users');
    Route::get('/users/export', [UserController::class, 'exportCsv'])->name('admin.users.export');
    Route::post('/users/import', [UserController::class, 'importCsv'])->name('admin.users.import');

    // Role Management
    Route::resource('roles', RoleController::class)->except(['create', 'edit']);

    // Sensor Management
    Route::resource('sensors', SensorController::class);

    // Report Management & Approval
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'adminIndex'])->name('admin.reports.index');
        Route::post('/{report}/approve', [ReportController::class, 'approve'])
            ->name('reports.approve');
        Route::post('/{report}/reject', [ReportController::class, 'reject'])
            ->name('reports.reject');
    });
});
