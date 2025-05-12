<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ["address", "city", "zip_code", "phone", "admission_date", "salary"];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
