<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'phone' => '081234567890',
            'email' => 'admin@semuwainn.com',
            'address' => 'street',
            'role_id' => 1,
        ]);
    }
}
