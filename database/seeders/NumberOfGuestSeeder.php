<?php

namespace Database\Seeders;

use App\Models\NumberOfGuest;
use Illuminate\Database\Seeder;

class NumberOfGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NumberOfGuest::create([
            'guest' => 2,
        ]);

        NumberOfGuest::create([
            'guest' => 4,
        ]);
    }
}
