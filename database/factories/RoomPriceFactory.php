<?php

namespace Database\Factories;

use App\Models\RoomPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_type_id' => $this->faker->unique()->numberBetween(1, 500),
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween(1000, 500000),
        ];
    }
}
