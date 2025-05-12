<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function index(): View
    {
        // if(Gate::denies("admin")) abort(403, "Você não tem permissão");
        // OU
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $departments = Department::all();

        return view("department.departments", ["departments" => $departments]);
    }

    public function add_department(): View
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");
        return view("department.add-department");
    }

    public function create_department(Request $request)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $request->validate([
            "name" => ["required", "min:3", "max:255", "unique:departments,name"]
        ]);

        Department::create([
            "name" => $request["name"]
        ]);

        return redirect()->route("departments");
    }

    public function edit_department($id): View | RedirectResponse
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        if(intval($id) <= 2) return redirect()->route("departments");

        $department = Department::findOrFail($id);

        return view("department.edit-department", ["department" => $department]);
    }

    public function update_department(Request $request)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $request->validate([
            "id" => ["required"],
            "name" => ["required", "min:3", "max:255", "unique:departments,name," . $request["id"]]
        ]);

        if(intval($request["id"]) <= 2) return redirect()->route("departments");

        $department = Department::findOrFail($request["id"]);

        $department["name"] = $request["name"];
        $department->save();

        return redirect()->route("departments");
    }

    public function delete_department($id): View | RedirectResponse
    {
        Auth::user()->can("admin") ?: abort("Você não tem permissão");

        if(intval($id) <= 2) return redirect()->route("departments");

        $department = Department::findOrFail($id);

        return view("department.delete-department", ["department" => $department]);
    }

    public function delete_department_confirm($id): RedirectResponse
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        if(intval($id) <= 2) return redirect()->route("departments");

        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route("departments");
    }
}
