<?php

use App\Models\Platform;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->morphs('contactable');
            $table->string('name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('platform_contact_number')->nullable();
            $table->string('platform_contact_status')->nullable();
            $table->string('platform_contact_id')->nullable();
            $table->string('bank_account_details')->nullable();
            $table->string('company_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('accounts_receivable_tax_type')->nullable();
            $table->string('accounts_payable_tax_type')->nullable();
            $table->timestamp('contact_created_at')->nullable();
            $table->timestamp('contact_updated_at')->nullable();
            $table->boolean('is_supplier')->default(false);
            $table->boolean('is_customer')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
