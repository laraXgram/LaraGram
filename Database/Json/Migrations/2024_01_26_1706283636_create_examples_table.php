<?php

// |----------------------------|
// | You Can Delete This File!  |
// | This is an example for YOU |
// |----------------------------|

namespace Bot\Database\Json\Migrations;

use Bot\Core\Database\Json\JsonBlueprint;
use Bot\Core\Database\Json\JsonSchema;

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