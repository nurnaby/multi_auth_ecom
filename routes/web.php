<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;

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
    return view('frontend.index');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfielStore'])->name('user.protfolio.store');
    Route::get('/user/logut', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    // Route::post('/user/password/update',[UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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

    //vendor Active Inactive All Route
    Route::get('/inactive/vendor',[AdminController::class, 'InactiveVendor'])->name('inactive.vendor');
    Route::get('/active/vendor',[AdminController::class, 'ActiveVendor'])->name('Active.vendor');
    Route::get('/inactive/vendor/{id}',[AdminController::class, 'InactiveVendorDetail'])->name('inactive.vendor.detail');
    Route::get('/active/vendor/{id}',[AdminController::class, 'ActiveVendorDetail'])->name('active.vendor.detail');
    Route::post('/inactive/vendor/approve',[AdminController::class, 'InactiveVendorApprove'])->name('inactive.vendor.approve');
    Route::post('/active/vendor/approve',[AdminController::class, 'ActiveVendorApprove'])->name('active.vendor.approve');

/// product route
    Route::get('/all/product',[ProductController::class, 'AllProduct'])->name('All.product');
    Route::get('/add/product',[ProductController::class, 'AddProduct'])->name('add.product');
    Route::put('/store/product',[ProductController::class, 'ProductStore'])->name('product.store');
    // Route::get('brand/status/{type}/{id}',[BrandController::class, 'BrandStatus']);
    // Route::get('/edit/brand/{id}',[BrandController::class, 'EditBrand'])->name('edit.brand');
    // Route::post('/update/brand',[BrandController::class, 'BrandUpdate'])->name('update.brand');
    // Route::get('/delete/brand/{id}',[BrandController::class, 'DeleteBrand'])->name('delete.brand');



});
  // Brand 
Route::middleware(['auth', 'role:admin'])->group(function () {

  Route::get('/all/brand',[BrandController::class, 'AllBrand'])->name('All.brand');
  Route::get('/add/brand',[BrandController::class, 'AddBrand'])->name('add.brand');
  Route::post('/store/brand',[BrandController::class, 'BrandStore'])->name('brand.store');

  Route::get('brand/status/{type}/{id}',[BrandController::class, 'BrandStatus']);

  Route::get('edit-brand/{id}',[BrandController::class, 'EditBrand'])->name('edit');
  Route::get('/edit/brand/{id}',[BrandController::class, 'EditBrand'])->name('edit.brand');
  Route::post('/update/brand',[BrandController::class, 'BrandUpdate'])->name('update.brand');
  Route::get('/delete/brand/{id}',[BrandController::class, 'DeleteBrand'])->name('delete.brand');
});

  // Category
Route::middleware(['auth', 'role:admin'])->group(function () {

  Route::get('/all/Category',[CategoryController::class, 'AllCategory'])->name('All.category');
  Route::get('/add/category',[CategoryController::class, 'AddCateogry'])->name('add.category');
  Route::put('/store/category',[CategoryController::class, 'CategoryStore'])->name('category.store');
  Route::get('category/status/{type}/{id}',[CategoryController::class, 'CategoryStatus']);
  
  Route::get('/edit/category/{id}',[CategoryController::class, 'EditCategory'])->name('edit.category');

  
  Route::post('/update/category',[CategoryController::class, 'CategoryUpdate'])->name('update.category');
  Route::get('/delete/category/{id}',[CategoryController::class, 'DeleteCategory'])->name('delete.category');
});
  // Sub Category
Route::middleware(['auth', 'role:admin'])->group(function () {

  Route::get('/all/SubCategory',[SubCategoryController::class, 'AllSubCategory'])->name('All.SubCategory');
  Route::get('/add/subcategory',[SubCategoryController::class, 'AddSubCateogry'])->name('add.subcategory');
  Route::put('/store/subcategory',[SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
  Route::get('subcategory/status/{type}/{id}',[SubCategoryController::class, 'SubCategoryStatus']);
  Route::get('/edit/brand/{id}',[SubCategoryController::class, 'EditSubCategory'])->name('edit.subcategory');
  Route::post('/update/subcategory',[SubCategoryController::class, 'SubCategoryUpdate'])->name('update.subcategory');

  Route::get('/delete/subcategory/{id}',[SubCategoryController::class, 'DeleteSubCategory'])->name('delete.subcategory');
  Route::get('/subcategory/ajax/{id}',[SubCategoryController::class, 'GetSubCategory']);


});



/// admin login route
Route::get('/admin/login',[AdminController::class, 'AdminLogin']);
// vendoer login route
Route::get('/vendor/login',[VendorController::class, 'VendorLogin'])->name('vendor.login');
Route::get('/vendor/register',[VendorController::class, 'VendorRegister'])->name('become.vendor');
Route::post('/vendor/store',[VendorController::class, 'VendorStore'])->name('vendor.store');


/// vendor dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashbord'])->name('vendor.dashbord');
    Route::get('/vendor/logout',[VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store',[VendorController::class, 'VendorProfileStore'])->name('vendor.protfolio.store');
      // chang password
      Route::get('/vendor/change/password',[VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
      Route::post('/vendor/password/update',[VendorController::class, 'VendorPasswordUpdate'])->name('vendor.password.update');
     
});



require __DIR__.'/auth.php';