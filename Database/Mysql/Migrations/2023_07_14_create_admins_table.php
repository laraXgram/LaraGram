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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->integer('user')->unsigned()->index();
            $table->string('role')->nullable();
            $table->string('level')->nullable();
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};