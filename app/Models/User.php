<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{

    protected $fillable = ["name", "email", "profile", "role"];

    use Notifiable; // Para receber emails
    use SoftDeletes;

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sent_messages()
    {
        return $this->hasMany(Message::class, "user_sender_id");
    }

    public function received_messages()
    {
        return $this->hasMany(Message::class, "user_receiver_id");
    }
}
