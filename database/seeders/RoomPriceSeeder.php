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
        for ($i=1; $i <= 500; $i++) {
            RoomPrice::factory()->count(random_int(2,5))->create();
        }
    }
}
