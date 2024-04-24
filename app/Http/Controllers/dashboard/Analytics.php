<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\CCTV;
use App\Models\Dustbin;
use App\Models\Energy;
use App\Models\StreetLight;
use App\Models\TrafficSignalFour;
use App\Models\TrafficSignalOne;
use App\Models\TrafficSignalThree;
use App\Models\TrafficSignalTwo;
use App\Models\WaterManagement;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $bins = Dustbin::get();
    $cctvs = CCTV::get();
    $streetlights = StreetLight::get();
    $energy = Energy::get();
    $trafficSignalOne = TrafficSignalOne::get();
    $trafficSignalTwo = TrafficSignalTwo::get();
    $trafficSignalThree = TrafficSignalThree::get();
    $trafficSignalFour = TrafficSignalFour::get();
    $waterfloor = WaterManagement::get();

    return view('content.dashboard.dashboards-analytics', compact('bins', 'cctvs', 'streetlights', 'energy', 'trafficSignalOne', 'trafficSignalTwo', 'trafficSignalThree', 'trafficSignalFour', 'waterfloor'));
  }
}
