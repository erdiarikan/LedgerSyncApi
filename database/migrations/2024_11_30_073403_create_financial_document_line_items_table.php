<?php

use App\Models\FinancialDocument;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('financial_document_line_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinancialDocument::class, 'financial_document_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->decimal('unit_amount')->nullable();
            $table->string('tax_type')->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->decimal('line_amount')->nullable();
            $table->string('account_code')->nullable();
            $table->decimal('quantity')->nullable();
            $table->decimal('discount_rate')->nullable();
            $table->string('external_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_document_line_items');
    }
};
