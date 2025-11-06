<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company',
        'email',
        'password',
        'phone_number',
        'country',
        'address_line_1',
        'address_line_2',
        'post_code',
        'county',
        'subscription', // ✅ added
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Boot method to set default values on model creation.
     */
    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (empty($user->subscription)) {
                $user->subscription = 'None'; // ✅ default value
            }
        });
    }
}
