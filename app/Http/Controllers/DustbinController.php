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
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Rule\Parameters;

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

    return response()->json(['message' => 'List of all Dustbins', 'data' => $formattedBins]);
  }

  public function getAllBin()
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

    return view('content.dustbin.dustbin', compact('bin_usages', 'bin_waste_removals', 'bin_repair_costs', 'bin_maintenance_costs', 'bin_response_times', 'bin_satisfied_publics', 'bin_waste_breakdowns', 'dustbinId'));
  }

  private function filterDateTimeStrings($array)
  {
    return array_filter($array, function ($value, $key) {
      $filteredKeys = ["id", "dustbin_id"];
      return !in_array($key, $filteredKeys) && !is_string($value) && !strtotime($value);
    }, ARRAY_FILTER_USE_BOTH);
  }


  // create or Update Bins
  public function fetchDustbin($id)
  {
    $record = Dustbin::findOrFail($id);
    return response()->json($record);
  }

  // create or Update Bins
  public function storeOrUpdateDustbin(Request $request)
  {
    $data = $request->except('_token');
    $data['last_update'] = Carbon::now()->format('Y-m-d H:i:s');

    if ($request->hasFile('photo')) {
      $photo = $request->file('photo');
      $extension = $photo->getClientOriginalExtension(); // Get the file extension
      $photoName = $request->id . $request->name . '.' . $extension; // Concatenate the ID with the extension

      if ($oldPhotoName = $photoName ?? null) {
        $oldPhotoPath = public_path('assets/img/dustbins') . '/' . $oldPhotoName;
        if (file_exists($oldPhotoPath)) {
          unlink($oldPhotoPath);
        }
      }

      $photo->move(public_path('assets/img/dustbins'), $photoName);

      $data['image'] = $photoName; // Adjust the path as needed
    }

    $dustbin = Dustbin::updateOrCreate(['id' => $request->id], $data);

    return redirect()->route('dustbin', compact('dustbin'));
  }

  // create or Update Bins Usage
  public function fetchBinUsage($id)
  {
    $record = BinUsage::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinUsage(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 9);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinUsage::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Waste removal
  public function fetchWasteRemoval($id)
  {
    $record = BinWasteRemoval::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinWasteRemoval(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 100);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinWasteRemoval::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Repair cost
  public function fetchRepairCost($id)
  {
    $record = BinRepairCost::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinRepairCost(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 125);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinRepairCost::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Maintenance cost
  public function fetchMaintenanceCost($id)
  {
    $record = BinMaintenanceCost::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinMaintenanceCost(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 125);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinMaintenanceCost::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Response time
  public function fetchResponseTime($id)
  {
    $record = BinResponseTime::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinResponseTime(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 100);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinResponseTime::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Public satisfaction
  public function fetchPublicSatisfaction($id)
  {
    $record = BinSatisfiedPublic::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinPublicSatisfaction(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 50);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinSatisfiedPublic::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  // create or Update Bins Waste breakdown
  public function fetchWasteBreakdown($id)
  {
    $record = BinWasteBreakdown::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateDustbinWasteBreakdown(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 100);

    if ($check !== true) {
      return redirect()->back()
        ->withErrors($check)
        ->withInput();
    } else {
      $dustbin = BinWasteBreakdown::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('dustbin-details', ['bin_id' => $dustbin->dustbin_id]);
    }
  }

  public function MinMaxValidation($request, $min, $max)
  {
    $inputAttributes = $request->except('_token', 'id', 'dustbin_id');
    // dd($inputAttributes);

    $rules = [];
    $messages = [];

    foreach ($inputAttributes as $attributeName => $attributeValue) {
      $rules[$attributeName] = 'required|numeric|min:' . $min . '|max:' . $max . '';

      $messages["$attributeName.min"] = str_replace('_', ' ', ucfirst($attributeName) . ' value must be between ' . $min . ' and ' . $max);
      $messages["$attributeName.max"] = str_replace('_', ' ', ucfirst($attributeName) . ' value must be between ' . $min . ' and ' . $max);
    }

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return $validator;
    } else {
      return true;
    }
  }
}
