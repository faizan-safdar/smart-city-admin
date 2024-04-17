@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Dustbin - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>

  function openEditBinUsage(recordId) {
    $.ajax({
    url: '/fetchBinUsage/' + recordId,
    type: 'GET',
    success: function(data) {
      $('#eighth1').val(data.eighth_1);
      $('#eighth2').val(data.eighth_2);
      $('#eighth3').val(data.eighth_3);
      $('#eighth4').val(data.eighth_4);
      $('#eighth5').val(data.eighth_5);
      $('#eighth6').val(data.eighth_6);
      
      $('#BinUsageid').val(recordId);
    
      $('#editDustbinusage').modal('show');
    }
    });
  }

  function openEditWasteRemoval(recordId) {
    $.ajax({
    url: '/fetchWasteRemoval/' + recordId,
    type: 'GET',
    success: function(data) {
      $('#day_1').val(data.day_1);
      $('#day_2').val(data.day_2);
      $('#day_3').val(data.day_3);
      $('#day_4').val(data.day_4);
      $('#day_5').val(data.day_5);
      $('#day_6').val(data.day_6);
      $('#day_7').val(data.day_7);
      $('#day_8').val(data.day_8);
      $('#day_9').val(data.day_9);
      $('#day_10').val(data.day_10);
      $('#day_11').val(data.day_11);
      $('#day_12').val(data.day_12);
      $('#day_13').val(data.day_13);
      $('#day_14').val(data.day_14);
      $('#day_15').val(data.day_15);
      $('#day_16').val(data.day_16);
      $('#day_17').val(data.day_17);
      $('#day_18').val(data.day_18);
      $('#day_19').val(data.day_19);
      $('#day_20').val(data.day_20);
      $('#day_21').val(data.day_21);
      $('#day_22').val(data.day_22);
      $('#day_23').val(data.day_23);
      $('#day_24').val(data.day_24);
      $('#day_25').val(data.day_25);
      $('#day_26').val(data.day_26);
      $('#day_27').val(data.day_27);
      $('#day_28').val(data.day_28);
      $('#day_29').val(data.day_29);
      $('#day_30').val(data.day_30);
      
      $('#WasteRemovalid').val(recordId);
      // $('#dustbin_id').val(data.dustbin_id);
    
      $('#editWasteRemoval').modal('show');
    }
    });
  }

  function openEditRepairCost(recordId) {
    $.ajax({
    url: '/fetchRepairCost/' + recordId,
    type: 'GET',
    success: function(data) {
      $('#jan').val(data.jan);
      $('#feb').val(data.feb);
      $('#mar').val(data.mar);
      $('#apr').val(data.apr);
      $('#may').val(data.may);
      $('#jun').val(data.jun);
      $('#jul').val(data.jul);
      $('#aug').val(data.aug);
      $('#sep').val(data.sep);
      $('#oct').val(data.oct);
      $('#nov').val(data.nov);
      $('#dec').val(data.dec);
      
      $('#RepairCostid').val(recordId);
    
      $('#editRepairCost').modal('show');
    }
    });
  }
</script>
@endsection

@section('content')

@if (!$dustbinId)

