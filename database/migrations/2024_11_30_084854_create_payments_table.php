<?php

use App\Models\ChartOfAccount;
use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('paymentable');
            $table->foreignIdFor(Contact::class, 'contact_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ChartOfAccount::class, 'chart_of_account_id')->constrained()->cascadeOnDelete();
            $table->string('external_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->decimal('amount');
            $table->decimal('currency_rate');
            $table->string('type');
            $table->string('status');
            $table->timestamp('payment_updated_at');
            $table->boolean('has_account');
            $table->boolean('is_reconciled');
            $table->boolean('has_validation_error');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
