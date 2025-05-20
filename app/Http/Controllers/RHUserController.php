<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ConfirmAccountEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RHUserController extends Controller
{
    public function index(): View
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        // $colaborators = User::where("role", "rh")->get();
        $colaborators = User::withTrashed()->with("detail")->where("role", "rh")->get();

        return view("colaborators.rh-user", ["colaborators" => $colaborators]);
    }

    public function add_colaborator(): View
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $departments = Department::all();

        return view("colaborators.add-rh-user", ["departments" => $departments]);
    }

    public function create_colaborator(Request $request): RedirectResponse
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $request->validate([
            "name" => ["required", "min:3", "max:255"],
            "email" => ["required", "email", "min:3", "max:255", "unique:users,email"],
            "select_department" => ["required", "exists:departments,id"],
            "address" => ["required", "string", "max:250"],
            "zip_code" => ["required", "string", "max:10"],
            "city" => ["required", "string", "max:50"],
            "phone" => ["required", "string", "max:50"],
            "salary" => ["required", "decimal:2"],
            "admission_date" => ["required", "date_format:Y-m-d"],
            "file_image_path" => ["image", "nullable", "max:2048"]
        ]);
        
        $user = new User();
        $user["name"] = $request["name"];
        $user["email"] = $request["email"];
        $user["confirmation_token"] = Str::random(60);
        $user["role"] = "rh";
        $user["department_id"] = $request["select_department"];
        $user["permissions"] = '["rh"]';

        if ($request->file_image_path)
        {
            $extension = $request->file("file_image_path")->getClientOriginalExtension();
            $path = $request->file_image_path->storeAs("users", "{$user->name}_" . now()->format("d_m_Y_H_i") . ".{$extension}");
            
            $user["image"] = $path;
        }

        $user->save();

        $user->detail()->create([
            "address" => $request["address"],
            "zip_code" => $request["zip_code"],
            "city" => $request["city"],
            "phone" => $request["phone"],
            "salary" => $request["salary"],
            "admission_date" => $request["admission_date"]
        ]);

        Mail::to($user["email"])->send(new ConfirmAccountEmail( route("confirm_account", $user["confirmation_token"]) ));

        return redirect()->route("rh_users")->with("success", "Colaborador adicionado com sucesso");
    }

    public function edit_rh_user($id)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $colaborator = User::with("detail")->where("role", "rh")->findOrFail($id);

        return view("colaborators.edit-rh-user", ["colaborator" => $colaborator]);
    }

    public function update_rh_user(Request $request)
    {
        $request->validate([
            "id" => ["required", "exists:users,id"],
            "salary" => ["required", "decimal:2"],
            "admission_date" => ["required", "date_format:Y-m-d"]
        ]);

        $user = User::findOrFail($request["id"]);

        $user->detail->update([
            "salary" => $request["salary"],
            "admission_date" => $request["admission_date"]
        ]);

        return redirect()->route("rh_users")->with(["success" => "Edição bem-sucedida do usuário"]);
    }

    public function delete_rh_user($id)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $colaborator = User::findOrFail($id);

        return view("colaborators.delete-rh-user", ["colaborator" => $colaborator]);
    }

    public function delete_rh_user_confirm($id)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $colaborator = User::findOrFail($id);
        $colaborator->delete();

        return redirect()->route("rh_users")->with(["success" => "Deleção de usuário bem-sucedida"]);
    }

    public function restore_rh_user($id)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $colaborator = User::withTrashed()->where("role", "rh")->findOrFail($id);
        $colaborator->restore();

        return redirect()->route("rh_users");
    }
}
