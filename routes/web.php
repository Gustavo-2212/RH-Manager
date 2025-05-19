<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RHUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\RHManagementController;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::redirect("/", "home");

    Route::get("home", function () {
        if (auth()->user()->role === "admin")   return redirect()->route("admin.home");
        elseif (auth()->user()->role === "rh")  return redirect()->route("rh_user.management.colaborators");
        else                                    return redirect()->route("colaborator");
    })->name("home");

    // User routes
    Route::get("/user/profile", [ProfileController::class, "index"])->name("user.profile");
    Route::post("/user/profile/change_password", [ProfileController::class, "change_password"])->name("user.profile.change_password");
    Route::post("/user/profile/change_data", [ProfileController::class, "change_data"])->name("user.profile.change_data");
    Route::post("/user/profile/change_details", [ProfileController::class, "change_details"])->name("user.profile.change_details");

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
    Route::get("rh_colaborators/restore/{id}", [RHUserController::class, "restore_rh_user"])->name("rh_user.restore");

    Route::get("rh_colaborators/management/home", [RHManagementController::class, "index"])->name("rh_user.management.colaborators");
    Route::get("rh_colaborators/management/new", [RHManagementController::class, "add_colaborator"])->name("rh_user.management.add_colaborator");
    Route::post("rh_colaborators/management/create", [RHManagementController::class, "create_colaborator"])->name("rh_user.management.create_colaborator");
    Route::get("rh_colaborators/management/edit/{id}", [RHManagementController::class, "edit_colaborator"])->name("rh_user.management.edit_colaborator");
    Route::post("rh_colaborators/management/update", [RHManagementController::class, "update_colaborator"])->name("rh_user.management.update_colaborator");
    Route::get("rh_colaborators/management/details/{id}", [RHManagementController::class, "show_details"])->name("rh_user.management.detail");
    Route::get("rh_colaborators/management/delete/{id}", [RHManagementController::class, "delete_colaborator"])->name("rh_user.management.delete");
    Route::get("rh_colaborators/management/delete_confirm/{id}", [RHManagementController::class, "delete_colaborator_confirm"])->name("rh_user.management.delete_confirm");
    Route::get("rh_colaborators/management/restore/{id}", [RHManagementController::class, "restore_colaborator"])->name("rh_user.management.restore");

    // Colaborators routes
    Route::get("/colaborator", [ColaboratorsController::class, "home"])->name("colaborator");
    Route::get("/colaborators", [ColaboratorsController::class, "index"])->name("colaborators");
    Route::get("/colaborators/details/{id}", [ColaboratorsController::class, "show_details"])->name("colaborator.detail");
    Route::get("/colaborators/delete/{id}", [ColaboratorsController::class, "delete_colaborator"])->name("colaborator.delete");
    Route::get("/colaborators/delete_confirm/{id}", [ColaboratorsController::class, "delete_colaborator_confirm"])->name("colaborator.delete_confirm");
    Route::get("/colaborators/restore/{id}", [ColaboratorsController::class, "restore_colaborator"])->name("colaborator.restore");

    // Admin routes
    Route::get("admin/home", [AdminController::class, "index"])->name("admin.home");

    // Chat Routes
    Route::get("chat", [ChatController::class, "index"])->name("chat");
    Route::get("chat/{target_id}", [ChatController::class, "get_chat"])->name("chat.messages");
    Route::post("chat/send", [ChatController::class, "send"])->name("chat.send");
});

Route::middleware("guest")->group(function () {
    Route::redirect("/", "login", 301);

    // E-mail confirm account rotes
    Route::get("/confirm_account/{token}", [ConfirmAccountController::class, "confirm_account"])->name("confirm_account");
    Route::post("/confirm_account", [ConfirmAccountController::class, "confirm_account_submit"])->name("confirm_account_submit");
});

Broadcast::routes(["middleware" => ["auth"]]);
