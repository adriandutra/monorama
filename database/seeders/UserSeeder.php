<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => "admin",
            "password" => Hash::make("PASSWORD"),
            "last_login" => null,
            "is_active" => true,
            "role" => "manager"
        ]);

        DB::table('users')->insert([
            'username' => "tester",
            "password" => Hash::make("PASSWORD"),
            "last_login" => null,
            "is_active" => true,
            "role" => "agent"
        ]);

        User::factory()->count(50)->create();
    }
}
