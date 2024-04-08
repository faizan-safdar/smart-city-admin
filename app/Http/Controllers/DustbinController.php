<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dustbin;
use Carbon\Carbon;
use App\Models\BinUsage;
use App\Models\BinWasteRemoval;
use App\Models\BinRepairCost;
use App\Models\BinMaintenanceCost;
use App\Models\BinResponseTime;
use App\Models\BinSatisfiedPublic;
use App\Models\BinWasteBreakdown;


class DustbinController extends Controller
{
  // Get All bins
  public function getAllBins()
  {
    $bins = Dustbin::with('binUsage', 'binWasteRemoval', 'binRepairCost', 'binMaintenanceCost', 'binResponseTime', 'binSatisfiedPublic', 'binWasteBreakdown')->get();

    $formattedBins = [];
    foreach ($bins as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'name' => $bin->name,
        'text' => $bin->text,
        'last_update' => $bin->last_update,
        'fill_percentage' => $bin->fill_percentage,
        'image' => $bin->image,
        'bin_usage' => array_values($this->filterDateTimeStrings(($bin->binUsage->toArray()))),
        'bin_waste_removal' => array_values($this->filterDateTimeStrings(($bin->binWasteRemoval->toArray()))),
        'bin_repair_cost' => array_values($this->filterDateTimeStrings(($bin->binRepairCost->toArray()))),
        'bin_maintenance_cost' => array_values($this->filterDateTimeStrings(($bin->binMaintenanceCost->toArray()))),
        'bin_response_time' => array_values($this->filterDateTimeStrings(($bin->binResponseTime->toArray()))),
        'bin_satisfied_public' => array_values($this->filterDateTimeStrings(($bin->binSatisfiedPublic->toArray()))),
        'bin_waste_breakdown' => array_values($this->filterDateTimeStrings(($bin->binWasteBreakdown->toArray())))
      ];
      $formattedBins[] = $formattedBin;
    }
    // dd($formattedBins);
    return view('content.dustbin.dustbin', compact('formattedBins'));
  }

  public function getBinDetails($dustbinId)
  {
    $bins = Dustbin::with('binUsage', 'binWasteRemoval', 'binRepairCost', 'binMaintenanceCost', 'binResponseTime', 'binSatisfiedPublic', 'binWasteBreakdown')->get();

    $dustbin = Dustbin::findOrFail($dustbinId);
    $binUsages = BinUsage::where('dustbin_id', $dustbinId)->get();
    $binWasteRemovals = BinWasteRemoval::where('dustbin_id', $dustbinId)->get();
    $BinResponseTime = BinResponseTime::where('dustbin_id', $dustbinId)->get();
    $BinSatisfiedPublic = BinSatisfiedPublic::where('dustbin_id', $dustbinId)->get();
    $BinWasteBreakdown = BinWasteBreakdown::where('dustbin_id', $dustbinId)->get();
    $BinMaintenanceCost = BinMaintenanceCost::where('dustbin_id', $dustbinId)->get();
    $BinRepairCost = BinRepairCost::where('dustbin_id', $dustbinId)->get();


    $formattedBins = [];
    foreach ($bins as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'name' => $bin->name,
        'text' => $bin->text,
        'last_update' => $bin->last_update,
        'fill_percentage' => $bin->fill_percentage,
        'image' => $bin->image,
        'bin_usage' => array_values($this->filterDateTimeStrings(($bin->binUsage->toArray()))),
        'bin_waste_removal' => array_values($this->filterDateTimeStrings(($bin->binWasteRemoval->toArray()))),
        'bin_repair_cost' => array_values($this->filterDateTimeStrings(($bin->binRepairCost->toArray()))),
        'bin_maintenance_cost' => array_values($this->filterDateTimeStrings(($bin->binMaintenanceCost->toArray()))),
        'bin_response_time' => array_values($this->filterDateTimeStrings(($bin->binResponseTime->toArray()))),
        'bin_satisfied_public' => array_values($this->filterDateTimeStrings(($bin->binSatisfiedPublic->toArray()))),
        'bin_waste_breakdown' => array_values($this->filterDateTimeStrings(($bin->binWasteBreakdown->toArray())))
      ];
      $formattedBins[] = $formattedBin;
    }
    // dd($formattedBins);
    return view('content.dustbin.dustbin', compact('formattedBins'));
  }

  // private function filterDateTimeStrings($array)
  // {
  //   return array_filter($array, function ($value) {
  //     return !is_string($value) || !strtotime($value);
  //   });
  // }
  private function filterDateTimeStrings($array)
  {
    return array_filter($array, function ($value, $key) {
      $filteredKeys = ["id", "dustbin_id"];
      return !in_array($key, $filteredKeys) && !is_string($value) && !strtotime($value);
    }, ARRAY_FILTER_USE_BOTH);
  }


  // create or Update Bins
  public function storeOrUpdateDustbin(Request $request)
  {
    $data = $request->except('_token');
    $data['last_update'] = Carbon::now()->format('Y-m-d H:i:s');
    $dustbin = Dustbin::updateOrCreate(['id' => $request->id], $data);

    return response()->json(['message' => 'Dustbin created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Usage
  public function storeOrUpdateDustbinUsage(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinUsage::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin usage created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Waste removal
  public function storeOrUpdateDustbinWasteRemoval(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinWasteRemoval::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin Waste removal created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Waste removal
  public function storeOrUpdateDustbinResponseTime(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinResponseTime::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin response time created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Public satisfaction
  public function storeOrUpdateDustbinPublicSatisfaction(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinSatisfiedPublic::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin Public satisfaction created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Public satisfaction
  public function storeOrUpdateDustbinWasteBreakdown(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinWasteBreakdown::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin waste breakdown created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Public satisfaction
  public function storeOrUpdateDustbinMaintenanceCost(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinMaintenanceCost::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin Maintenance Cost created/updated successfully', 'data' => $dustbin]);
  }

  // create or Update Bins Public satisfaction
  public function storeOrUpdateDustbinRepairCost(Request $request)
  {
    $data = $request->except('_token');
    $dustbin = BinRepairCost::updateOrCreate(['id' => $request->id], $data);
    return response()->json(['message' => 'Dustbin Repair Cost created/updated successfully', 'data' => $dustbin]);
  }
}
