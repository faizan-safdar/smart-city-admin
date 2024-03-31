<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreetLight extends Model
{
  use HasFactory;
  protected $fillable = [
    "name",
    "status",
    "energy_consumed",
    "schedule",
    "power_status",
    "device_status",
    "timezone",
    "last_contact",
    "street_light_status",
    "lamp_status",
    "knockdown_status",
    "brightness_level",
    "photocell_mode_on",
    "photocell_mode_off",
    "beacon_control",
  ];

  public function lampVoltage()
  {
    return $this->hasMany(LampVoltage::class, 'lamp_id');
  }
  public function lampPhotocell()
  {
    return $this->hasMany(LampPhotocell::class, 'lamp_id');
  }
  public function lampCurrent()
  {
    return $this->hasMany(LampCurrent::class, 'lamp_id');
  }
  public function lampVoltageGraph()
  {
    return $this->hasMany(LampVoltageGraph::class, 'lamp_id');
  }
  public function lampPhotocellGraph()
  {
    return $this->hasMany(LampPhotocellGraph::class, 'lamp_id');
  }
  public function lampCurrentGraph()
  {
    return $this->hasMany(LampCurrentGraph::class, 'lamp_id');
  }
}
