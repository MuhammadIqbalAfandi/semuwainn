<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 500; $i++) {
            Room::create([
                'room_number' => $i+'1234',
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            Room::create([
                'room_number' => $i+'5678',
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            Room::create([
                'room_number' => $i+'9123',
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            Room::create([
                'room_number' => $i+'0123',
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 300; $i++) {
            Room::create([
                'room_number' => $i+'4567',
                'room_type_id' => $i,
            ]);
        }
    }
}
