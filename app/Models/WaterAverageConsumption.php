<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterAverageConsumption extends Model
{
    use HasFactory;
  protected $fillable = [
    'water_id',
    'month',
    'type',
    'value',
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'water_id'];

}
