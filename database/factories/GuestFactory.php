<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik' => $this->faker->unique(true)->nik(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique(true)->phoneNumber(),
            'email' => $this->faker->unique(true)->email(),
            'address' => $this->faker->address(),
        ];
    }
}
