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
            $table->uuid('company_uuid');
            $table->foreignIdFor(PlatformCredential::class, 'platform_credential_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Platform::class, 'platform_id')->constrained()->cascadeOnDelete();
            $table->text('auth_event_id')->nullable();
            $table->string('tenant_id')->nullable();
            $table->string('tenant_type')->nullable();
            $table->string('tenant_name');
            $table->timestamp('tenant_created_at')->nullable();
            $table->timestamp('tenant_updated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_uuid')->references('uuid')->on('companies')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platform_tenants');
    }
};
