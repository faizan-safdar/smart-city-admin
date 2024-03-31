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

class StreetLightController extends Controller
{
  public function getStreetLight()
  {
    $data = StreetLight::with('lampVoltage', 'lampPhotocell', 'lampCurrent', 'lampVoltageGraph', 'lampPhotocellGraph', 'lampCurrentGraph')->get();
    return response()->json(['message' => 'Street Light data found successfully', 'data' => $data]);
  }

  public function storeOrUpdateStreetLight(Request $request)
  {
    $data = $request->except('_token');
    $data['last_contact'] = date($request->last_contact);
    $streetLight = StreetLight::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Street Light created/updated successfully', 'data' => $streetLight]);
  }

  public function storeOrUpdateLampVoltage(Request $request)
  {
    $data = $request->except('_token');
    $LampVoltage = LampVoltage::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Voltage created/updated successfully', 'data' => $LampVoltage]);
  }

  public function storeOrUpdateLampPhotocell(Request $request)
  {
    $data = $request->except('_token');
    $LampPhotocell = LampPhotocell::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Photocell created/updated successfully', 'data' => $LampPhotocell]);
  }

  public function storeOrUpdateLampCurrent(Request $request)
  {
    $data = $request->except('_token');
    $LampCurrent = LampCurrent::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Current created/updated successfully', 'data' => $LampCurrent]);
  }

  public function storeOrUpdateLampVoltageGraph(Request $request)
  {
    $data = $request->except('_token');
    $LampVoltage = LampVoltageGraph::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Voltage created/updated successfully', 'data' => $LampVoltage]);
  }

  public function storeOrUpdateLampPhotocellGraph(Request $request)
  {
    $data = $request->except('_token');
    $LampPhotocell = LampPhotocellGraph::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Photocell created/updated successfully', 'data' => $LampPhotocell]);
  }

  public function storeOrUpdateLampCurrentGraph(Request $request)
  {
    $data = $request->except('_token');
    $LampCurrent = LampCurrentGraph::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Lamp Current created/updated successfully', 'data' => $LampCurrent]);
  }
}
