<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterManagement;
use App\Models\WaterEnergyUtilization;
use App\Models\WaterElectricityConsumption;
use App\Models\WaterEnergyBreakdown;
use App\Models\WaterWasteDischarge;
use App\Models\WaterAverageConsumption;
use App\Models\WaterUsageBreakdown;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WaterController extends Controller
{
  // Get Water Usage
  public function getWaterUsage(Request $request)
  {
    $water_id = 0;
    $waterFloors = WaterManagement::with('waterEnergyUtilizations', 'waterElectricityConsumption', 'waterEnergyBreakdown', 'waterWasteDischarge', 'waterAverageConsumption', 'waterUsageBreakdown')->get();
    $formattedWaters = [];
    foreach ($waterFloors as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'level_name' => $bin->level_name,
        'current_capacity' => $bin->current_capacity,
        'max_capacity' => $bin->max_capacity,
        'level_status' => $bin->level_status,
        'time' => $bin->time,
        'alarm_status' => $bin->alarm_status,
        'water_energy_utilizations' => array_merge(...array_map('array_values', $bin->waterEnergyUtilizations->toArray())),
        'water_electricity_consumption' => $this->filterMyArray($bin->waterElectricityConsumption->toArray(),'water_electricity_consumption'),
        // 'water_electricity_consumption' => $dataElectricity,
        'water_energy_breakdown' => array_merge(...array_map('array_values', $bin->waterEnergyBreakdown->toArray())),
        'water_waste_discharge' => array_merge(...array_map('array_values', $bin->waterWasteDischarge->toArray())),
        'water_average_consumption' => $this->filterMyArray($bin->waterAverageConsumption->toArray(),'water_average_consumption'),
        // 'water_average_consumption' => $dataWater,
        'water_usage_breakdown' => array_merge(...array_map('array_values', $bin->waterUsageBreakdown->toArray())),

      ];
      $formattedWaters[] = $formattedBin;
    }
    return response()->json(['message' => 'Water Floors Data!', 'data' => $formattedWaters]);
  }

  public function getWaterUsages(Request $request)
  {
    $water_id = 0;
    $waterFloors = WaterManagement::with('waterEnergyUtilizations', 'waterElectricityConsumption', 'waterEnergyBreakdown', 'waterWasteDischarge', 'waterAverageConsumption', 'waterUsageBreakdown')->get();
    $formattedWaters = [];
    foreach ($waterFloors as $bin) {
      $formattedBin = [
        'id' => $bin->id,
        'level_name' => $bin->level_name,
        'current_capacity' => $bin->current_capacity,
        'max_capacity' => $bin->max_capacity,
        'level_status' => $bin->level_status,
        'time' => $bin->time,
        'alarm_status' => $bin->alarm_status,
        'water_energy_utilizations' => array_merge(...array_map('array_values', $bin->waterEnergyUtilizations->toArray())),
        'water_electricity_consumption' => $this->filterMyArray($bin->waterElectricityConsumption->toArray(),'water_electricity_consumption'),
        // 'water_electricity_consumption' => $dataElectricity,
        'water_energy_breakdown' => array_merge(...array_map('array_values', $bin->waterEnergyBreakdown->toArray())),
        'water_waste_discharge' => array_merge(...array_map('array_values', $bin->waterWasteDischarge->toArray())),
        'water_average_consumption' => $this->filterMyArray($bin->waterAverageConsumption->toArray(),'water_average_consumption'),
        // 'water_average_consumption' => $dataWater,
        'water_usage_breakdown' => array_merge(...array_map('array_values', $bin->waterUsageBreakdown->toArray())),

      ];
      $formattedWaters[] = $formattedBin;
    }
    return view('content.water.water', compact('formattedWaters', 'water_id'));
  }

  private function filterMyArray($array, $flag)
  {
    $result = [];

    // Iterate through the input array
    for ($i = 0; $i < count($array); $i++) {
      $month = $array[$i]['month'];
      $value = 0;
      if ($flag === 'water_electricity_consumption') {
        $value = $array[$i]['energy_usage'];
      }
      elseif ($flag === 'water_average_consumption') {
        $value = intval($array[$i]['value']);
      }

      // If the month is not already in the result array, initialize it
      if (!isset($result[$month])) {
        $result[$month] = [];
      }

      // Add the consumption value to the array for the corresponding month
      $result[$month][] = $value;
    }

    return $result;
  }

  // fetch Water Usage 
  public function fetchWaterUsage($id)
  {
    $record = WaterManagement::findOrFail($id);
    return response()->json($record);
  }

  // Store or Update Water Usage
  public function storeOrUpdateWaterUsage(Request $request)
  {
    $data = $request->except('_token');
    $data['time'] = Carbon::now();
    $waterData = WaterManagement::updateOrCreate(['id' => $request->id], $data);
    // return response()->json(['message' => 'Water Floor added / updated!', 'data' => $waterData]);
    return redirect()->route('water-usage');
  }

  // Fetch Water Usage Details Data
  public function fetchWaterUsageDetails($water_id)
  {
    $waterEnergyUtilizations = WaterEnergyUtilization::where('water_id', $water_id)->get();
    $unsortwaterElectricityConsumptions = WaterElectricityConsumption::where('water_id', $water_id)
    ->select(DB::raw('month'), DB::raw('SUM(energy_usage) as total_energy_usage'))
    ->groupBy(DB::raw('month'))
    ->get();

    // Sort waterElectricityConsumptions by month
    $waterElectricityConsumptions = $this->monthlysort($unsortwaterElectricityConsumptions);

    $waterEnergyBreakdowns = WaterEnergyBreakdown::where('water_id', $water_id)->get();
    $waterWasteDischarges = WaterWasteDischarge::where('water_id', $water_id)->get();
    $unsortwaterAverageConsumptions = WaterAverageConsumption::where('water_id', $water_id)
    ->select(DB::raw('month'), DB::raw('SUM(value) as total_value'))
    ->groupBy(DB::raw('month'))
    ->get();

    // Sort waterAverageConsumptions by month
    $waterAverageConsumptions = $this->monthlysort($unsortwaterAverageConsumptions);
    
    $waterUsageBreakdowns = WaterUsageBreakdown::where('water_id', $water_id)->get();

    return view('content.water.water', compact('waterEnergyUtilizations', 'waterElectricityConsumptions', 'waterEnergyBreakdowns', 'waterWasteDischarges', 'waterAverageConsumptions', 'waterUsageBreakdowns', 'water_id'));
  }

  // Fetch Water Electricity Consumption Monthly Data
  public function MonthlyWaterElectricityConsumption($month, $water_id)
  {
    $waterElectricityConsumptions = WaterElectricityConsumption::where('water_id', $water_id)
    ->where('month', $month)
    ->get();

    $waterElectricityConsumptions = $this->monthlysort($waterElectricityConsumptions);
    $type = 'electricity';
    
    return view('content.water.WaterConsumption', compact('waterElectricityConsumptions', 'type', 'water_id'));
  }

  // Fetch Water Electricity Consumption Singe Data
  public function fetchElectricityConsumption($id)
  {
    $record = WaterElectricityConsumption::findOrFail($id);
    return response()->json($record);
  }

  // Store or Update Water Electricity Consumption
  public function waterElectricityConsumption(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 2000, ['_token', 'id', 'water_id', 'month', 'room_name']);
    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    }else{
      $WaterElectricityConsumption = WaterElectricityConsumption::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('monthly-electricity-consumption', ['month' => $data['month'], 'water_id' => $data['water_id']]);
    }
  }
  
  // Sort and Camel Case Month Conversion
  public function monthlysort($data){
    $monthOrder = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'Octobar', 'November', 'December'
    ];
    $sorteddata = $data->sortBy(function ($item) use ($monthOrder) {
      return array_search(ucfirst($item->month), $monthOrder);
    })->map(function ($item) {
      $item->month = ucfirst($item->month); // Convert first character to uppercase
      return $item;
    });

    return $sorteddata;
  }

  // Fetch Water Energy Utilization Data
  public function fetchWaterEnergyUtilization($id)
  {
    $record = WaterEnergyUtilization::findOrFail($id);
    return response()->json($record);
  }

  // Store or Update Water Energy Utilization
  public function storeOrUpdateEnergyUtilization(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 5000, ['_token', 'id', 'water_id']);

    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    }else {
      $waterData = WaterEnergyUtilization::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('water-usage-details', $data['water_id']);
    }
  }

  // Fetch Energy Breakdown Data
  public function fetchWaterEnergyBreakdown($id)
  {
    $record = WaterEnergyBreakdown::findOrFail($id);
    return response()->json($record);
  }

  // Store or Update Water Energy Breakdown
  public function waterEnergyBreakdown(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 100, ['_token', 'id', 'water_id']);

    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    }else {
      $WaterEnergyBreakdown = WaterEnergyBreakdown::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('water-usage-details', $data['water_id']);
    }
  }

  // Fetch Usage Breakdown and Waste Discharge Data
  public function fetchUsageBreakdownWasteDischarges($id, $type)
  {
    $record = [];
    if ($type == 'Usage Breakdown') {
      $record = WaterUsageBreakdown::findOrFail($id); 
    }
    elseif ($type == 'Waste Discharge') {
      $record = WaterWasteDischarge::findOrFail($id);
    }

    return response()->json($record);
  }

  // private function filterDateTimeStrings($array)
  // {
  //   return array_filter($array, function ($value, $key) {
  //     $filteredKeys = ["id", "water_id"];
  //     return !in_array($key, $filteredKeys) && !is_array($value) && !is_string($value) && !strtotime($value);
  //   }, ARRAY_FILTER_USE_BOTH);
  // }


  public function storeOrUpdateUsageBreakdownWasteDischarges(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 100, ['_token', 'id', 'water_id', 'type']);

    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    } else {
      if ($data['type'] == 'Usage Breakdown'
      ) {
        $WaterUsageBreakdown = WaterUsageBreakdown::updateOrCreate(['id' => $request->id], $data);
      } elseif ($data['type'] == 'Waste Discharge') {
        $WaterWasteDischarge = WaterWasteDischarge::updateOrCreate(['id' => $request->id], $data);
      }
      return redirect()->route('water-usage-details', $data['water_id']);
    }
  }

  // Fetch Water Average Consumption Monthly Data
  public function MonthlyWaterAverageConsumption($month, $water_id)
  {
    $waterAverageConsumptions = WaterAverageConsumption::where('water_id', $water_id)
    ->where('month', $month)
    ->get();

    $waterAverageConsumptions = $this->monthlysort($waterAverageConsumptions);
    $type = 'average';
    
    return view('content.water.WaterConsumption', compact('waterAverageConsumptions', 'type', 'water_id'));
  }

  // Fetch Water Average Consumption Singe Data
  public function fetchAverageConsumption($id)
  {
    $record = WaterAverageConsumption::findOrFail($id);
    return response()->json($record);
  }

  // Store or Update Water Average Consumption
  public function waterAverageConsumption(Request $request)
  {
    $data = $request->except('_token');

    $check = $this->MinMaxValidation($request, 0, 2000, ['_token', 'id', 'water_id', 'month', 'type']);

    if ($check !== true) {
      return redirect()->back()->withErrors($check)->withInput();
    }else {
      $WaterAverageConsumption = WaterAverageConsumption::updateOrCreate(['id' => $request->id], $data);
      return redirect()->route('monthly-average-consumption', ['month' => $data['month'], 'water_id' => $data['water_id']]);
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
