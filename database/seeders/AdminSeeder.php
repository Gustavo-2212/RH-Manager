<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "department_id" => 1,
            "name" => "admin",
            "email" => "admin@mangnt.com",
            "email_verified_at" => Carbon::now(),
            "password" => bcrypt("1234"),
            "role" => "admin",
            "permissions" => '["admin"]',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("user_details")->insert([
            "user_id" => 1,
            "address" => "Avenida Rondon Pacheco, 3434 apto. 101",
            "zip_code" => "38408-404",
            "city" => "Uberlândia",
            "phone" => "34996362712",
            "salary" => 12500.90,
            "admission_date" => "2023-07-12",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("departments")->insert([
            "name" => "Administração",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
