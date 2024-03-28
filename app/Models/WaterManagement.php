<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterManagement extends Model
{
    use HasFactory;
  protected $fillable = [
    'level_name',
    'current_capacity',
    'max_capacity',
    'level_status',
    'time',
    'alarm_status',
  ];
  public function waterEnergyUtilizations()
  {
    return $this->hasMany(WaterEnergyUtilization::class, 'water_id');
  }
  public function waterElectricityConsumption()
  {
    return $this->hasMany(WaterElectricityConsumption::class, 'water_id');
  }
  public function waterEnergyBreakdown()
  {
    return $this->hasMany(WaterEnergyBreakdown::class, 'water_id');
  }
  public function waterWasteDischarge()
  {
    return $this->hasMany(WaterWasteDischarge::class, 'water_id');
  }
  public function waterAverageConsumption()
  {
    return $this->hasMany(WaterAverageConsumption::class, 'water_id');
  }
  public function waterUsageBreakdown()
  {
    return $this->hasMany(WaterUsageBreakdown::class, 'water_id');
  }
}
