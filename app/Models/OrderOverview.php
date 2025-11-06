<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class OrderOverview extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = 'order_overview'; // Make sure this matches your DB table name

    protected $fillable = [
        'order_id',
        'user_id',
        'measurement_id',
        'price_id',
        'two_pieces_id',
        'three_pieces_id',
        'jackets_id',
        'shirts_id',
        'trouser_id',
        'waistcoat_id',
        'type',
        'for',
        'price',
        'status',
    ];

    // 🔹 Relationship to measurements
    public function measurement()
    {
        return $this->belongsTo(Measurements::class, 'measurement_id');
    }

// 🔹 Relationships to item tables
public function jacket()
{
    return $this->belongsTo(Jacket::class, 'jackets_id');
}

public function shirt()
{
    return $this->belongsTo(Shirt::class, 'shirts_id');
}

public function twoPiece()
{
    return $this->belongsTo(TwoPiece::class, 'two_pieces_id');
}

public function threePiece()
{
    return $this->belongsTo(ThreePiece::class, 'three_pieces_id');
}

public function trouser()
{
    return $this->belongsTo(Trouser::class, 'trouser_id'); // or Trouser::class, depending on your model name
}

public function waistcoat()
{
    return $this->belongsTo(Waistcoat::class, 'waistcoat_id');
}


    // 🔹 Automatically determine which item type this overview points to
    public function getItemModelAttribute()
    {
        return $this->jacket
            ?? $this->twoPiece
            ?? $this->threePiece
            ?? $this->shirt
            ?? $this->trouser
            ?? $this->waistcoat;
    }

    // 🔹 Virtual attribute for easy access to the linked item's number
    public function getItemNumberAttribute()
    {
        return optional($this->item_model)->item_number;
    }
}


