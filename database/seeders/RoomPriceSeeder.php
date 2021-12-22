<?php

namespace Database\Seeders;

use App\Models\RoomPrice;
use Illuminate\Database\Seeder;

class RoomPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 200; $i++) {
            RoomPrice::create([
                'room_type_id' => $i,
                'description' => 'Belum termasuk makan.',
                'price' => random_int(200000, 399999),
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomPrice::create([
                'room_type_id' => $i,
                'description' => 'Sudah termasuk makan pagi.',
                'price' => random_int(400000, 599999),
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomPrice::create([
                'room_type_id' => $i,
                'description' => 'Sudah termasuk makan pagi siang dan malam.',
                'price' => random_int(600000, 1000000),
            ]);
        }
    }
}
