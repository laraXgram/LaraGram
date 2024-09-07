<?php

use Illuminate\Database\Schema\Blueprint;
use LaraGram\Support\Facades\Schema;

return new class
{
    public function up(): void
    {
        Schema::create('caches', function (Blueprint $table) {
            $table->id();
            $table->string('cache_key')->unique();
            $table->text('cache_value');
            $table->timestamp('expiry_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caches');
    }
};