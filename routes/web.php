<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // General Access
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User/Role Listing (Accessible to anyone with 'user.view' or 'role.view' permissions)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/my-activity-logs', [AnalyticsController::class, 'userLogs'])->name('logs.self');
    
    // Self Logs (Assuming you have a LogController)
});

// Admin-Only Actions (Creating, Editing, Deleting)
Route::middleware(['auth', 'admin'])->group(function () {
    // We use 'except' because 'index' is already handled above
    Route::resource('users', UserController::class)->except(['index']);
    Route::resource('roles', RoleController::class)->except(['index']);
    Route::resource('permissions', PermissionController::class);

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/admin/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
});
require __DIR__.'/auth.php';
