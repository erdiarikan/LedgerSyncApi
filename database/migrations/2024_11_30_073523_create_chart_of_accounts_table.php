<?php

use App\Models\PlatformTenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PlatformTenant::class, 'platform_tenant_id')->constrained()->cascadeOnDelete();
            $table->string('external_id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable();
            $table->string('account_type')->nullable();
            $table->string('tax_type')->nullable();
            $table->text('description')->nullable();
            $table->string('class')->nullable();
            $table->string('system_account')->nullable();
            $table->boolean('enable_payment_to_account')->nullable();
            $table->boolean('show_in_expense_claims')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('reporting_code')->nullable();
            $table->string('reporting_code_name')->nullable();
            $table->boolean('has_attachments')->nullable();
            $table->timestamp('chart_of_account_updated_at')->nullable();
            $table->timestamp('add_to_watchlist')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chart_of_accounts');
    }
};
