<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController; 
use App\Models\User;

// Route::get("/", function () {
//     return view("welcome");
// });

//NOTE: Admin Route
Route::group(
    ["prefix" => "admin", "middleware" => ["admin:admin"]],
    function () {
        Route::get("/login", [AdminController::class, "loginForm"]);
        Route::post("/login", [AdminController::class, "store"])->name(
            "admin.login"
        );
    }
);

Route::get("/admin/logout", [AdminController::class, "destroy"])->name("admin.logout");

Route::middleware(['auth:admin'])->group(function(){

// View profile
Route::get("/admin/profile", [
    AdminProfileController::class,
    "AdminProfile",
])->name("admin.profile");
// View Edit profile
Route::get("/admin/profile/edit", [
    AdminProfileController::class,
    "AdminProfileEdit",
])->name("admin.profile.edit");

// Store Edit profile data
Route::post("/admin/profile/edit", [
    AdminProfileController::class,
    "AdminProfileStore",
])->name("admin.profile.store");

// View Change admin password 
Route::get("/admin/change/password", [
    AdminProfileController::class,
    "AdminChangePassword",
    ])->name("admin.change.password");
    
// Store new password    
Route::post("/update/change/password", [
    AdminProfileController::class,
    "AdminUpdateChangePassword",
])->name("update.change.password");

// Login Admin
Route::middleware([
    "auth:sanctum,admin",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("admin/dashboard", function () {
        return view("admin.index");
    })->name("dashboard")->middleware('auth:admin');
});
});
// Note: Brands All routes
Route::prefix('brand')->group(function(){
    // View All Brands
    Route::get("/view", [BrandController::class, "BrandView"])->name('all.brands');
    // Add new brand
    Route::post("/store", [BrandController::class, "BrandStore"])->name('brand.store');
    // View Edit brand
    Route::get("/edit/{id}", [BrandController::class, "BrandEdite"])->name('brand.edit');
    // Store updated data
    Route::post("/update", [BrandController::class, "BrandUpdate"])->name('brand.update');
    // Delete brand
    Route::get("/delete/{id}", [BrandController::class, "BrandDelete"])->name('brand.delete');
});

