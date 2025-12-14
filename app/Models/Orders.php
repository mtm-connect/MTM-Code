<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Orders extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'email',
        'country',
        'address_line_1',
        'address_line_2',
        'post_code',
        'county',
        'occasion',
        'status',
        'date_required',
        'order_number',
    ];

    // 🔹 Auto-generate a unique order number when creating a new order
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = self::generateUniqueOrderNumber();
            }
        });
    }

    /**
     * Generate a unique 6-character alphanumeric order number.
     * e.g. A7B2C9
     */
    protected static function generateUniqueOrderNumber()
    {
        do {
            $letters = strtoupper(Str::random(3)); // e.g. "ABX"
            $digits  = rand(100, 999);             // e.g. "582"
            $number  = $letters . $digits;
        } while (self::where('order_number', $number)->exists());

        return $number;
    }

    // 🔹 Relationships

    /**
     * All measurement records for this order
     * (measurements table has order_id column)
     */
    public function measurements()
    {
        return $this->hasMany(Measurements::class, 'order_id');
    }

    /**
     * All item overviews for this order
     * (order_overviews table has order_id column)
     */
    public function overviews()
    {
        return $this->hasMany(OrderOverview::class, 'order_id');
    }

    /**
     * (Optional) Keep the old name if something still uses it
     */
    public function orderOverviews()
    {
        return $this->hasMany(OrderOverview::class, 'order_id');
    }

    /**
     * The user who owns this order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
