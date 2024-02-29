<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BinUsage;
use App\Models\BinWasteRemoval;
use App\Models\BinRepairCost;
use App\Models\BinMaintenanceCost;
use App\Models\BinResponseTime;
use App\Models\BinSatisfiedPublic;
use App\Models\BinWasteBreakdown;


class Dustbin extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'text',
    'last_update',
    'fill_percentage',
    'image',
  ];

  public function binUsage()
  {
    return $this->hasOne(BinUsage::class);
  }
  public function binWasteRemoval()
  {
    return $this->hasOne(BinWasteRemoval::class);
  }
  public function binRepairCost()
  {
    return $this->hasOne(BinRepairCost::class);
  }
  public function binMaintenanceCost()
  {
    return $this->hasOne(BinMaintenanceCost::class);
  }
  public function binResponseTime()
  {
    return $this->hasOne(BinResponseTime::class);
  }
  public function binSatisfiedPublic()
  {
    return $this->hasOne(BinSatisfiedPublic::class);
  }
  public function binWasteBreakdown()
  {
    return $this->hasOne(BinWasteBreakdown::class);
  }
}
