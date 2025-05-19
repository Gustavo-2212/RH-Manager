<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $data = [];

        $data["total_colaborators"] = User::withoutTrashed()->count();
        $data["total_colaborators_deleted"] = User::onlyTrashed()->count();
        $data["total_salary"] = User::withoutTrashed()->with("detail")->get()->sum( fn($colaborator) => $colaborator->detail->salary );
        $data["total_salary"] = "R$ ". number_format($data["total_salary"], 2, ',', '.');

        $data["total_colaborators_by_department"] = User::withoutTrashed()->with("department")
                                                                          ->get()
                                                                          ->groupBy("department_id")
                                                                          ->map( fn($department) => [
                                                                            "department" => $department->first()->department->name ?? "Sem departamento",
                                                                            "total" => $department->count()
                                                                          ]);

        $data["total_salary_by_department"] = User::withoutTrashed()->with("detail", "department")
                                                                    ->get()
                                                                    ->groupBy("department_id")
                                                                    ->map( fn($department) => [
                                                                        "department" => $department->first()->department->name ?? "Sem departamento",
                                                                        "total" => $department->sum( fn($colaborator) => $colaborator->detail->salary )
                                                                    ]);
        $data["total_salary_by_department"] = $data["total_salary_by_department"]->map( fn($department) => [
            "department" => $department["department"],
            "total" => "R$ " . number_format($department["total"], 2, ',', '.')
        ]);

        return view("home", ["data" => $data]);
    }
}
