<?php

use App\Http\Controllers\RHUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::view("/home", "home")->name("home");

    // User routes
    Route::get("/user/profile", [ProfileController::class, "index"])->name("user.profile");
    Route::post("/user/profile/change_password", [ProfileController::class, "change_password"])->name("user.profile.change_password");
    Route::post("/user/profile/change_data", [ProfileController::class, "change_data"])->name("user.profile.change_data");

    // Department routes
    Route::get("/departments", [DepartmentController::class, "index"])->name("departments");
    Route::get("/departments/new", [DepartmentController::class, "add_department"])->name("department.add_department");
    Route::post("/departments/create", [DepartmentController::class, "create_department"])->name("department.create_department");
    Route::get("/departments/edit/{id}", [DepartmentController::class, "edit_department"])->name("department.edit_department");
    Route::post("/departments/update", [DepartmentController::class, "update_department"])->name("department.update_department");
    Route::get("/departments/delete/{id}", [DepartmentController::class, "delete_department"])->name("department.delete");
    Route::get("departments/delete_confirm/{id}", [DepartmentController::class, "delete_department_confirm"])->name("department.delete_confirm");

    // RH Colaborators routes
    Route::get("/rh_colaborators", [RHUserController::class, "index"])->name("rh_users");
    Route::get("/rh_colaborators/new", [RHUserController::class, "add_colaborator"])->name("rh_user.add_colaborator");
    Route::post("rh_colaborators/create", [RHUserController::class, "create_colaborator"])->name("rh_user.create_colaborator");
    Route::get("/rh_colaborators/edit/{id}", [RHUserController::class, "edit_rh_user"])->name("rh_user.edit_rh_user");
    Route::post("rh_colaborators/update", [RHUserController::class, "update_rh_user"])->name("rh_user.update_rh_user");
    Route::get("/rh_colaborators/delete/{id}", [RHUserController::class, "delete_rh_user"])->name("rh_user.delete");
    Route::get("rh_colaborators/delete_confirm/{id}", [RHUserController::class, "delete_rh_user_confirm"])->name("rh_user.delete_confirm");
});

Route::middleware("guest")->group(function () {
    Route::redirect("/", "login", 301);
});
