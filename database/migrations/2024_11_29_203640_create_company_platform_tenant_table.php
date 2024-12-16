<?php

use App\Models\Platform;
use App\Models\PlatformCredential;
use App\Models\PlatformTenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_platform_tenant', function (Blueprint $table) {
            $table->id();
            $table->uuid('company_uuid');
            $table->foreignIdFor(PlatformTenant::class, 'platform_tenant_id')->constrained()->cascadeOnDelete();
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
