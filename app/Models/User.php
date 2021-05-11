<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable = ['full_name', 'email', 'cpf', 'password', 'id','shopkeeper'];

    protected $hidden = ['password'];


     public function Wallet()
    {
        return $this->belongsTo(
            Wallet::class,
            'id',
            'user_id'
        );
    }


}
