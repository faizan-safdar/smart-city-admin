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
    // return response()->json(['message' => 'Data Found!', 'data' => $success]);
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
    // $record = BinUsage::findOrFail($id);
    // return response()->json($record);
    return response()->json($record);
  }

  // public function storeOrUpdateTrafficSignalOne(Request $request)
  // {
  //   $data = $request->except('_token');
  //   $signalData = TrafficSignalOne::updateOrCreate(['id' => $request->id], $data);
  //   return response()->json(['message' => 'Signal One created/updated successfully', 'data' => $signalData]);
  // }
  // public function storeOrUpdateTrafficSignalTwo(Request $request)
  // {
  //   $data = $request->except('_token');
  //   $signalData = TrafficSignalTwo::updateOrCreate(['id' => $request->id], $data);
  //   return response()->json(['message' => 'Signal Two created/updated successfully', 'data' => $signalData]);
  // }
  // public function storeOrUpdateTrafficSignalThree(Request $request)
  // {
  //   $data = $request->except('_token');
  //   $signalData = TrafficSignalThree::updateOrCreate(['id' => $request->id], $data);
  //   return response()->json(['message' => 'Signal Three created/updated successfully', 'data' => $signalData]);
  // }
  // public function storeOrUpdateTrafficSignalFour(Request $request)
  // {
  //   $data = $request->except('_token');
  //   $signalData = TrafficSignalFour::updateOrCreate(['id' => $request->id], $data);
  //   return response()->json(['message' => 'Signal Four created/updated successfully', 'data' => $signalData]);
  // }

  public function storeOrUpdateTrafficSignal(Request $request)
  {
    $data = $request->except('_token');
    if ($request->signal == 'one') {
      $signalData = TrafficSignalOne::updateOrCreate(['id' => $request->id], $data);
      // return response()->json(['message' => 'Signal One created/updated successfully', 'data' => $signalData]);
    } elseif ($request->signal == 'two') {
      $signalData = TrafficSignalTwo::updateOrCreate(['id' => $request->id], $data);
      // return response()->json(['message' => 'Signal Two created/updated successfully', 'data' => $signalData]);
    } elseif ($request->signal == 'three') {
      $signalData = TrafficSignalThree::updateOrCreate(['id' => $request->id], $data);
      // return response()->json(['message' => 'Signal Three created/updated successfully', 'data' => $signalData]);
    } elseif ($request->signal == 'four') {
      $signalData = TrafficSignalFour::updateOrCreate(['id' => $request->id], $data);
      // return response()->json(['message' => 'Signal Four created/updated successfully', 'data' => $signalData]);
    }
    return redirect()->route('trafficsignals');
  }
}
