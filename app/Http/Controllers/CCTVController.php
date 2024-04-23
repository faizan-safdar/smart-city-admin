<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CCTV;
use Illuminate\Support\Carbon;

class CCTVController extends Controller
{
  public function getAllCctv(Request $request)
  {
    $cctvs = CCTV::get();
    return response()->json(['message' => 'List of all CCTVs', 'data' => $cctvs]);
  }

  public function getAllCctvs(Request $request)
  {
    $cctvs = CCTV::get();
    return view('content.cctvs.cctvs', compact('cctvs'));
  }

  public function fetchCCTV($id)
  {
    $record = CCTV::findOrFail($id);
    return response()->json($record);
  }

  public function storeOrUpdateCctv(Request $request)
  {
    $data = $request->except('_token');
    $data['timestamp'] = Carbon::now()->format('Y-m-d H:i:s');
    $cctv = CCTV::updateOrCreate(['id' => $request->id], $data);

    return redirect()->route('cctv', compact('cctv'));
  }
}
