<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel("messages.{user_receiver_id}", function ($user, $user_receiver_id) {
    Log::info("Evento", ["user" => $user, "receiver" => (int) $user_receiver_id]);
    return $user->id === (int) $user_receiver_id;
});
