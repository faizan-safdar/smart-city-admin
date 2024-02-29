<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinWasteBreakdown extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'dustbin_id',
    'organic_waste',
    'bottles_cans',
    'paper_packaging',
    'cardboard',
    'other_waste'
  ];
}
