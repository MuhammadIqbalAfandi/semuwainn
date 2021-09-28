<?php

namespace Database\Factories;

use App\Models\RoomFacility;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFacilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomFacility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facility_id' => $this->faker->unique(true)->numberBetween(1, 500),
            'room_type_id' => $this->faker->unique(true)->numberBetween(1, 500),
        ];
    }
}
