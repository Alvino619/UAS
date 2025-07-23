<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseApprovalController;

// Add this before your existing routes
Route::get('/storage/{folder}/{file}', function ($folder, $file) {
    $path = storage_path("app/public/{$folder}/{$file}");
    
    if (!file_exists($path)) {
        abort(404);
    }

    $mime = mime_content_type($path);
    return response()->file($path, ['Content-Type' => $mime]);
})->where('file', '.*');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses.index');
Route::get('/courses/{course:slug}', [HomeController::class, 'show'])->name('courses.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Course management
    Route::prefix('courses/manage')->name('courses.manage.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        
        // Route untuk materials
        Route::prefix('{course}/materials')->name('materials.')->group(function () {
            Route::post('/', [CourseController::class, 'storeMaterial'])->name('store');
            Route::delete('/{material}', [CourseController::class, 'destroyMaterial'])->name('destroy');
        });
    });
    
    // Enrollment
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/courses/{course}/unenroll', [CourseController::class, 'unenroll'])->name('courses.unenroll');
    
    // Comments
    Route::post('/courses/{course}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin routes - menggunakan middleware langsung tanpa alias
    Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/courses/pending', [CourseApprovalController::class, 'index'])->name('courses.pending');
        Route::post('/courses/{course}/approve', [CourseApprovalController::class, 'approve'])->name('courses.approve');
        Route::post('/courses/{course}/reject', [CourseApprovalController::class, 'reject'])->name('courses.reject');
    });
});