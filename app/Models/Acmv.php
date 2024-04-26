<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acmv extends Model
{
    use HasFactory;
  protected $fillable = [
    "energy_id",
    "energy_intensity",
    "energy",
    "co2"
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'energy_id'];
}
