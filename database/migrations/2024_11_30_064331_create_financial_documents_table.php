<?php

use App\Models\Contact;
use App\Models\PlatformTenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('financial_documents', function (Blueprint $table) {
            $table->id();
            $table->morphs('documentable');
            $table->string('type');
            $table->foreignIdFor(Contact::class, 'contact_id')->constrained()->cascadeOnDelete();
            $table->text('external_id');
            $table->foreignIdFor(PlatformTenant::class, 'tenant_id')->constrained()->cascadeOnDelete();;
            $table->text('document_number')->nullable();
            $table->text('reference')->nullable();
            $table->decimal('amount_due')->nullable();
            $table->decimal('amount_paid')->nullable();
            $table->decimal('amount_credited')->nullable();
            $table->decimal('currency_rate')->nullable();
            $table->boolean('is_discounted');
            $table->boolean('has_attachments');
            $table->boolean('has_errors');
            $table->timestamp('date');
            $table->timestamp('due_date')->nullable();
            $table->string('status');
            $table->string('line_amount_types');
            $table->decimal('sub_total');
            $table->decimal('total_tax');
            $table->decimal('total');
            $table->timestamp('document_updated_at');
            $table->string('currency_code')->nullable();
            $table->string('branding_theme_id')->nullable();
            $table->timestamp('fully_paid_on_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_documents');
    }
};
