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
    return response()->json(['message' => 'Energy data found successfully', 'data' => $energy]);

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
