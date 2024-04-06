<?php

// |----------------------------|
// | You Can Delete This File!  |
// | This is an example for YOU |
// |----------------------------|

namespace LaraGram\Database\Json\Migrations;

use LaraGram\Core\Database\Json\JsonBlueprint;
use LaraGram\Core\Database\Json\JsonSchema;

return new class
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        JsonSchema::create('examples', function (JsonBlueprint $table) {
            // Code ...
        });
    }
};