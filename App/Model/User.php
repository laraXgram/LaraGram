<?php

namespace Bot\App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'user');
    }
}