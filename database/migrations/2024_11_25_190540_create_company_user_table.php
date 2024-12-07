<?php

use App\Models\CompanyUserRole;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('company_uuid');
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CompanyUserRole::class, 'role')->default(1)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_uuid')->references('uuid')->on('companies')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_users');
    }
};
