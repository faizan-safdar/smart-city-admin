<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterEnergyBreakdown extends Model
{
    use HasFactory;
  protected $fillable = [
    'water_id',
    'industrial',
    'commerce',
    'household',
    'transport',
    'others',
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'water_id'];

}
