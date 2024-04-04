<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterElectricityConsumption extends Model
{
    use HasFactory;
  protected $fillable = [
    'water_id',
    'month',
    'room_name',
    'energy_usage',
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'water_id'];

}
