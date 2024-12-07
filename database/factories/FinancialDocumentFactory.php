<?php

namespace Database\Factories;

use App\Models\FinancialDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FinancialDocumentFactory extends Factory
{
    protected $model = FinancialDocument::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'contact_id' => $this->faker->randomNumber(),
            'external_id' => $this->faker->word(),
            'tenant_id' => $this->faker->randomNumber(),
            'document_number' => $this->faker->word(),
            'reference' => $this->faker->word(),
            'amount_due' => $this->faker->randomFloat(),
            'amount_paid' => $this->faker->randomFloat(),
            'amount_credited' => $this->faker->randomFloat(),
            'currency_rate' => $this->faker->randomFloat(),
            'is_discounted' => $this->faker->boolean(),
            'has_attachments' => $this->faker->boolean(),
            'has_errors' => $this->faker->boolean(),
            'date' => Carbon::now(),
            'due_date' => Carbon::now(),
            'status' => $this->faker->word(),
            'line_amount_types' => $this->faker->word(),
            'sub_total' => $this->faker->randomFloat(),
            'total_tax' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'document_updated_at' => Carbon::now(),
            'currency_code' => $this->faker->word(),
            'branding_theme_id' => $this->faker->word(),
            'fully_paid_on_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
