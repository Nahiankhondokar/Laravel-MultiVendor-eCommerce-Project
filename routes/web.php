<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Amdin Group Route
Route::prefix('admin') -> group(function(){
    
    //  Admin Login Rotues
    Route::match(['get', 'post'],'/login', [AdminController::class, 'AdminLoginView']);
    // Route with "Admin" Guard
    Route::group(['middleware'=>['admin']], function(){
        //  Admin Dashboard Rotues
        Route::get('/dashboard', [AdminController::class, 'AdminDashView']);

        // Admin Update Password 
        Route::match(['get', 'post'],'/update-password', [AdminController::class, 'AdminUpdatePassword']) -> name('update.admin.password');
        Route::post('/check/current-password', [AdminController::class, 'AdminCurrentPassCheck']);

        // Admin Update Details 
        Route::match(['get', 'post'],'/update-details', [AdminController::class, 'AdminUpdateDetails'])  -> name('update.admin.details');

        // Vendor Update Details 
        Route::match(['get', 'post'],'/update-vendor-details/{slug}', [AdminController::class, 'VendorDetailsUpdate']) -> name('update.vendor.password');

        // admin / subadmin / vendor
        Route::get('/{type?}', [AdminController::class, 'AdminManagement']) -> name('admin.type');

        // single vendor view
        Route::get('/vendor/view/{id}', [AdminController::class, 'SingleVendorView']);

        // admin status update
        Route::get('/status/update/{admin_id}', [AdminController::class, 'AdminStatusUpdate']);

        //  Admin Logotu Rotues
        Route::get('/logout', [AdminController::class, 'AdminLogout']) -> name('admin.logout');
    });

});

