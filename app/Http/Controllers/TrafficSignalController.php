<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrafficSignalOne;
use App\Models\TrafficSignalTwo;
use App\Models\TrafficSignalThree;
use App\Models\TrafficSignalFour;

class TrafficSignalController extends Controller
{
  public function getSignalsData()
  {
    $success = [];
    $success['signalOne'] = TrafficSignalOne::get();
    $success['signalTwo'] = TrafficSignalTwo::get();
    $success['signalThree'] = TrafficSignalThree::get();
    $success['signalFour'] = TrafficSignalFour::get();
    return view('content.trafficsignals.trafficsignals', compact('success'));
  }

  public function fetchTrafficSignal($id, $signal)
  {
    $record = NULL;
    if ($signal == 'One') {
      $record = TrafficSignalOne::findOrFail($id);
      $record['signal'] = 'one';
    } elseif ($signal == 'Two') {
      $record = TrafficSignalTwo::findOrFail($id);
      $record['signal'] = 'two';
    } elseif ($signal == 'Three') {
      $record = TrafficSignalThree::findOrFail($id);
      $record['signal'] = 'three';
    } elseif ($signal == 'Four') {
      $record = TrafficSignalFour::findOrFail($id);
      $record['signal'] = 'four';
    }
    return response()->json($record);
  }

  public function storeOrUpdateTrafficSignal(Request $request)
  {
    $data = $request->except('_token');
    if ($request->signal == 'one') {
      $signalData = TrafficSignalOne::updateOrCreate(['id' => $request->id], $data);
    } elseif ($request->signal == 'two') {
      $signalData = TrafficSignalTwo::updateOrCreate(['id' => $request->id], $data);
    } elseif ($request->signal == 'three') {
      $signalData = TrafficSignalThree::updateOrCreate(['id' => $request->id], $data);
    } elseif ($request->signal == 'four') {
      $signalData = TrafficSignalFour::updateOrCreate(['id' => $request->id], $data);
    }

    return redirect()->route('trafficsignals');
  }
}
