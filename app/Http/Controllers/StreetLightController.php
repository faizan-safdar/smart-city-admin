<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StreetLight;
use App\Models\LampVoltage;
use App\Models\LampPhotocell;
use App\Models\LampCurrent;
use App\Models\LampVoltageGraph;
use App\Models\LampPhotocellGraph;
use App\Models\LampCurrentGraph;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class StreetLightController extends Controller
{
  public function getStreetLight()
  {
    $streetLightId = 0;
    $data = StreetLight::with('lampVoltage', 'lampPhotocell', 'lampCurrent', 'lampVoltageGraph', 'lampPhotocellGraph', 'lampCurrentGraph')->get();
    $formattedLamps = [];
    foreach ($data as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'name' => $bin->name,
        'status' => $bin->status,
        'energy_consumed' => $bin->energy_consumed,
        'schedule' => $bin->schedule,
        'power_status' => $bin->power_status,
        'device_status' => $bin->device_status,
        'timezone' => $bin->timezone,
        'last_contact' => $bin->last_contact,
        'street_light_status' => $bin->street_light_status,
        'lamp_status' => $bin->lamp_status,
        'knockdown_status' => $bin->knockdown_status,
        'brightness_level' => $bin->brightness_level,
        'photocell_mode_on' => $bin->photocell_mode_on,
        'photocell_mode_off' => $bin->photocell_mode_off,
        'beacon_control' => $bin->beacon_control,
        'lampVoltage' => $bin->lampVoltage,
        'lampPhotocell' => $bin->lampPhotocell,
        'lampCurrent' => $bin->lampCurrent,
        'lampVoltageGraph' => $bin->lampVoltageGraph,
        'lampVoltageGraph' => array_merge(...array_map('array_values', $bin->lampVoltageGraph->toArray())),
        'lampPhotocellGraph' => array_merge(...array_map('array_values', $bin->lampPhotocellGraph->toArray())),
        'lampCurrentGraph' => array_merge(...array_map('array_values', $bin->lampCurrentGraph->toArray())),

      ];
      $formattedLamps[] = $formattedBin;
    }
    return response()->json(['message' => 'Street Light data found successfully', 'data' => $formattedLamps]);
  }
  
  // Get Street Light Data
  public function getStreetLights()
  {
    $streetLightId = 0;
    $data = StreetLight::with('lampVoltage', 'lampPhotocell', 'lampCurrent', 'lampVoltageGraph', 'lampPhotocellGraph', 'lampCurrentGraph')->get();
    $formattedLamps = [];
    foreach ($data as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'name' => $bin->name,
        'status' => $bin->status,
        'energy_consumed' => $bin->energy_consumed,
        'schedule' => $bin->schedule,
        'power_status' => $bin->power_status,
        'device_status' => $bin->device_status,
        'timezone' => $bin->timezone,
        'last_contact' => $bin->last_contact,
        'street_light_status' => $bin->street_light_status,
        'lamp_status' => $bin->lamp_status,
        'knockdown_status' => $bin->knockdown_status,
        'brightness_level' => $bin->brightness_level,
        'photocell_mode_on' => $bin->photocell_mode_on,
        'photocell_mode_off' => $bin->photocell_mode_off,
        'beacon_control' => $bin->beacon_control,
        'lampVoltage' => $bin->lampVoltage,
        'lampPhotocell' => $bin->lampPhotocell,
        'lampCurrent' => $bin->lampCurrent,
        'lampVoltageGraph' => $bin->lampVoltageGraph,
        'lampVoltageGraph' => array_merge(...array_map('array_values', $bin->lampVoltageGraph->toArray())),
        'lampPhotocellGraph' => array_merge(...array_map('array_values', $bin->lampPhotocellGraph->toArray())),
        'lampCurrentGraph' => array_merge(...array_map('array_values', $bin->lampCurrentGraph->toArray())),

      ];
      $formattedLamps[] = $formattedBin;
    }
    return view('content.streetlights.streetlights', compact('formattedLamps', 'streetLightId'));
  }


  // Store or Update Street Light
  public function fetchStreetLight($id)
  {
    $data = StreetLight::findorFail($id);
    return response()->json($data);
  }

  public function storeOrUpdateStreetLight(Request $request)
  {
    $data = $request->except('_token');
    if (!request()->has('status')) {  $data['status'] = 'off';  }
    if (!request()->has('power_status')) {  $data['power_status'] = 'NOT OK';  }
    if (!request()->has('device_status')) {  $data['device_status'] = 'NOT OK';  }
    if (!request()->has('street_light_status')) {  $data['street_light_status'] = 'CS - OFF';  }
    if (!request()->has('lamp_status')) {  $data['lamp_status'] = 'NOT OK';  }
    if (!request()->has('knockdown_status')) {  $data['knockdown_status'] = 'OFF';  }
    if (!request()->has('photocell_mode_on')) {  $data['photocell_mode_on'] = 'OFF';  }
    if (!request()->has('photocell_mode_off')) {  $data['photocell_mode_off'] = 'OFF';  }
    if (!request()->has('beacon_control')) {  $data['beacon_control'] = 'OFF';  }
    
    $data['last_contact'] = date($request->last_contact);
    $streetLight = StreetLight::updateOrCreate(['id' => $request->id], $data);
    return redirect()->route('streetlights');
  }

  public function getStreetLightDetails($streetLightId){
     $LampVoltages = LampVoltage::where('lamp_id', $streetLightId)->get();
     $LampPhotocells = LampPhotocell::where('lamp_id', $streetLightId)->get();
     $LampCurrents = LampCurrent::where('lamp_id', $streetLightId)->get();
     $LampVoltageGraphs = LampVoltageGraph::where('lamp_id', $streetLightId)->get();
     $LampPhotocellGraphs = LampPhotocellGraph::where('lamp_id', $streetLightId)->get();
     $LampCurrentGraphs = LampCurrentGraph::where('lamp_id', $streetLightId)->get();

     return view('content.streetlights.streetlights', compact('LampVoltages', 'LampPhotocells', 'LampCurrents', 'LampVoltageGraphs', 'LampPhotocellGraphs', 'LampCurrentGraphs', 'streetLightId'));
  }

  // Store or Update Lamp Data
  public function fetchLampData($id, $lamp)
  {
    $data = [];
    if($lamp == 'Current'){
      $data = LampCurrent::findorFail($id);
    }elseif($lamp == 'Voltage'){
      $data = LampVoltage::findorFail($id);
    }elseif($lamp == 'Photocell'){
      $data = LampPhotocell::findorFail($id);
    }
    return response()->json($data);
  }

  public function storeOrUpdateLampData(Request $request)
  {
    $data = $request->except('_token');
    if ($data['type'] == 'Current') {
      $LampCurrent = LampCurrent::updateOrCreate(['id' => $request->id], $data);
    } elseif ($data['type'] == 'Voltage') {
      $LampVoltage = LampVoltage::updateOrCreate(['id' => $request->id], $data);
    } elseif ($data['type'] == 'Photocell') {
      $LampPhotocell = LampPhotocell::updateOrCreate(['id' => $request->id], $data);
    } 
    return redirect()->route('streetlight-details', $data['streetlight_id']);
  }

  // Store or Update Lamp Graph Data
  public function fetchLampGraphData($id, $lamp)
  {
    $data = [];
    if($lamp == 'Current'){
      $data = LampCurrentGraph::findorFail($id);
    }elseif($lamp == 'Voltage'){
      $data = LampVoltageGraph::findorFail($id);
    }elseif($lamp == 'Photocell'){
      $data = LampPhotocellGraph::findorFail($id);
    }
    return response()->json($data);
  }

  public function storeOrUpdateLampGraphData(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 2000);
    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    } else {
      if ($data['type'] == 'Current') {
        $LampCurrent = LampCurrentGraph::updateOrCreate(['id' => $request->id], $data);
      } elseif ($data['type'] == 'Voltage') {
        $LampVoltage = LampVoltageGraph::updateOrCreate(['id' => $request->id], $data);
      } elseif ($data['type'] == 'Photocell') {
        $LampPhotocell = LampPhotocellGraph::updateOrCreate(['id' => $request->id], $data);
      }
      return redirect()->route('streetlight-details', $data['streetlight_id']);
    }
  }

  public function MinMaxValidation($request, $min, $max)
  {
    $inputAttributes = $request->except('_token', 'id', 'type', 'streetlight_id');

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
