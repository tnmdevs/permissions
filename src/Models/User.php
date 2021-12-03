<?php

namespace TNM\Permissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as BaseUser;
use Laravel\Sanctum\HasApiTokens;
use TNM\Permissions\Database\Factories\UserFactory;

class User extends BaseUser
{
    use HasApiTokens, HasFactory, HasRole;

    protected $guarded = [];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}