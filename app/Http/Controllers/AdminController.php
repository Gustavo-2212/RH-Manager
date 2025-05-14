<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        Auth::user()->can("admin") ?: abort(403, "Você não tem permissão");

        return view("home");
    }
}