<div class="card">
  <h5 class="card-header text-bolder">Dustbins Data</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr>
          <th style="text-size: 20px;">Image</th>
          <th>Name</th>
          <th>Text</th>
          <th>Fill Percentage</th>
          <th>Last Update</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($formattedBins as $bin)
        <tr>
          <td><img src="{{ $bin['image'] }}" alt="Dustbin" width="30" height="30" class="rounded-circle"></td>
          <td><span class="fw-medium">{{ $bin['name'] }}</span></td>
          <td>{{ $bin['text'] }}</td>
          <td>{{ $bin['fill_percentage'] }}</td>
          <td>{{ $bin['last_update'] }}</td>
          {{-- <td><a class="btn btn-primary btn-sm text-white">View</a></span></td> --}}
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin['id']) }}">View</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@elseif ($dustbinId)
{{-- Dustbin Usage Table --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Usage</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Eighth 1</th>
          <th>Eighth 2</th>
          <th>Eighth 3</th>
          <th>Eighth 4</th>
          <th>Eighth 5</th>
          <th>Eighth 6</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_usages as $bin_usage)
        <tr id="bin-usage-{{ $bin_usage['id'] }}" class="text-center">
          <td><span class="fw-medium">{{ $bin_usage['eighth_1'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_2'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_3'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_4'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_5'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_6'] }}</span></td>
          <td><button class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" onclick="openEditBinUsage({{ $bin_usage['id'] }})">Update</button></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Waste Removal Table --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Waste Removal</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      @foreach ($bin_waste_removals as $bin_waste_removal)
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Day 1</th>
          <th>Day 2</th>
          <th>Day 3</th>
          <th>Day 4</th>
          <th>Day 5</th>
          <th>Day 6</th>
          <th>Day 7</th>
          <th>Day 8</th>
          <th>Day 9</th>
          <th>Day 10</th>
          <th class=border-bottom-0></th>
        </tr>
        <tr class="text-center">
          <th>Day 11</th>
          <th>Day 12</th>
          <th>Day 13</th>
          <th>Day 14</th>
          <th>Day 15</th>
          <th>Day 16</th>
          <th>Day 17</th>
          <th>Day 18</th>
          <th>Day 19</th>
          <th>Day 20</th>
          <th class="border-bottom-0">Action</th>

        </tr>
        <tr class="text-center">
          <th>Day 21</th>
          <th>Day 22</th>
          <th>Day 23</th>
          <th>Day 24</th>
          <th>Day 25</th>
          <th>Day 26</th>
          <th>Day 27</th>
          <th>Day 28</th>
          <th>Day 29</th>
          <th>Day 30</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_waste_removal['day_1'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_2'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_3'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_4'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_5'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_6'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_7'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_8'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_9'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_10'] }}</span></td>
        </tr>
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_waste_removal['day_11'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_12'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_13'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_14'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_15'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_16'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_17'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_18'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_19'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_20'] }}</span></td>
          <td class="border-bottom-0"><a class="btn btn-primary btn-sm text-white" onclick="openEditWasteRemoval({{ $bin_waste_removal['id'] }})">Update</a></span></td>
        </tr>
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_waste_removal['day_21'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_22'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_23'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_24'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_25'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_26'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_27'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_28'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_29'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_removal['day_30'] }}</span></td>
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
</div>
{{-- Dustbin Repair Cost --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Repair Cost</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Jan</th>
          <th>Feb</th>
          <th>March</th>
          <th>April</th>
          <th>May</th>
          <th>June</th>
          <th>July</th>
          <th>Aug</th>
          <th>Sep</th>
          <th>Oct</th>
          <th>Nov</th>
          <th>Dec</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_repair_costs as $bin_repair_cost)
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_repair_cost['jan'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['feb'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['mar'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['apr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['may'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['jun'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['jul'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['aug'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['sep'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['oct'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['nov'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_repair_cost['dec'] }}</span></td>
          <td><a class="btn btn-primary btn-sm text-white"
            onclick="openEditRepairCost({{ $bin_repair_cost['id'] }})">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Dustbin Maintenance Cost --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Maintainance Cost</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Jan</th>
          <th>Feb</th>
          <th>March</th>
          <th>April</th>
          <th>May</th>
          <th>June</th>
          <th>July</th>
          <th>Aug</th>
          <th>Sep</th>
          <th>Oct</th>
          <th>Nov</th>
          <th>Dec</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_maintenance_costs as $bin_maintain_cost)
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_maintain_cost['jan'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['feb'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['mar'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['apr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['may'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['jun'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['jul'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['aug'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['sep'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['oct'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['nov'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_maintain_cost['dec'] }}</span></td>
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin_maintain_cost['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Dustbin Response Time --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Response Time</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>1 Hour</th>
          <th>2 Hours</th>
          <th>4 Hours</th>
          <th>4 Plus Hours</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_response_times as $bin_response_time)
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_response_time['1_hr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_response_time['2_hr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_response_time['4_hr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_response_time['4_plus_hr'] }}</span></td>
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin_response_time['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Dustbin Satisfied Public --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Satisfied Public</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Jan</th>
          <th>Feb</th>
          <th>March</th>
          <th>April</th>
          <th>May</th>
          <th>June</th>
          <th>July</th>
          <th>Aug</th>
          <th>Sep</th>
          <th>Oct</th>
          <th>Nov</th>
          <th>Dec</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_satisfied_publics as $bin_satisfied_public)
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_satisfied_public['jan'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['feb'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['mar'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['apr'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['may'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['jun'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['jul'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['aug'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['sep'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['oct'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['nov'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_satisfied_public['dec'] }}</span></td>
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin_satisfied_public['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Dustbin Waste Breakdown --}}
<div class="card mb-4">
  <h5 class="card-header text-bolder">Waste Breakdown</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
      <thead class="table-border-bottom-1 table-primary">
        <tr class="text-center">
          <th>Organic Waste</th>
          <th>Bottles Cans</th>
          <th>Paper Packaging</th>
          <th>Cardboard</th>
          <th>Other Waste</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_waste_breakdowns as $bin_waste_breakdown)
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_waste_breakdown['organic_waste'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_breakdown['bottles_cans'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_breakdown['paper_packaging'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_breakdown['cardboard'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_waste_breakdown['other_waste'] }}</span></td>
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin_waste_breakdown['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


{{-- Dusbin Usage Update Modal --}}
<div class="modal fade" id="editDustbinusage" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Update Bin Usage</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('dustbin-update') }}" method="post">
          @csrf
          <div class="row g-3">
            <div class="col-6 mb-3">
              <label for="eighth1" class="form-label">Eight 1</label>
              <input type="text" id="eighth1" class="form-control" name="eighth_1" required>
              <input type="hidden" name="id" id="BinUsageid">
            </div>
            <div class="col-6 mb-3">
              <label for="eighth2" class="form-label">Eight 2</label>
              <input type="text" id="eighth2" class="form-control" name="eighth_2" required>
            </div>
            <div class="col-6 mb-3">
              <label for="eighth3" class="form-label">Eight 3</label>
              <input type="text" id="eighth3" class="form-control" name="eighth_3" required>
            </div>
            <div class="col-6 mb-3">
              <label for="eighth4" class="form-label">Eight 4</label>
              <input type="text" id="eighth4" class="form-control" name="eighth_4" required>
            </div>
            <div class="col-6 mb-3">
              <label for="eighth5" class="form-label">Eight 5</label>
              <input type="text" id="eighth5" class="form-control" name="eighth_5" required>
            </div>
            <div class="col-6 mb-3">
              <label for="eighth6" class="form-label">Eight 6</label>
              <input type="text" id="eighth6" class="form-control" name="eighth_6" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- Waste Removal Update Modal --}}
<div class="modal fade" id="editWasteRemoval" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Update Bin Waste Removal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('dustbin-waste-removal') }}" method="post">
          @csrf
          <div class="row g-3">
            <div class="col-3 mb-3">
              <label for="day_1" class="form-label">Day 1</label>
              <input type="text" id="day_1" class="form-control" name="day_1" required>
              <input type="hidden" name="id" id="WasteRemovalid">
            </div>
            <div class="col-3 mb-3">
              <label for="day_2" class="form-label">Day 2</label>
              <input type="text" id="day_2" class="form-control" name="day_2" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_3" class="form-label">Day 3</label>
              <input type="text" id="day_3" class="form-control" name="day_3" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_4" class="form-label">Day 4</label>
              <input type="text" id="day_4" class="form-control" name="day_4" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_5" class="form-label">Day 5</label>
              <input type="text" id="day_5" class="form-control" name="day_5" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_6" class="form-label">Day 6</label>
              <input type="text" id="day_6" class="form-control" name="day_6" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_7" class="form-label">Day 7</label>
              <input type="text" id="day_7" class="form-control" name="day_7" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_8" class="form-label">Day 8</label>
              <input type="text" id="day_8" class="form-control" name="day_8" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_9" class="form-label">Day 9</label>
              <input type="text" id="day_9" class="form-control" name="day_9" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_10" class="form-label">Day 10</label>
              <input type="text" id="day_10" class="form-control" name="day_10" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_11" class="form-label">Day 11</label>
              <input type="text" id="day_11" class="form-control" name="day_11" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_12" class="form-label">Day 12</label>
              <input type="text" id="day_12" class="form-control" name="day_12" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_13" class="form-label">Day 13</label>
              <input type="text" id="day_13" class="form-control" name="day_13" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_14" class="form-label">Day 14</label>
              <input type="text" id="day_14" class="form-control" name="day_14" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_15" class="form-label">Day 15</label>
              <input type="text" id="day_15" class="form-control" name="day_15" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_16" class="form-label">Day 16</label>
              <input type="text" id="day_16" class="form-control" name="day_16" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_17" class="form-label">Day 17</label>
              <input type="text" id="day_17" class="form-control" name="day_17" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_18" class="form-label">Day 18</label>
              <input type="text" id="day_18" class="form-control" name="day_18" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_19" class="form-label">Day 19</label>
              <input type="text" id="day_19" class="form-control" name="day_19" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_20" class="form-label">Day 20</label>
              <input type="text" id="day_20" class="form-control" name="day_20" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_21" class="form-label">Day 21</label>
              <input type="text" id="day_21" class="form-control" name="day_21" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_22" class="form-label">Day 22</label>
              <input type="text" id="day_22" class="form-control" name="day_22" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_23" class="form-label">Day 23</label>
              <input type="text" id="day_23" class="form-control" name="day_23" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_24" class="form-label">Day 24</label>
              <input type="text" id="day_24" class="form-control" name="day_24" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_25" class="form-label">Day 25</label>
              <input type="text" id="day_25" class="form-control" name="day_25" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_26" class="form-label">Day 26</label>
              <input type="text" id="day_26" class="form-control" name="day_26" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_27" class="form-label">Day 27</label>
              <input type="text" id="day_27" class="form-control" name="day_27" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_28" class="form-label">Day 28</label>
              <input type="text" id="day_28" class="form-control" name="day_28" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_29" class="form-label">Day 29</label>
              <input type="text" id="day_29" class="form-control" name="day_29" required>
            </div>
            <div class="col-3 mb-3">
              <label for="day_30" class="form-label">Day 30</label>
              <input type="text" id="day_30" class="form-control" name="day_30" required>
            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- Repair Cost Update Modal --}}
<div class="modal fade" id="editRepairCost" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Update Repair Cost</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('repair-cost-update') }}" method="post">
          @csrf
          <div class="row g-3">
            <div class="col-3 mb-3">
              <label for="jan" class="form-label">Janaury</label>
              <input type="text" id="jan" class="form-control" name="jan" required>
              <input type="hidden" name="id" id="RepairCostId">
            </div>
            <div class="col-3 mb-3">
              <label for="feb" class="form-label">February</label>
              <input type="text" id="feb" class="form-control" name="feb" required>
            </div>
            <div class="col-3 mb-3">
              <label for="mar" class="form-label">March</label>
              <input type="text" id="mar" class="form-control" name="mar" required>
            </div>
            <div class="col-3 mb-3">
              <label for="apr" class="form-label">April</label>
              <input type="text" id="apr" class="form-control" name="apr" required>
            </div>
            <div class="col-3 mb-3">
              <label for="may" class="form-label">May</label>
              <input type="text" id="may" class="form-control" name="may" required>
            </div>
            <div class="col-3 mb-3">
              <label for="jun" class="form-label">June</label>
              <input type="text" id="jun" class="form-control" name="jun" required>
            </div>
            <div class="col-3 mb-3">
              <label for="jul" class="form-label">July</label>
              <input type="text" id="jul" class="form-control" name="jul" required>
            </div>
            <div class="col-3 mb-3">
              <label for="aug" class="form-label">August</label>
              <input type="text" id="aug" class="form-control" name="aug" required>
            </div>
            <div class="col-3 mb-3">
              <label for="sep" class="form-label">September</label>
              <input type="text" id="sep" class="form-control" name="sep" required>
            </div>
            <div class="col-3 mb-3">
              <label for="oct" class="form-label">October</label>
              <input type="text" id="oct" class="form-control" name="oct" required>
            </div>
            <div class="col-3 mb-3">
              <label for="nov" class="form-label">November</label>
              <input type="text" id="nov" class="form-control" name="nov" required>
            </div>
            <div class="col-3 mb-3">
              <label for="dec" class="form-label">Decemeber</label>
              <input type="text" id="dec" class="form-control" name="dec" required>
            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endif

@endsection