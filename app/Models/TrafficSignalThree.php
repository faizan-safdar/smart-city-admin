<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficSignalThree extends Model
{
    use HasFactory;
  protected $fillable = [
    "l1_current_vehicles",
    "l1_max_vehicles",
    "l1_traffic_text",
    "l2_current_vehicles",
    "l2_max_vehicles",
    "l2_traffic_text",
  ];
}
