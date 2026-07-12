<?php

namespace App\Models;

use LaraGram\Database\Eloquent\Attributes\Fillable;
use LaraGram\Database\Eloquent\Factories\HasFactory;
use LaraGram\Foundation\Auth\User as Authenticatable;

#[Fillable([
    'first_name',
    'last_name',
    'chat_id',
    'user_id',
    'status',
])]
class User extends Authenticatable
{
    use HasFactory;
}
