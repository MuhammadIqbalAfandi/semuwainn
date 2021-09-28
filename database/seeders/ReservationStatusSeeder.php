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
            'reservation_status_name' => 'Dibayar',
        ]);

        ReservationStatus::create([
            'reservation_status_name' => 'Dipesan',
        ]);

        ReservationStatus::create([
            'reservation_status_name' => 'Dibatalkan',
        ]);
    }
}
