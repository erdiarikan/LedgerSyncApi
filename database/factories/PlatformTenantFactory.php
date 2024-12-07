<?php

namespace Database\Factories;

use App\Models\PlatformTenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlatformTenantFactory extends Factory
{
    protected $model = PlatformTenant::class;

    public function definition(): array
    {
        return [
            'company_uuid' => $this->faker->uuid(),
            'platform_id' => $this->faker->randomNumber(),
            'auth_event_id' => $this->faker->word(),
            'tenant_id' => $this->faker->word(),
            'tenant_type' => $this->faker->word(),
            'tenant_name' => $this->faker->name(),
            'tenant_created_at' => Carbon::now(),
            'tenant_updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
