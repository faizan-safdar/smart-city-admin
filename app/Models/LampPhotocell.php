<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampPhotocell extends Model
{
  use HasFactory;
  protected $fillable = [
    "lamp_id",
    "now",
    "min",
    "max",
    "avg",
  ];
  protected $hidden = ['created_at', 'updated_at', 'id', 'lamp_id'];
}
