<?php

namespace Database\Seeders;

use App\Models\RoomFacility;
use Illuminate\Database\Seeder;

class RoomFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => 1,
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => 2,
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => 3,
                'room_type_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => random_int(1, 200),
                'room_type_id' => random_int(1, 200),
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => random_int(201, 300),
                'room_type_id' => random_int(201, 300),
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => random_int(301, 400),
                'room_type_id' => random_int(301, 400),
            ]);
        }

        for ($i = 1; $i <= 500; $i++) {
            RoomFacility::create([
                'facility_id' => random_int(401, 500),
                'room_type_id' => random_int(401, 500),
            ]);
        }

    }
}
