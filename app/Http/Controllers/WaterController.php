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
    return response()->json(['message' => 'Water Floors Data!', 'data' => $waterFloors]);
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
