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
use Illuminate\Support\Facades\Validator;

class EnergyController extends Controller
{
  public function getEnergyData()
  {
    $energyid = 0;
    $energy = Energy::with('power', 'acmv', 'elecv', 'lighting', 'mixedloads', 'connectionTypes', 'usageHours')->get();
    $formattedEnergies = [];
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
      $formattedEnergies[] = $formattedBin;
    }
    return response()->json(['message' => 'Energy data found successfully', 'data' => $formattedEnergies]);
  }

  public function getEnergiesData()
  {
    $energyid = 0;
    $energy = Energy::with('power', 'acmv', 'elecv', 'lighting', 'mixedloads', 'connectionTypes', 'usageHours')->get();
    $formattedEnergies = [];
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
      $formattedEnergies[] = $formattedBin;
    }
    return view('content.energy.energy', compact('formattedEnergies', 'energyid'));
  }

  // Get Energy Data
  public function fetchEnergy($id)
  {
    $energy = Energy::findorFail($id);
    return response()->json($energy);
  }

  // Store or Update Energy
  public function storeOrUpdateEnergy(Request $request)
  {
    $data = $request->except('_token');
    $energy = Energy::updateOrCreate(['id' => $request->id], $data);
    return redirect()->route('energy');
  }

  // Get Energy Details
  public function getEnergyDetails($energyid)
  {
    $Powers = Power::where('energy_id', $energyid)->get();
    $acmvs = Acmv::where('energy_id', $energyid)->get();
    $elecvs = EleEcv::where('energy_id', $energyid)->get();
    $lightings = Lightning::where('energy_id', $energyid)->get();
    $mixedLoads = MixedLoad::where('energy_id', $energyid)->get();
    $connectionTypes = EnergyConnectionType::where('energy_id', $energyid)->get();
    $usageHours = EnergyUsageHoursGraph::where('energy_id', $energyid)->get();

    return view('content.energy.energy', compact('Powers', 'acmvs', 'elecvs', 'lightings', 'mixedLoads', 'connectionTypes', 'usageHours', 'energyid'));
  }

  // Get Sub Energy Data
  public function fetchEnergyData($id, $energy)
  {
    $data = [];
    if ($energy == 'Power') {
      $data = Power::findorFail($id);
    } elseif ($energy == 'ACMV') {
      $data = Acmv::findorFail($id);
    } elseif ($energy == 'ELECV') {
      $data = EleEcv::findorFail($id);
    } elseif ($energy == 'Lightning') {
      $data = Lightning::findorFail($id);
    } elseif ($energy == 'Mixed Load') {
      $data = MixedLoad::findorFail($id);
    }

    return response()->json($data);
  }

  // Store or Update Sub Energy Data
  public function storeOrUpdateEnergyData(Request $request)
  {
    $data = $request->except('_token');
    if ($data['type'] == 'Power') {
      $power = Power::updateOrCreate(['id' => $request->id], $data);
    }elseif ($data['type'] == 'ACMV') {
      $acmv = Acmv::updateOrCreate(['id' => $request->id], $data);
    }elseif ($data['type'] == 'ELECV') {
      $eleecv = EleEcv::updateOrCreate(['id' => $request->id], $data);
    }elseif ($data['type'] == 'Lightning') {
      $lighting = Lightning::updateOrCreate(['id' => $request->id], $data);
    }elseif ($data['type'] == 'Mixed Load') {
      $mixedLoad = MixedLoad::updateOrCreate(['id' => $request->id], $data);
    }

    return redirect()->route('energy-details', $data['Energy_id']);
  }

  // Fetch Energy Connection Types
  public function fetchConnectionTypes($id)
  {
    $connectionTypes = EnergyConnectionType::findorFail($id);
    return response()->json($connectionTypes);
  }

  // Store or Update Energy Connection Types
  public function storeOrUpdateConnectionTypes(Request $request)
  {
    $data = $request->except('_token');

    $validator = $this->MinMaxValidation($request, 0, 100, ['_token', 'id', 'Energy_id']);

    if ($validator !== true) {
      return redirect()->back()->withErrors($validator)->withInput();
    }else {
      $connectionType = EnergyConnectionType::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('energy-details', $data['Energy_id']);
    } 
  }

  // Fetch Usage Hours Graph
  public function fetchUsageHoursGraph($id)
  {
    $usageHours = EnergyUsageHoursGraph::findorFail($id);
    return response()->json($usageHours);
  }

  // Store or Update Usage Hours Graph
  public function storeOrUpdateUsageHours(Request $request)
  {
    $data = $request->except('_token');

    $validator = $this->MinMaxValidation($request, 0, 3000, ['_token', 'id', 'Energy_id']);

    if ($validator !== true) {
      return redirect()->back()->withErrors($validator)->withInput();
    }else {
      $usageHours = EnergyUsageHoursGraph::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('energy-details', $data['Energy_id']);
    }
  }

  public function MinMaxValidation($request, $min, $max, $ignoreattr = [])
  {
    $inputAttributes = $request->except($ignoreattr);

    // dd($inputAttributes);
    $rules = [];
    $messages = [];

    foreach ($inputAttributes as $attributeName => $attributeValue) {
      $rules[$attributeName] = 'required|numeric|min:'. $min .'|max:' . $max .'';

      $messages["$attributeName.min"] = str_replace('_', ' ', ucfirst($attributeName) . ' value must be between '.$min.' and '.$max);
      $messages["$attributeName.max"] = str_replace('_', ' ', ucfirst($attributeName) . ' value must be between '.$min.' and '.$max);
    }

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return $validator;
    }
    else {
      return true;
    }
  }
}
