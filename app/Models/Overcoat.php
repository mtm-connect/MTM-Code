<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Overcoat extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'item_number', // ✅ added
        'overcoat_type',
        'overcoat_construction',
        'overcoat_lapel_type',
        'overcoat_hand_stitch',
        'overcoat_satin_lapel',
        'overcoat_lapel_width',
        'overcoat_lapel_functional_button',
        'overcoat_sleeve_buttons',
        'overcoat_functional_buttons',
        'overcoat_buttons_colour_on_last_button_hole',
        'overcoat_lining',
        'overcoat_pockets',
        'overcoat_pockets_with_flap',
        'overcoat_italian_pockets',
        'overcoat_patch_pockets',
        'overcoat_pockets_satin_piping',
        'overcoat_chest_pocket_type',
        'overcoat_vents',
        'code_overcoat',
        'code_overcoat_lining',
        'code_overcoat_button',
        'code_satin_lapel',
        'code_colour_on_last_button_hole',
    ];

    /**
     * 🔹 Auto-generate a short, unique item number when creating a new overcoat.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($overcoat) {
            if (empty($overcoat->item_number)) {
                $overcoat->item_number = self::generateUniqueItemNumber();
            }
        });
    }

    /**
     * 🔹 Generate a short unique item number (e.g. OC-A7B2).
     */
    protected static function generateUniqueItemNumber()
    {
        do {
            $prefix = 'OC-'; // Overcoat prefix
            $number = $prefix . strtoupper(Str::random(4)); // only 4 random characters
        } while (self::where('item_number', $number)->exists());

        return $number;
    }
}
