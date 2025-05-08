<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::view("/home", "home")->name("home");
    Route::get("/user/profile", [ProfileController::class, "index"])->name("user.profile");
    Route::post("/user/profile/change_password", [ProfileController::class, "change_password"])->name("user.profile.change_password");
    Route::post("/user/profile/change_data", [ProfileController::class, "change_data"])->name("user.profile.change_data");
});

Route::middleware("guest")->group(function () {
    Route::redirect("/", "login", 301);
});
