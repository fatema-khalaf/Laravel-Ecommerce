<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
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
    })->name("dashboard");
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
