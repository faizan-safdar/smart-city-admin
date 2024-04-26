<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyConnectionType extends Model
{
  use HasFactory;
  protected $fillable = [
    "energy_id",
    "power",
    "acmv",
    "elec_esc",
    "lightning",
    "mixed_load"
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'energy_id'];

}
