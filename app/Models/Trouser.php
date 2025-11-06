<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Trouser extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'item_number', // ✅ added
        'pants_pocket',
        'pants_pleats',
        'pants_extended_waist_strap',
        'pants_side_adjusters',
        'pants_back_pocket_type',
        'pants_back_pocket_with_buttons',
        'pants_back_pocket_with_flap',
        'pants_pant_cuffs',
        'pants_satin_tape_on_side',
        'code_pants',
        'code_pants_button',
    ];

    /**
     * 🔹 Automatically generate a short, unique item number when creating a new trouser.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($trouser) {
            if (empty($trouser->item_number)) {
                $trouser->item_number = self::generateUniqueItemNumber();
            }
        });
    }

    /**
     * 🔹 Generate a unique 4-character alphanumeric item number (e.g. TR-A7B2)
     */
    protected static function generateUniqueItemNumber()
    {
        do {
            $prefix = 'TR-'; // Prefix for trousers
            $number = $prefix . strtoupper(Str::random(4));
        } while (self::where('item_number', $number)->exists());

        return $number;
    }
}
