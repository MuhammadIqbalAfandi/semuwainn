<?php

namespace Database\Seeders;

use App\Models\RoomOrderStatus;
use Illuminate\Database\Seeder;

class RoomOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomOrderStatus::create([
            'room_order_status_name' => 'Checkin',
        ]);

        RoomOrderStatus::create([
            'room_order_status_name' => 'Checkout',
        ]);
    }
}
