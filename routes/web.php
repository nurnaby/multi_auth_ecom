<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;

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
/// admin dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashbord');

    Route::get('/admin/logout',[AdminController::class, 'AdminDestroy'])->name('admin.logout');

    Route::get('/admin/profile',[AdminController::class, 'Admin_profile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class, 'Admin_profile_store'])->name('admin.protfolio.store');
    // chang password
    Route::get('/admin/change/password',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update',[AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');


});
/// admin login route
Route::get('/admin/login',[AdminController::class, 'AdminLogin']);
// vendoer login route
Route::get('/vendor/login',[VendorController::class, 'VendorLogin']);


/// vendor dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashbord'])->name('vendor.dashbord');
    Route::get('/vendor/logout',[VendorController::class, 'VendorDestroy'])->name('vendor.logout');
});



require __DIR__.'/auth.php';