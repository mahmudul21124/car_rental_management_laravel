<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Car_owner extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $guard = 'car_owner';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
