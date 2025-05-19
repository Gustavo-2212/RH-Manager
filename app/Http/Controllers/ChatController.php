<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        Auth::user()->canAny(["admin", "rh", "colaborator"]) ?: abort(403, "Você não tem permissão");

        $users = User::with("sent_messages", "received_messages")->where("id", "<>", Auth::user()->id)->get();

        return view("chat.home", ["users" => $users]);
    }

    public function get_chat($target_id)
    {
        Auth::user()->canAny(["admin", "rh", "colaborator"]) ?: abort(403, "Você não tem permissão");

        $auth_id = Auth::user()->id;

        $messages = Message::withoutTrashed()->where( function($query) use ($auth_id, $target_id) {
            $query->where("user_sender_id", $auth_id)
                  ->where("user_receiver_id", $target_id);
        })->orWhere( function($query) use ($auth_id, $target_id) {
            $query->where("user_sender_id", $target_id)
                  ->where("user_receiver_id", $auth_id);
        })->orderBy("created_at", "asc")->limit(5)->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        Auth::user()->canAny(["admin", "colaborator", "rh"]) ?: abort(403, "Você não tem permissão");

        $request->validate([
            "target_id" => ["required", "exists:users,id"],
            "message" => ["required", "string", "max:1000"]
        ]);

        $message = Message::create([
            "user_sender_id" => Auth::user()->id,
            "user_receiver_id" => (int) $request["target_id"],
            "message" => $request["message"]
        ]);

        MessageEvent::dispatch($message);

        return response()->json([
            "message" => $message->message,
            "created_at" => $message->created_at,
            "user_sender_id" => $message->user_sender_id,
            "user_receiver_id" => $message->user_receiver_id
        ]);
    }
}
