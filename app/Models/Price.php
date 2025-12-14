<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    // Table is "prices" by default so no need to set $table.

    protected $fillable = [
        'product',
        'price',
    ];
}
