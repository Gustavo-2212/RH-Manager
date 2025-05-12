<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class ConfirmAccountController extends Controller
{
    public function confirm_account($token)
    {
        $user = User::where("confirmation_token", $token)->first();
        if (!$user) abort(403, "Token de confirmação de e-mail inválido");

        return view("auth.confirm-account", ["user" => $user]);
    }

    public function confirm_account_submit(Request $request)
    {
        $request->validate([
            "password" => ["required", "min:6", "max:16", "confirmed", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/"],
            "token" => ["required", "string", "size:60"]
        ]);

        $user = User::where("confirmation_token", $request->token)->first();
        $user->password = bcrypt($request->password);
        $user->email_verified_at = Carbon::now();
        $user->confirmation_token = null;
        $user->save();

        return view("auth.welcome", ["user" => $user]);
    }
}
