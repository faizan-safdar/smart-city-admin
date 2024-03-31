<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
  use HasFactory;
  protected $fillable = [
    "energy",
    "name",
    "owner_name",
    "built_date",
    "built_area",
    "occupents",
    "active_power",
    "used_active_power",
    "total_current_hour",
    "cost",
    "co2",
    "KWH_person",
    "KWHM2",
  ];

  public function power()
  {
    return $this->hasMany(Power::class, 'energy_id');
  }
  public function acmv()
  {
    return $this->hasMany(Acmv::class, 'energy_id');
  }
  public function elecv()
  {
    return $this->hasMany(EleEcv::class, 'energy_id');
  }
  public function lighting()
  {
    return $this->hasMany(Lightning::class, 'energy_id');
  }
  public function mixedloads()
  {
    return $this->hasMany(MixedLoad::class, 'energy_id');
  }
  public function connectionTypes()
  {
    return $this->hasMany(EnergyConnectionType::class, 'energy_id');
  }
  public function usageHours()
  {
    return $this->hasMany(EnergyUsageHoursGraph::class, 'energy_id');
  }
}
