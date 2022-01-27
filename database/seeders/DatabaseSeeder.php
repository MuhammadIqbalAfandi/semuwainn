<?php

namespace Database\Seeders;

use Database\Seeders\FacilitySeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\GuestSeeder;
use Database\Seeders\ReservationStatusSeeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomFacilitySeeder;
use Database\Seeders\RoomPriceSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\RoomTypeSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ServiceUnitSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ServiceUnitSeeder::class,
            RestaurantSeeder::class,
            ServiceSeeder::class,
            GuestSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            RoomPriceSeeder::class,
            FacilitySeeder::class,
            RoomFacilitySeeder::class,
            GenderSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ReservationStatusSeeder::class,
        ]);
    }
}
