<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'address_line_1' => $this->faker->address(),
            'address_line_2' => $this->faker->address(),
            'address_line_3' => $this->faker->address(),
            'address_line_4' => $this->faker->address(),
            'address_line_5' => $this->faker->address(),
            'city' => $this->faker->city(),
            'region' => $this->faker->word(),
            'postcode' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'attention_to' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
