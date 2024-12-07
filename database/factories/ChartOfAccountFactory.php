<?php

namespace Database\Factories;

use App\Models\ChartOfAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChartOfAccountFactory extends Factory
{
    protected $model = ChartOfAccount::class;

    public function definition(): array
    {
        return [
            'external_id' => $this->faker->word(),
            'tenant_id' => $this->faker->randomNumber(),
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'status' => $this->faker->word(),
            'tax_type' => $this->faker->word(),
            'class' => $this->faker->word(),
            'system_account' => $this->faker->word(),
            'enable_payment_to_account' => $this->faker->boolean(),
            'show_in_expense_claims' => $this->faker->boolean(),
            'bank_account_number' => $this->faker->word(),
            'bank_account_type' => $this->faker->word(),
            'currency_code' => $this->faker->word(),
            'reporting_code' => $this->faker->word(),
            'reporting_code_name' => $this->faker->name(),
            'has_attachments' => $this->faker->boolean(),
            'chart_of_account_updated_at' => Carbon::now(),
            'add_to_watchlist' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
