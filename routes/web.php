<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;

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
Route::get('/',[FrontendController::class,'FrontEndView'])->name('frontend');

// Route::get('/', function () {
//     return view('frontend.index');
// });
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
    Route::get('/edit/product/{id}',[ProductController::class, 'EditProduct'])->name('product.edit');
    Route::put('/update/product',[ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::put('/update/product/main-image',[ProductController::class, 'MainImageUpdate'])->name('product.main_img.update');
    Route::put('/update/product/multi-image',[ProductController::class, 'MultImageUpdate'])->name('product.multi_image.update');
    Route::get('/delete/product-multi-img/{id}',[ProductController::class, 'DeleteProductMultiImg'])->name('product.multi_img.delete');
    Route::get('/product/inactive/{id}',[ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/product/active/{id}',[ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/product/delete/{id}',[ProductController::class, 'ProductDelete'])->name('delete.product');
    // Route::get('brand/status/{type}/{id}',[BrandController::class, 'BrandStatus']);



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
// end category route 
// all slide route 
Route::controller(SliderController::class)->group(function(){
  Route::get('all/slider','AllSlider')->name('all.slider');

  Route::get('/add/slider','AddSlider')->name('add.slider');
  Route::put('/store/slider','SliderStore')->name('slider.store');
  Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
  Route::put('/slider/updat','SliderUpdate')->name('slider.update');
  Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
});
// end slider route 
// all banner route 
Route::controller(BannerController::class)->group(function(){
  Route::get('all/banner','AllBanner')->name('all.banner');

  Route::get('/add/banner','AddBanner')->name('add.banner');
  Route::put('/store/banner','BannerStore')->name('banner.store');
  Route::get('/edit/banner/{id}','EditBanner')->name('edit.banner');
  Route::put('/banner/updat','BannerUpdate')->name('banner.update');
  Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
});

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
Route::get('/admin/login',[AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
// vendoer login route
Route::get('/vendor/login',[VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/register',[VendorController::class, 'VendorRegister'])->name('become.vendor');

Route::post('/vendor/store',[VendorController::class, 'VendorStore'])->name('vendor.store');


/// vendor dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {

    Route::controller(VendorProductController::class)->group(function(){
      Route::get('vendor/all/product','VendorAllProduct')->name('vendor.all.product');
      Route::get('vendor/add/product','VendorAddProduct')->name('vendor.add.product');
      Route::put('/vendor/product/store','vendor_product_store')->name('vendor.product.store');
      Route::get('/vendor/product/edit/{id}','vendorProductEdit')->name('vendor.product.edit');
      Route::put('/vendor/product/update','VendorProductUpdate')->name('vendor.product.update');
      Route::put('/vendor/product/main','VendorProductMainimgUpdate')->name('vendor.product.main_img.update');
      Route::put('/vendor/product/multi-image','VendorProductMultiimgUpdate')->name('vendor.product.multi_image.update');
      Route::get('/vendor/product/multi-image/{id}','VendorProductMultiimgDelete')->name('vendor.product.multi_img.delete');
      Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
      Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
      Route::get('/vendor/product/delete/{id}', 'VendorProductDelete')->name('delete.vendor.product');

    });
    Route::get('/vendor/subcategory/ajax/{id}',[VendorProductController::class, 'GetVendorSubCategory']);

    Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashbord'])->name('vendor.dashbord');
    Route::get('/vendor/logout',[VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store',[VendorController::class, 'VendorProfileStore'])->name('vendor.protfolio.store');
      // chang password
      Route::get('/vendor/change/password',[VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
      Route::post('/vendor/password/update',[VendorController::class, 'VendorPasswordUpdate'])->name('vendor.password.update');
     
});

/// Frontend Product Details All Route

Route::get('product/details/{id}/{slug}',[IndexController::class, 'ProductDetails']);
//vendor details route
Route::get('vendor/details/{id}',[IndexController::class, 'VendorDetails'])->name('vendor.details');
//vendor list route
Route::get('vendor/list',[IndexController::class, 'VendorList'])->name('vendor.all');
// catwies product 
Route::get('product/category/{id}/{slug}',[IndexController::class, 'CatwidseProduct']);
// Subcatwies product 
Route::get('product/subcateogry/{id}/{slug}',[IndexController::class, 'SubCatwidseProduct']);
//product view modal with ajax
Route::get('/product/view/modal/{id}',[IndexController::class, 'ProductViewAjax']);
// mini cart 
Route::get('/product/mini/cart',[CartController::class, 'minicartViewAjax']);
//add cart with ajax

// Route::controller(SliderController::class)->group(function(){
// Route::controller(CartController::class)->gorup(function(){

// });
Route::get('load-cart-data',[CartController::class, 'cartloadbyajax']);
Route::post('add-to-cart',[CartController::class, 'AddTocart']);
Route::post('update-to-cart',[CartController::class, 'UpdateCart']);
Route::DELETE('delete-from-cart',[CartController::class, 'DeleteCart']);
Route::get('cart',[CartController::class, 'index']);








require __DIR__.'/auth.php';