<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Energy;
use App\Models\Power;
use App\Models\Acmv;
use App\Models\MixedLoad;
use App\Models\EleEcv;
use App\Models\Lightning;
use App\Models\EnergyConnectionType;
use App\Models\EnergyUsageHoursGraph;

class EnergyController extends Controller
{
  public function getEnergyData()
  {
    $energy = Energy::with('power', 'acmv', 'elecv', 'lighting', 'mixedloads', 'connectionTypes', 'usageHours')->get();
    $formattedEnergy = [];
    foreach ($energy as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'energy' => $bin->energy,
        'name' => $bin->name,
        'owner_name' => $bin->owner_name,
        'built_date' => $bin->built_date,
        'built_area' => $bin->built_area,
        'occupents' => $bin->occupents,
        'active_power' => $bin->active_power,
        'used_active_power' => $bin->used_active_power,
        'total_current_hour' => $bin->total_current_hour,
        'cost' => $bin->cost,
        'co2' => $bin->co2,
        'KWH_person' => $bin->KWH_person,
        'KWHM2' => $bin->KWHM2,
        'power' => $bin->power,
        'acmv' => $bin->acmv,
        'elecv' => $bin->elecv,
        'lighting' => $bin->lighting,
        'mixedloads' => $bin->mixedloads,
        'connectionTypes' => array_merge(...array_map('array_values', $bin->connectionTypes->toArray())),
        'usageHours' => array_merge(...array_map('array_values', $bin->usageHours->toArray())),
      ];
      $formattedEnergy[] = $formattedBin;
    }
    return response()->json(['message' => 'Energy data found successfully', 'data' => $formattedEnergy]);

  }

  public function storeOrUpdateEnergy(Request $request)
  {
    $data = $request->except('_token');
    $energy = Energy::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Energy created/updated successfully', 'data' => $energy]);
  }
  public function storeOrUpdatePower(Request $request)
  {
    $data = $request->except('_token');
    $power = Power::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Power created/updated successfully', 'data' => $power]);
  }
  public function storeOrUpdateACMV(Request $request)
  {
    $data = $request->except('_token');
    $acmv = Acmv::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'ACMV created/updated successfully', 'data' => $acmv]);
  }
  public function storeOrUpdateELECVS(Request $request)
  {
    $data = $request->except('_token');
    $eleecv = EleEcv::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Ele ECV created/updated successfully', 'data' => $eleecv]);
  }
  public function storeOrUpdateLighting(Request $request)
  {
    $data = $request->except('_token');
    $lighting = Lightning::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lighting created/updated successfully', 'data' => $lighting]);
  }
  public function storeOrUpdateMixedLoads(Request $request)
  {
    $data = $request->except('_token');
    $mixedLoad = MixedLoad::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Mixed Load created/updated successfully', 'data' => $mixedLoad]);
  }
  public function storeOrUpdateConnectionTypes(Request $request)
  {
    $data = $request->except('_token');
    $connectionType = EnergyConnectionType::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Connection Type created/updated successfully', 'data' => $connectionType]);
  }
  public function storeOrUpdateUsageHours(Request $request)
  {
    $data = $request->except('_token');
    $usageHours = EnergyUsageHoursGraph::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Usage Hourscreated/updated successfully', 'data' => $usageHours]);
  }
}
