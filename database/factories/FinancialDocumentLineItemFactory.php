<?php

namespace Database\Factories;

use App\Models\FinancialDocumentLineItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FinancialDocumentLineItemFactory extends Factory
{
    protected $model = FinancialDocumentLineItem::class;

    public function definition(): array
    {
        return [
            'financial_document_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'unit_amount' => $this->faker->randomFloat(),
            'tax_type' => $this->faker->word(),
            'tax_amount' => $this->faker->randomFloat(),
            'line_amount' => $this->faker->randomFloat(),
            'account_code' => $this->faker->word(),
            'quantity' => $this->faker->randomFloat(),
            'discount_rate' => $this->faker->randomFloat(),
            'external_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
