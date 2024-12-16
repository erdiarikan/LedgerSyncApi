<?php

namespace Database\Factories;

use App\Models\PlatformCredential;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PlatformCredentialFactory extends Factory
{
    protected $model = PlatformCredential::class;

    public function definition(): array
    {
        return [
            'company_uuid' => $this->faker->uuid(),
            'platform_id' => $this->faker->randomNumber(),
            'id_token' => Str::random(10),
            'access_token' => Str::random(10),
            'access_token_created_at' => Carbon::now(),
            'access_token_expires_at' => Carbon::now(),
            'refresh_token' => Str::random(10),
            'refresh_token_created_at' => Carbon::now(),
            'refresh_token_expires_at' => Carbon::now(),
            'scope' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
