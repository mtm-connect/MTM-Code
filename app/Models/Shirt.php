<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Shirt extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'item_number', // ✅ added
        'collar',
        'collar_buttons',
        'collar_button_down',
        'cuff',
        'contrast',
        'placket',
        'pleat',
        'bottom',
        'pocket',
        'fit',
        'shirt_fabric_code',
        'shirt_button_code',
        'shirt_contrast_code',
    ];

    /**
     * 🔹 Automatically generate a short unique item number when creating a new shirt.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shirt) {
            if (empty($shirt->item_number)) {
                $shirt->item_number = self::generateUniqueItemNumber();
            }
        });
    }

    /**
     * 🔹 Generate a short, unique 4-character alphanumeric code (e.g. SH-A7B2)
     */
    protected static function generateUniqueItemNumber()
    {
        do {
            $prefix = 'SH-'; // Prefix for shirts
            $number = $prefix . strtoupper(Str::random(4));
        } while (self::where('item_number', $number)->exists());

        return $number;
    }
}

