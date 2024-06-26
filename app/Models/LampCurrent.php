<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampCurrent extends Model
{
    use HasFactory;
  protected $fillable = [
    "lamp_id",
    "now",
    "min",
    "max",
    "avg",
  ];
}
