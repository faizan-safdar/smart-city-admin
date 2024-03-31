<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DustbinController;
use App\Http\Controllers\CCTVController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\StreetLightController;
use App\Http\Controllers\TrafficSignalController;
use App\Http\Controllers\EnergyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
// Dustbins Routes
Route::get('/dustbins', [DustbinController::class, 'getAllBins']);
Route::post('/dustbin', [DustbinController::class, 'storeOrUpdateDustbin']);
Route::post('/dustbin/bin-usage', [DustbinController::class, 'storeOrUpdateDustbinUsage']);
Route::post('/dustbin/bin-waste-removal', [DustbinController::class, 'storeOrUpdateDustbinWasteRemoval']);
Route::post('/dustbin/bin-response-time', [DustbinController::class, 'storeOrUpdateDustbinResponseTime']);
Route::post('/dustbin/bin-satisfied-public', [DustbinController::class, 'storeOrUpdateDustbinPublicSatisfaction']);
Route::post('/dustbin/bin-waste-breakdown', [DustbinController::class, 'storeOrUpdateDustbinWasteBreakdown']);
Route::post('/dustbin/bin-maintenance-cost', [DustbinController::class, 'storeOrUpdateDustbinMaintenanceCost']);
Route::post('/dustbin/bin-repair-cost', [DustbinController::class, 'storeOrUpdateDustbinRepairCost']);

// CCTV Routes
Route::get('/cctv', [CCTVController::class, 'getAllCctv']);
Route::post('/cctv', [CCTVController::class, 'storeOrUpdateCctv']);

// Water Building Routes
Route::get('/water-usage', [WaterController::class, 'getWaterUsage']);
Route::post('/water-floor-data', [WaterController::class, 'waterFloorData']);
Route::post('/water-energy-utilization', [WaterController::class, 'waterEnergyUtilization']);
Route::post('/water-electricity-consumption', [WaterController::class, 'waterElectricityConsumption']);
Route::post('/water-energy-breakdown', [WaterController::class, 'waterEnergyBreakdown']);
Route::post('/water-waste-discharge', [WaterController::class, 'waterWasteDischarge']);
Route::post('/water-average-consumption', [WaterController::class, 'waterAverageConsumption']);
Route::post('/water-usage-breakdown', [WaterController::class, 'waterUsageBreakdown']);

// Street Light Routes
Route::get('/street-light', [StreetLightController::class, 'getStreetLight']);
Route::post('/street-light', [StreetLightController::class, 'storeOrUpdateStreetLight']);
Route::post('/lamp-voltage', [StreetLightController::class, 'storeOrUpdateLampVoltage']);
Route::post('/lamp-photocell', [StreetLightController::class, 'storeOrUpdateLampPhotocell']);
Route::post('/lamp-current', [StreetLightController::class, 'storeOrUpdateLampCurrent']);
Route::post('/lamp-voltage-graph', [StreetLightController::class, 'storeOrUpdateLampVoltageGraph']);
Route::post('/lamp-photocell-graph', [StreetLightController::class, 'storeOrUpdateLampPhotocellGraph']);
Route::post('/lamp-current-graph', [StreetLightController::class, 'storeOrUpdateLampCurrentGraph']);

// Traffic Signal Routes
Route::get('/traffic-signal', [TrafficSignalController::class, 'getSignalsData']);
Route::post('/traffic-signal-one', [TrafficSignalController::class, 'storeOrUpdateTrafficSignalOne']);
Route::post('/traffic-signal-two', [TrafficSignalController::class, 'storeOrUpdateTrafficSignalTwo']);
Route::post('/traffic-signal-three', [TrafficSignalController::class, 'storeOrUpdateTrafficSignalthree']);
Route::post('/traffic-signal-four', [TrafficSignalController::class, 'storeOrUpdateTrafficSignalFour']);

// Building Energy Routes
Route::get('/energy', [EnergyController::class, 'getEnergyData']);
Route::post('/energy', [EnergyController::class, 'storeOrUpdateEnergy']);
Route::post('/power', [EnergyController::class, 'storeOrUpdatePower']);
Route::post('/acmv', [EnergyController::class, 'storeOrUpdateACMV']);
Route::post('/ele-ecvs', [EnergyController::class, 'storeOrUpdateELECVS']);
Route::post('/lighting', [EnergyController::class, 'storeOrUpdateLighting']);
Route::post('/mixed-loads', [EnergyController::class, 'storeOrUpdateMixedLoads']);
Route::post('/energy-connection-type', [EnergyController::class, 'storeOrUpdateConnectionTypes']);
Route::post('/usage-hours', [EnergyController::class, 'storeOrUpdateUsageHours']);
