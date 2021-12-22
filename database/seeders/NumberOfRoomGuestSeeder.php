<?php

namespace Database\Seeders;

use App\Models\NumberOfRoomGuest;
use Illuminate\Database\Seeder;

class NumberOfRoomGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 500; $i++) {
            NumberOfRoomGuest::create([
                'room_type_id' => $i,
                'number_of_guest_id' => random_int(1, 2),
            ]);
        }
    }
}
