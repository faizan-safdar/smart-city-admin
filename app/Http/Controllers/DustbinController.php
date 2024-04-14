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
    $dustbinId = 0;
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
    return view('content.dustbin.dustbin', compact('formattedBins', 'dustbinId'));
  }

  public function getBinDetails($dustbinId)
  {
    // dd($dustbinId);
    $bin_usages = BinUsage::where('dustbin_id', $dustbinId)->get();
    $bin_waste_removals = BinWasteRemoval::where('dustbin_id', $dustbinId)->get();
    $bin_waste_removals = BinWasteRemoval::where('dustbin_id', $dustbinId)->get();
    $bin_repair_costs = BinRepairCost::where('dustbin_id', $dustbinId)->get();
    $bin_maintenance_costs = BinMaintenanceCost::where('dustbin_id', $dustbinId)->get();
    $bin_response_times = BinResponseTime::where('dustbin_id', $dustbinId)->get();
    $bin_satisfied_publics = BinSatisfiedPublic::where('dustbin_id', $dustbinId)->get();
    $bin_waste_breakdowns = BinWasteBreakdown::where('dustbin_id', $dustbinId)->get();

    $bins = Dustbin::with('binUsage', 'binWasteRemoval', 'binRepairCost', 'binMaintenanceCost', 'binResponseTime', 'binSatisfiedPublic', 'binWasteBreakdown')
    ->where('id', $dustbinId)
    ->get();

    // $formattedBins = [];
    // foreach ($bins as $bin) {
    //   $formattedBin = [
    //     'id' => $bin->id,
    //     'name' => $bin->name,
    //     'text' => $bin->text,
    //     'last_update' => $bin->last_update,
    //     'fill_percentage' => $bin->fill_percentage,
    //     'image' => $bin->image,
    //     'bin_usage' => $this->filterDateTimeStrings(($bin->binUsage->toArray())),
    //     'bin_waste_removal' => $this->filterDateTimeStrings(($bin->binWasteRemoval->toArray())),
    //     'bin_repair_cost' => $this->filterDateTimeStrings(($bin->binRepairCost->toArray())),
    //     'bin_maintenance_cost' => $this->filterDateTimeStrings(($bin->binMaintenanceCost->toArray())),
    //     'bin_response_time' => $this->filterDateTimeStrings(($bin->binResponseTime->toArray())),
    //     'bin_satisfied_public' => $this->filterDateTimeStrings(($bin->binSatisfiedPublic->toArray())),
    //     'bin_waste_breakdown' => $this->filterDateTimeStrings(($bin->binWasteBreakdown->toArray()))
    //   ];
    //   $formattedBins[] = $formattedBin;
    // }
    // dd($formattedBins);
    return view('content.dustbin.dustbin', compact('bin_usages', 'bin_waste_removals', 'bin_repair_costs', 'bin_maintenance_costs', 'bin_response_times', 'bin_satisfied_publics', 'bin_waste_breakdowns', 'dustbinId'));
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
