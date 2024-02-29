<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinResponseTime extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'dustbin_id',
    '1_hr',
    '2_hr',
    '4_hr',
    '4_plus_hr',
  ];
}
