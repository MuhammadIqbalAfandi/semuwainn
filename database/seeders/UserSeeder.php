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
        User::create([
            'name' => 'User1',
            'phone' => '081288885566',
            'email' => 'user@semuwainn.com',
            'address' => 'street',
            'role_id' => 1,
        ]);
    }
}
