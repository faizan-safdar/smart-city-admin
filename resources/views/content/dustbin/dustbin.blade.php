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
        <tr class="text-center">
          <td><span class="fw-medium">{{ $bin_usage['eighth_1'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_2'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_3'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_4'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_5'] }}</span></td>
          <td><span class="fw-medium">{{ $bin_usage['eighth_6'] }}</span></td>
          <td><button class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#basicModal">Update</button></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="card mb-4">
  <h5 class="card-header text-bolder">Waste Removal</h5>
  <div class="table-responsive text-nowrap">
    <table id="dustbintable" class="table table-hover">
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($bin_waste_removals as $bin_waste_removal)
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
          <td><a class="btn btn-primary btn-sm text-white"
              href="{{ route('dustbin-details', $bin_waste_removal['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
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
              href="{{ route('dustbin-details', $bin_repair_cost['id']) }}">Update</a></span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
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


<!-- Bootstrap modals -->
<div class="card mb-4">
  <h5 class="card-header">Bootstrap modals</h5>
  <div class="card-body">
    <div class="row gy-3">
      <!-- Default Modal -->
      <div class="col-lg-4 col-md-6">
        <small class="text-light fw-medium">Default</small>
        <div class="mt-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
            Launch modal
          </button>

          <!-- Modal -->
          <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="nameBasic" class="form-label">Name</label>
                      <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-0">
                      <label for="emailBasic" class="form-label">Email</label>
                      <input type="email" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                      <label for="dobBasic" class="form-label">DOB</label>
                      <input type="date" id="dobBasic" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endif

@endsection