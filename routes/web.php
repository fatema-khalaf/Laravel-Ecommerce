<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;

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

//NOTE: User Route
Route::middleware([
    "auth:sanctum,web",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("/dashboard", function () {
        return view("dashboard");
    })->name("dashboard");
});

Route::get("/", [IndexController::class, "index"]);
