<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Orders;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'subscription',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (empty($user->subscription)) {
                $user->subscription = 'None';
            }
        });
    }

    /**
     * Relationship: A user has many orders.
     */
    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id');
    }
}
