<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GuestSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\FacilitySeeder;
use Database\Seeders\RoomTypeSeeder;
use Database\Seeders\RoomPriceSeeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\RoomFacilitySeeder;
use Database\Seeders\RoomOrderStatusSeeder;
use Database\Seeders\ReservationStatusSeeder;

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
            RestaurantSeeder::class,
            ServiceSeeder::class,
            GuestSeeder::class,
            RoomSeeder::class,
            RoomTypeSeeder::class,
            RoomPriceSeeder::class,
            FacilitySeeder::class,
            RoomFacilitySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RoomOrderStatusSeeder::class,
            ReservationStatusSeeder::class,
        ]);
    }
}
