<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'paymentable' => $this->faker->word(),
            'external_id' => $this->faker->word(),
            'date' => Carbon::now(),
            'amount' => $this->faker->randomFloat(),
            'currency_rate' => $this->faker->randomFloat(),
            'type' => $this->faker->word(),
            'status' => $this->faker->word(),
            'payment_updated_at' => Carbon::now(),
            'has_account' => $this->faker->boolean(),
            'is_reconciled' => $this->faker->boolean(),
            'account_id' => $this->faker->randomNumber(),
            'has_validation_error' => $this->faker->boolean(),
            'contact_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
