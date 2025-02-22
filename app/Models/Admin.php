<?php

namespace App\Models;

use LaraGram\Database\Eloquent\Model;
use LaraGram\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'level'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}