<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyUsageHoursGraph extends Model
{
  use HasFactory;
  protected $fillable = [
    "energy_id",
    "eighth_1",
    "eighth_2",
    "eighth_3",
    "eighth_4",
    "eighth_5",
    "eighth_6"
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'energy_id'];

}
