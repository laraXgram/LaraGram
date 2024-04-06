<?php

namespace LaraGram\App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'chat_id',
        'user_id'
    ];
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'user_id');
    }
}