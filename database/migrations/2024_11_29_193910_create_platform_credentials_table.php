<?php

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('platform_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Platform::class, 'platform_id')->constrained()->cascadeOnDelete();
            $table->text('id_token')->nullable();
            $table->text('access_token');
            $table->timestamp('access_token_created_at');
            $table->timestamp('access_token_expire_at');
            $table->text('refresh_token')->nullable();
            $table->timestamp('refresh_token_created_at')->nullable();
            $table->timestamp('refresh_token_expire_at')->nullable();
            $table->text('scope')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platform_credentials');
    }
};
