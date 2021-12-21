<?php

namespace Database\Seeders;

use App\Models\ReservationStatus;
use Illuminate\Database\Seeder;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservationStatus::create([
            'name' => 'Dibayar',
        ]);

        ReservationStatus::create([
            'name' => 'Dipesan',
        ]);

        ReservationStatus::create([
            'name' => 'Dibatalkan',
        ]);

        ReservationStatus::create([
            'name' => 'Check In',
        ]);

        ReservationStatus::create([
            'name' => 'Check Out',
        ]);

    }
}
