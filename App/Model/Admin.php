<?php

namespace Bot\App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}