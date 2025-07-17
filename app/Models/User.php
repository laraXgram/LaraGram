<?php

namespace App\Models;

use LaraGram\Database\Eloquent\Factories\HasFactory;
use LaraGram\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'chat_id',
        'user_id',
        'status',
    ];
}