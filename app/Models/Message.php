<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ["user_sender_id", "user_receiver_id", "message"];

    public function sender()
    {
        return $this->belongsTo(User::class, "user_sender_id");
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, "user_receiver_id");
    }
}
