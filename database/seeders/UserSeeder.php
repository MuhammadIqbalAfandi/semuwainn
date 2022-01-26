<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'phone' => '080000000000',
            'email' => 'admin@semuwainn.com',
            'address' => 'Indonesia',
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(60),
        ]);
    }
}
