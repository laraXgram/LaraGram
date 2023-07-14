<?php

namespace Bot\Database\Mysql\Migrations;

use Bot\Core\Database\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
<<<<<<< HEAD
            $table->string('user_id')->unique();
=======
            $table->integer('user_id');
            $table->integer('chat_id');
>>>>>>> cb99f88 (start create auth system)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};