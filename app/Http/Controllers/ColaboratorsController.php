<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ColaboratorsController extends Controller
{
    public function index()
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");
        $colaborators = User::withTrashed()->with("detail", "department")->where("role", "<>", "admin")->get();

        return view("colaborators.admin-all-colaborators", ["colaborators" => $colaborators]);
    }

    public function show_details($id)
    {
        Auth::user()->can("admin", "rh") ?: abort(403, "Você não tem permiss]ao");

        if(Auth::user()->id === $id) return redirect()->route("home");

        // $colaborator = User::with("detail", "department")->where("id", $id)->first();
        // if(!$colaborator) abort(404);
        $colaborator = User::with("detail", "department")->findOrFail($id);

        return view("colaborators.show-details", ["colaborator" => $colaborator]);
    }

    public function delete_colaborator($id)
    {
        Auth::user()->can("admin", "rh") ?: abort(403, "Você não tem permissão");

        if(Auth::user()->id === $id) return redirect()->route("home");

        $colaborator = User::findOrFail($id);

        return view("colaborators.delete-colaborator-confirm", ["colaborator" => $colaborator]);
    }

    public function delete_colaborator_confirm($id)
    {
        Auth::user()->can("admin", "rh") ?: abort(403, "Você não tem permissão");

        if(Auth::user()->id === $id) return redirect()->route("home");

        $colaborator = User::findOrFail($id);
        $colaborator->delete();

        return redirect()->route("colaborators");
    }

    public function restore_colaborator($id)
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        $colaborator = User::withTrashed()->where("role", "<>", "admin")->findOrFail($id);
        $colaborator->restore();

        return redirect()->route("colaborators");
    }

    public function home()
    {
        Auth::user()->can("colaborator") ?: abort(403, "Você não tem permissão");

        $colaborator = User::with("detail", "department")->where("id", Auth::user()->id)->first();

        return view("colaborators.show-details", ["colaborator" => $colaborator]);
    }
}
