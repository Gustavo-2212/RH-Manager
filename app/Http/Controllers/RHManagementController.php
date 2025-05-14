<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RHManagementController extends Controller
{
    public function index()
    {
        Auth::user()->can("rh") ?: abort(403, "Você não tem permissão");

        $colaborators = User::with("detail", "department")->where("role", "<>", "admin")
                                                          ->where("role", "<>", "rh")
                                                          ->withTrashed()
                                                          ->get();

        return view("colaborators.colaborators", ["colaborators" => $colaborators]);
    }

    public function add_colaborator()
    {
        Auth::user()->can("rh") ?: abort(403, "Você não tem permissão");

        $departments = Department::where("id", ">", 2)->get();

        if ($departments->count() === 0) abort(403, "Nenhum departamento cadastrado. Entre em contato com o administrador");

        return view("colaborators.add-colaborator", ["departments" => $departments]);
    }

    public function create_colaborator(Request $request)
    {
        Auth::user()->can("rh") ?: abort(403, "Você não tem permissão");

        $request->validate([
            "name" => ["required", "min:3", "max:255"],
            "email" => ["required", "email", "min:3", "max:255", "unique:users,email"],
            "select_department" => ["required", "exists:departments,id"],
            "address" => ["required", "string", "max:250"],
            "zip_code" => ["required", "string", "max:10"],
            "city" => ["required", "string", "max:50"],
            "phone" => ["required", "string", "max:50"],
            "salary" => ["required", "decimal:2"],
            "admission_date" => ["required", "date_format:Y-m-d"]
        ]);

        $user = new User();

        $user["name"] = $request["name"];
        $user["email"] = $request["email"];
        $user["permissions"] = "[]";
        $user["role"] = "colaborator";
        $user["department_id"] = $request["select_department"];
        $user["confirmation_token"] = Str::random(60);

        $user->save();

        $user->detail()->create([
            "address" => $request["address"],
            "zip_code" => $request["zip_code"],
            "city" => $request["city"],
            "phone" => $request["phone"],
            "salary" => $request["salary"],
            "admission_date" => $request["admission_date"]
        ]);

        Mail::to($user["email"])->send(new ConfirmAccountEmail( route("confirm_account", ["token" => $user["confirmation_token"]]) ));

        return redirect()->route("rh_user.management.colaborators")->with(["success" => "Colaborador criado com sucesso"]);
    }
}
