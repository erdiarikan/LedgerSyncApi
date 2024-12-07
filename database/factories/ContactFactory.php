<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'status' => $this->faker->word(),
            'contact_created_at' => Carbon::now(),
            'contact_updated_at' => Carbon::now(),
            'is_supplier' => $this->faker->boolean(),
            'is_customer' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