// Note: Categories All routes
Route::prefix('category')->group(function(){
    // View all Catigories
    Route::get('/view', [CategoryController::class , 'CatigoryView'])->name('all.categories');
    // Add new category
    Route::post("/store", [CategoryController::class, "CategoryStore"])->name('category.store');
    // View Edit category
    Route::get("/edit/{id}", [CategoryController::class, "CategoryEdite"])->name('category.edit');
    // Store updated data
    Route::post("/update", [CategoryController::class, "CategoryUpdate"])->name('category.update');
    // Delete category
    Route::get("/delete/{id}", [CategoryController::class, "CategoryDelete"])->name('category.delete');
    
//Subcategories All routes

    // View all subcatigories
    Route::get('/sub/view', [SubcategoryController::class , 'SubcatigoryView'])->name('all.subcategories');
    // Add new subcategory
    Route::post("/sub/store", [SubcategoryController::class, "SubcategoryStore"])->name('subcategory.store');
    // View Edit subcategory
    Route::get("/sub/edit/{id}", [SubcategoryController::class, "SubcategoryEdite"])->name('subcategory.edit');
    // Store updated data
    Route::post("/sub/update", [SubcategoryController::class, "SubcategoryUpdate"])->name('subcategory.update');
    // Delete subcategory
    Route::get("/sub/delete/{id}", [SubcategoryController::class, "SubcategoryDelete"])->name('subcategory.delete');
    
//Sub Subcategories All routes

    // View all sub-subcatigories
    Route::get('/sub/sub/view', [SubcategoryController::class , 'SubSubcatigoryView'])->name('all.subsubcategories');
    //Note: ajax route
    Route::get('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    // Add new sub-subcategory
    Route::post("/sub/sub/store", [SubcategoryController::class, "SubSubcategoryStore"])->name('subsubcategory.store');
    // View Edit sub-subcategory
    Route::get("/sub/sub/edit/{id}", [SubcategoryController::class, "SubSubcategoryEdite"])->name('subsubcategory.edit');
    // Store updated data
    Route::post("/sub/sub/update", [SubcategoryController::class, "SubSubcategoryUpdate"])->name('subsubcategory.update');
    // Delete sub-subcategory
    Route::get("/sub/sub/delete/{id}", [SubcategoryController::class, "SubSubcategoryDelete"])->name('subsubcategory.delete');
});

// Note: Products All routes
Route::prefix('product')->group(function(){

    // View add Product page
    Route::get('/add', [ProductController::class , 'AddProduct'])->name('add.product');
    // Add new Product
    Route::post("/store", [ProductController::class, "ProductStore"])->name('product.store');
    // View all Products
    Route::get('/view', [ProductController::class , 'ProductView'])->name('all.products');
    // View Edit product
    Route::get("/edit/{id}", [ProductController::class, "ProductEdite"])->name('product.edit');
    // Store updated data
    Route::post("/update", [ProductController::class, "ProductUpdate"])->name('product.update');
    // Store updated multi images
    Route::post("/image/update", [ProductController::class, "MultiImageUpdate"])->name('product.image.update');
    // Store updated thumbnail image
    Route::post("/thambnail/update", [ProductController::class, "ThambnailImageUpdate"])->name('product.thambnail.update');
    // Delete image from multi images
    Route::get('/image/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiImg.delete');
    // Activate product
    Route::get('/activate/product/{id}', [ProductController::class, 'ActivateProduct'])->name('product.activate');
    // Inactivate product
    Route::get('/inactivate/product/{id}', [ProductController::class, 'InactivateProduct'])->name('product.inactivate');
    // Delete product
    Route::get("/delete/{id}", [ProductController::class, "ProductDelete"])->name('product.delete');
});


// Note: Slider All routes
Route::prefix('slider')->group(function(){
    // View All Sliders
    Route::get("/view", [SliderController::class, "SliderView"])->name('all.sliders');
    // Add new slider
    Route::post("/store", [SliderController::class, "SliderStore"])->name('slider.store');
    // View Edit slider
    Route::get("/edit/{id}", [SliderController::class, "SliderEdite"])->name('slider.edit');
    // Store updated data
    Route::post("/update", [SliderController::class, "SliderUpdate"])->name('slider.update');
    // Delete slider
    Route::get("/delete/{id}", [SliderController::class, "SliderDelete"])->name('slider.delete');
    // Activate slider
    Route::get('/activate/slider/{id}', [SliderController::class, 'SliderActivate'])->name('slider.activate');
    // Inactivate slider
    Route::get('/inactivate/slider/{id}', [SliderController::class, 'SliderInactivate'])->name('slider.inactivate');
});

//NOTE: User Route 
//View user account
Route::middleware([
    "auth:sanctum,web",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("/dashboard", function () {
        $id= Auth::user()->id;
        $user = User::find($id);
        return view("dashboard",compact('user'));
    })->name("dashboard");
});
// View Home page
Route::get("/", [IndexController::class, "index"]);
// Log out user
Route::get("/user/logout", [IndexController::class, "UserLogout"])->name('user.logout');
// View user profile
Route::get("/user/profile", [IndexController::class, "UserProfile"])->name('user.profile');
// Store updated user data
Route::post("/user/profile/store", [IndexController::class, "UserProfileStore"])->name('user.profile.store');
// View Change passwrod
Route::get("/user/change/password", [IndexController::class, "UserChangePassword"])->name('change.password');
// Store new password
Route::post("/user/password/update", [IndexController::class, "UserUpdateChangePassword"])->name('user.password.update');

//  ============================================== FRONT END : ROUTES ============================================== -->

//NOTE: Multi language Routes

Route::get("/english/language", [LanguageController::class, "English"])->name('english.language');
Route::get("/arabic/language", [LanguageController::class, "Arabic"])->name('arabic.language');
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']); 
