<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DustbinController;

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
Route::get('/dustbins', [DustbinController::class, 'getAllBins']);
Route::post('/dustbin', [DustbinController::class, 'storeOrUpdateDustbin']);
Route::post('/dustbin/bin-usage', [DustbinController::class, 'storeOrUpdateDustbinUsage']);
Route::post('/dustbin/bin-waste-removal', [DustbinController::class, 'storeOrUpdateDustbinWasteRemoval']);
Route::post('/dustbin/bin-response-time', [DustbinController::class, 'storeOrUpdateDustbinResponseTime']);
Route::post('/dustbin/bin-satisfied-public', [DustbinController::class, 'storeOrUpdateDustbinPublicSatisfaction']);
Route::post('/dustbin/bin-waste-breakdown', [DustbinController::class, 'storeOrUpdateDustbinWasteBreakdown']);
Route::post('/dustbin/bin-maintenance-cost', [DustbinController::class, 'storeOrUpdateDustbinMaintenanceCost']);
Route::post('/dustbin/bin-repair-cost', [DustbinController::class, 'storeOrUpdateDustbinRepairCost']);
