<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class ThreePiece extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'item_number', // ✅ added
        'jacket_type',
        'jacket_construction',
        'jacket_lapel_type',
        'jacket_hand_stitch',
        'jacket_satin_lapel',
        'jacket_lapel_width',
        'jacket_lapel_functional_button',
        'jacket_sleeve_buttons',
        'jacket_functional_buttons',
        'jacket_buttons_colour_on_last_button_hole',
        'jacket_lining',
        'jacket_pockets',
        'jacket_pockets_with_flap',
        'jacket_italian_pockets',
        'jacket_patch_pockets',
        'jacket_pockets_satin_piping',
        'jacket_chest_pocket_type',
        'jacket_vents',
        'waistcoat_type',
        'pants_pocket',
        'pants_pleats',
        'pants_extended_waist_strap',
        'pants_side_adjusters',
        'pants_back_pocket_type',
        'pants_back_pocket_with_buttons',
        'pants_back_pocket_with_flap',
        'pants_pant_cuffs',
        'pants_satin_tape_on_side',
        'code_jacket',
        'code_jacket_lining',
        'code_jacket_button',
        'code_satin_lapel',
        'code_colour_on_last_button_hole',
        'code_waistcoat',
        'code_waistcoat_buttons',
        'code_pants',
        'code_pants_button',
    ];

    /**
     * 🔹 Auto-generate a short unique item number when creating a new three-piece.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($threePiece) {
            if (empty($threePiece->item_number)) {
                $threePiece->item_number = self::generateUniqueItemNumber();
            }
        });
    }

    /**
     * 🔹 Generate a unique 4-character item number (e.g. 3P-A7B2)
     */
    protected static function generateUniqueItemNumber()
    {
        do {
            $prefix = '3P-'; // Prefix for three-piece suits
            $number = $prefix . strtoupper(Str::random(4));
        } while (self::where('item_number', $number)->exists());

        return $number;
    }
}
