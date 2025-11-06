<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Waistcoat extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'item_number', // ✅ added
        'waistcoat_type',
        'code_waistcoat',
        'code_waistcoat_buttons',
    ];

    /**
     * 🔹 Automatically generate a short, unique item number when creating a new waistcoat.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($waistcoat) {
            if (empty($waistcoat->item_number)) {
                $waistcoat->item_number = self::generateUniqueItemNumber();
            }
        });
    }

    /**
     * 🔹 Generate a unique 4-character alphanumeric item number (e.g. WC-A7B2)
     */
    protected static function generateUniqueItemNumber()
    {
        do {
            $prefix = 'WC-'; // Prefix for waistcoats
            $number = $prefix . strtoupper(Str::random(4));
        } while (self::where('item_number', $number)->exists());

        return $number;
    }
}
