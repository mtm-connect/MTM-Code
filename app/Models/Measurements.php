<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Measurements extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
      'order_id',
      'user_id',
      'name',
      'dob',
      'gender',
      'height',
      'weight',
      'shoulders',
      'sleeve_length',
      'bicep',
      'wrist',
      'chest',
      'belly',
      'waist',
      'hip',
      'thigh',
      'knee',
      'cuff',
      'outside_leg_length',
      'neck',
      'crotch',
      'inside_leg_length',
      'inside_sleeve_length',
      'pants_cuff_width',
      'jacket_length_front',
      'bs_shoulders',
      'bs_chest',
      'bs_stomach',
      'bs_posture',
      'bs_seat',
      'special requirements',
      
  ];

  public function order()
  {
      return $this->belongsTo(Order::class, 'order_id');  // Ensure the correct foreign key 'order_id'
  }
}
