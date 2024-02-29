<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinUsage extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'dustbin_id',
    'eighth_1',
    'eighth_2',
    'eighth_3',
    'eighth_4',
    'eighth_5',
    'eighth_6',
  ];
}
