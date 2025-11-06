<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['order_id','receipt_number','currency','amount','tax_amount','pdf_path'];

    public function order() { return $this->belongsTo(\App\Models\Orders::class, 'order_id'); }
}

