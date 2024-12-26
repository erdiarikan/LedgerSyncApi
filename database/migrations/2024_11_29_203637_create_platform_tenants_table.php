<?php

use App\Models\Platform;
use App\Models\PlatformCredential;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('platform_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PlatformCredential::class, 'platform_credential_id')->constrained()->cascadeOnDelete();
            $table->text('auth_event_id')->nullable();
            $table->string('platform_id')->unique();
            $table->string('organisation_type')->nullable();
            $table->string('name');
            $table->timestamp('tenant_created_at')->nullable();
            $table->timestamp('tenant_updated_at')->nullable();
            $table->string('legal_name')->nullable();
            $table->boolean('pays_tax')->nullable();
            $table->string('country_code')->nullable();
            $table->string('base_currency')->nullable();
            $table->string('organisation_status')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('financial_year_end_day')->nullable();
            $table->string('financial_year_end_month')->nullable();
            $table->string('sales_tax_basis')->nullable();
            $table->string('sales_tax_period')->nullable();
            $table->string('organisation_created_at')->nullable();
            $table->string('timezone')->nullable();
            $table->string('organisation_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platform_tenants');
    }
};
