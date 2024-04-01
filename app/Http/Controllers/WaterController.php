<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterManagement;
use App\Models\WaterEnergyUtilization;
use App\Models\WaterElectricityConsumption;
use App\Models\WaterEnergyBreakdown;
use App\Models\WaterWasteDischarge;
use App\Models\WaterAverageConsumption;
use App\Models\WaterUsageBreakdown;
use Illuminate\Support\Carbon;

class WaterController extends Controller
{
  // Get Water Usage
  public function getWaterUsage(Request $request)
  {
    $waterFloors = WaterManagement::with('waterEnergyUtilizations', 'waterElectricityConsumption', 'waterEnergyBreakdown', 'waterWasteDischarge', 'waterAverageConsumption', 'waterUsageBreakdown')->get();
    $formattedWater = [];
    $months = [
      'january', 'february', 'march', 'april', 'may', 'june',
      'july', 'august', 'september', 'october', 'november', 'december'
    ];

    $dataWater = [];
    $dataElectricity = [];
    foreach ($months as $month) {
      $dataWater[$month] = [];

      for ($i = 0; $i < 10; $i++) {
        $dataWater[$month][] = rand(1, 100); // Generate random value between 1 and 100
      }
    }
    foreach ($months as $month) {
      $dataElectricity[$month] = [];

      for ($i = 0; $i < 5; $i++) {
        $dataElectricity[$month][] = rand(1, 100); // Generate random value between 1 and 100
      }
    }

    foreach ($waterFloors as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'level_name' => $bin->level_name,
        'current_capacity' => $bin->current_capacity,
        'max_capacity' => $bin->max_capacity,
        'level_status' => $bin->level_status,
        'time' => $bin->time,
        'alarm_status' => $bin->alarm_status,
        'water_energy_utilizations' => array_merge(...array_map('array_values', $bin->waterEnergyUtilizations->toArray())),
        // 'water_electricity_consumption' => array_merge(...array_map('array_values', $bin->waterElectricityConsumption->toArray())),
        'water_electricity_consumption' => $dataElectricity,
        'water_energy_breakdown' => array_merge(...array_map('array_values', $bin->waterEnergyBreakdown->toArray())),
        'water_waste_discharge' => array_merge(...array_map('array_values', $bin->waterWasteDischarge->toArray())),
        // 'water_average_consumption' => array_merge(...array_map('array_values', $bin->waterAverageConsumption->toArray())),
        'water_average_consumption' => $dataWater,
        'water_usage_breakdown' => array_merge(...array_map('array_values', $bin->waterUsageBreakdown->toArray())),

      ];
      $formattedWater[] = $formattedBin;
    }
    return response()->json(['message' => 'Water Floors Data!', 'data' => $formattedWater]);
  }

  // private function filterDateTimeStrings($array)
  // {
  //   return array_filter($array, function ($value, $key) {
  //     $filteredKeys = ["id", "water_id"];
  //     return !in_array($key, $filteredKeys) && !is_string($value) && !strtotime($value);
  //   }, ARRAY_FILTER_USE_BOTH);
  // }

  private function filterDateTimeStrings($array)
  {
    return array_filter($array, function ($value, $key) {
      $filteredKeys = ["id", "water_id"];
      return !in_array($key, $filteredKeys) && !is_array($value) && !is_string($value) && !strtotime($value);
    }, ARRAY_FILTER_USE_BOTH);
  }



  public function waterFloorData(Request $request)
  {
    $data = $request->except('_token');
    $data['time'] = Carbon::now();
    $waterData = WaterManagement::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Floor added / updated!', 'data' => $waterData]);
  }

  public function waterEnergyUtilization(Request $request)
  {
    $data = $request->except('_token');
    $waterEnergyUtilization = WaterEnergyUtilization::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Utilization added / updated!', 'data' => $waterEnergyUtilization]);
  }

  public function waterElectricityConsumption(Request $request)
  {
    $data = $request->except('_token');
    $WaterElectricityConsumption = WaterElectricityConsumption::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Electricity Consumption added / updated!', 'data' => $WaterElectricityConsumption]);
  }

  public function waterEnergyBreakdown(Request $request)
  {
    $data = $request->except('_token');
    $WaterEnergyBreakdown = WaterEnergyBreakdown::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Energy Breakdown added / updated!', 'data' => $WaterEnergyBreakdown]);
  }

  public function waterWasteDischarge(Request $request)
  {
    $data = $request->except('_token');
    $WaterWasteDischarge = WaterWasteDischarge::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Waste Discharge added / updated!', 'data' => $WaterWasteDischarge]);
  }

  public function waterAverageConsumption(Request $request)
  {
    $data = $request->except('_token');
    $WaterAverageConsumption = WaterAverageConsumption::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Average Consumption added / updated!', 'data' => $WaterAverageConsumption]);
  }

  public function waterUsageBreakdown(Request $request)
  {
    $data = $request->except('_token');
    $WaterUsageBreakdown = WaterUsageBreakdown::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Water Usage Breakdown added / updated!', 'data' => $WaterUsageBreakdown]);
  }
}
