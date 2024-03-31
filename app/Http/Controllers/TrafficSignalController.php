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
    $success['signalOne'] = TrafficSignalOne::first();
    $success['signalTwo'] = TrafficSignalTwo::first();
    $success['signalThree'] = TrafficSignalThree::first();
    $success['signalFour'] = TrafficSignalFour::first();
    return response()->json(['message' => 'Data Found!', 'data' => $success]);
  }

  public function storeOrUpdateTrafficSignalOne(Request $request)
  {
    $data = $request->except('_token');
    $signalData = TrafficSignalOne::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Signal One created/updated successfully', 'data' => $signalData]);
  }
  public function storeOrUpdateTrafficSignalTwo(Request $request)
  {
    $data = $request->except('_token');
    $signalData = TrafficSignalTwo::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Signal Two created/updated successfully', 'data' => $signalData]);
  }
  public function storeOrUpdateTrafficSignalThree(Request $request)
  {
    $data = $request->except('_token');
    $signalData = TrafficSignalThree::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Signal Three created/updated successfully', 'data' => $signalData]);
  }
  public function storeOrUpdateTrafficSignalFour(Request $request)
  {
    $data = $request->except('_token');
    $signalData = TrafficSignalFour::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Signal Four created/updated successfully', 'data' => $signalData]);
  }

}
