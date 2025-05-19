<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $colaborator = User::with("detail", "department")->findOrFail(auth()->user()->id);

        return view("user.profile", ["colaborator" => $colaborator]);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            "current_password" => ["required", "min:8", "max:16"],
            "new_password" => ["required", "min:8", "max:16", "different:current_password"],
            "new_password_confirmation" => ["required", "same:new_password"]
        ]);

        $user = auth()->user();

        if (!password_verify($request["current_password"], $user["password"]))
            return redirect()->back()->with(["error" => "Senha atual incorreta"]);

        $user["password"] = bcrypt($request["new_password"]);
        $user->save();

        return redirect()->back()->with(["success" => "Senha alterada com sucesso"]);
    }

    public function change_data(Request $request)
    {
        $request->validate([
            "name" => ["required", "min:3", "max:255"],
            "email" => ["required", "email", "max:255", "unique:users,email," . auth()->id()]
        ]);

        $user = auth()->user();
        $user["name"] = $request["name"];
        $user["email"] = $request["email"];
        $user->save();

        return redirect()->back()->with(["success_change_data" => "Dados alterados com sucesso"]);
    }

    public function change_details(Request $request)
    {
        $request->validate([
            "address" => ["required", "string", "max:250"],
            "zip_code" => ["required", "string", "max:10"],
            "city" => ["required", "string", "max:50"],
            "phone" => ["required", "string", "max:50"],
            "salary" => ["required", "decimal:2"],
            "admission_date" => ["required", "date_format:Y-m-d"]
        ]);

        $user = auth()->user();
        $user->detail->address = $request->address;
        $user->detail->zip_code = $request->zip_code;
        $user->detail->city = $request->city;
        $user->detail->phone = $request->phone;
        $user->detial->salary = $request->salary;
        $user->detail->admission_date = $request->admission_date;

        $user->detail->save();

        return redirect()->back()->with(["success_change_details" => "Dados alterados com sucesso"]);
    }
}
