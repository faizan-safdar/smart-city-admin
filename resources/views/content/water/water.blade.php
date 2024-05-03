@php
use Carbon\Carbon;
@endphp
@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Water Usage - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
    
    function openEditWaterUsage(recordId) {
        let url = `{{url('fetchWaterUsage/${recordId}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        console.log(data);
        $('#level_name').val(data.level_name);
        $('#current_capacity').val(data.current_capacity);
        $('#max_capacity').val(data.max_capacity);
        $('#level_status').val(data.level_status);
        $('#alarm_status').val(data.alarm_status);


        $('#WaterUsageid').val(recordId);
        $('#editWaterUsage').modal('show');
        }
        });
    }
    
    function openEditWaterEnergyUtilization(recordId) {
        let url = `{{url('fetchWaterEnergyUtilization/${recordId}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        console.log(data);
        $('#eighth_1').val(data.eighth_1);
        $('#eighth_2').val(data.eighth_2);
        $('#eighth_3').val(data.eighth_3);
        $('#eighth_4').val(data.eighth_4);
        $('#eighth_5').val(data.eighth_5);
        $('#eighth_6').val(data.eighth_6);
        
        $('#EnergyUtilizationid').val(recordId);
        
        $('#editEnergyUtilization').modal('show');
        }
        });
    }

    function openEditWaterEnergyBreakdown(recordId) {
        let url = `{{url('fetchWaterEnergyBreakdown/${recordId}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        console.log(data);
        $('#industrial').val(data.industrial);
        $('#commerce').val(data.commerce);
        $('#household').val(data.household);
        $('#transport').val(data.transport);
        $('#others').val(data.others);
        
        $('#EnergyBreakdownid').val(recordId);
        
        $('#editEnergyBreakdown').modal('show');
        }
        });
    }

    function openEditWaterUsageBreakdownWasteDischarge(recordId, type) {
        let url = `{{url('fetchUsageBreakdownWasteDischarges/${recordId}/${type}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        $('#UsageBreakdownWasteDischargeModalHeading').text('Update ' + type);
        $('#industrial1').val(data.industrial);
        $('#commercial').val(data.commercial);
        $('#domestic').val(data.domestic);
        $('#agriculture').val(data.agriculture);
        
        $('#UsageBreakdownORWasteDischargeid').val(recordId);
        $('#UsageBreakdownORWasteDischargeType').val(type);

        $('#editUsageBreakdownWasteDischargeModal').modal('show');
        }
        });
    }
</script>
@endsection

@section('content')

@if (!$water_id)

{{-- Water Usage Table --}}
<div class="card">
    <h5 class="card-header text-bolder">Water Usage Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Level Name</th>
                    <th>Current Capacity</th>
                    <th>Max Capacity</th>
                    <th>Level Status</th>
                    <th>Time</th>
                    <th>Alarm Status</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($formattedWaters as $formattedWater)
                <tr class="text-center text-nowrap">
                    <td><span class="fw-medium">{{ $formattedWater['level_name'] }}</span></td>
                    <td><span>{{ $formattedWater['current_capacity'] }}</span></td>
                    <td><span>{{ $formattedWater['max_capacity'] }}</span></td>
                    <td><span>{{ $formattedWater['level_status'] }}</span></td>
                    <td><span>{{ Carbon::parse($formattedWater['time'])->format('d-m-Y h:i A') }}</span></td>
                    <td><span>{{ $formattedWater['alarm_status'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            href="{{ route('water-usage-details', $formattedWater['id']) }}">View</a></td>
                    <td><a class="btn btn-success btn-sm text-white"
                            onclick="openEditWaterUsage({{ $formattedWater['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Water Usage Table Modal --}}
<div class="modal fade" id="editWaterUsage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Water Usage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('water-usage-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="level_name" class="form-label">Level Name</label>
                            <input type="text" id="level_name" class="form-control" name="level_name" required>
                            <input type="hidden" name="id" id="WaterUsageid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="current_capacity" class="form-label">Current Capacity</label>
                            <input type="text" id="current_capacity" class="form-control" name="current_capacity" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="max_capacity" class="form-label">Max Capacity</label>
                            <input type="text" id="max_capacity" class="form-control" name="max_capacity" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="level_status" class="form-label">Level Status</label>
                            <input type="text" id="level_status" class="form-control" name="level_status" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="alarm_status" class="form-label">Alarm Status</label>
                            <input type="text" id="alarm_status" class="form-control" name="alarm_status" required>
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

@elseif ($water_id)
<div class="mb-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>@endif
</div>
{{-- Water Usage Detailed Tables Data --}}
{{-- Energy Utilization Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Energy Utilization Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
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

                @foreach ($waterEnergyUtilizations as $waterEnergyUtilization)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterEnergyUtilization['eighth_1'] }}</span></td>
                    <td><span>{{ $waterEnergyUtilization['eighth_2'] }}</span></td>
                    <td><span>{{ $waterEnergyUtilization['eighth_3'] }}</span></td>
                    <td><span>{{ $waterEnergyUtilization['eighth_4'] }}</span></td>
                    <td><span>{{ $waterEnergyUtilization['eighth_5'] }}</span></td>
                    <td><span>{{ $waterEnergyUtilization['eighth_6'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditWaterEnergyUtilization({{ $waterEnergyUtilization['id'] }})">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Electricity Consumption Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Electricity Consumption Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Month</th>
                    <th>Energy Usage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterElectricityConsumptions as $waterElectricityConsumption)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterElectricityConsumption['month'] }}</span></td>
                    <td><span>{{ $waterElectricityConsumption['total_energy_usage'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                        href="{{ route('monthly-electricity-consumption', ['month' => $waterElectricityConsumption['month'], 'water_id' => $water_id]) }}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Energy Breakdown Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Energy Breakdown Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Industrial</th>
                    <th>Commerce</th>
                    <th>HouseHold</th>
                    <th>Transport</th>
                    <th>Others</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterEnergyBreakdowns as $waterEnergyBreakdown)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterEnergyBreakdown['industrial'] }}</span></td>
                    <td><span>{{ $waterEnergyBreakdown['commerce'] }}</span></td>
                    <td><span>{{ $waterEnergyBreakdown['household'] }}</span></td>
                    <td><span>{{ $waterEnergyBreakdown['transport'] }}</span></td>
                    <td><span>{{ $waterEnergyBreakdown['others'] }}</span></td>
                    <td><a class="btn btn-success btn-sm text-white"
                        onclick="openEditWaterEnergyBreakdown({{ $waterEnergyBreakdown['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Usage Breakdown Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Usage Breakdown Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Industrial</th>
                    <th>Commercial</th>
                    <th>Domestic</th>
                    <th>Agriculture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterUsageBreakdowns as $waterUsageBreakdown)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterUsageBreakdown['industrial'] }}</span></td>
                    <td><span>{{ $waterUsageBreakdown['commercial'] }}</span></td>
                    <td><span>{{ $waterUsageBreakdown['domestic'] }}</span></td>
                    <td><span>{{ $waterUsageBreakdown['agriculture'] }}</span></td>
                    <td><a class="btn btn-success btn-sm text-white"
                        onclick="openEditWaterUsageBreakdownWasteDischarge({{ $waterUsageBreakdown['id'] }}, 'Usage Breakdown')">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Waste Discharges Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Waste Discharges Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Industrial</th>
                    <th>Commercial</th>
                    <th>Domestic</th>
                    <th>Agriculture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterWasteDischarges as $waterWasteDischarge)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterWasteDischarge['industrial'] }}</span></td>
                    <td><span>{{ $waterWasteDischarge['commercial'] }}</span></td>
                    <td><span>{{ $waterWasteDischarge['domestic'] }}</span></td>
                    <td><span>{{ $waterWasteDischarge['agriculture'] }}</span></td>
                    <td><a class="btn btn-success btn-sm text-white"
                        onclick="openEditWaterUsageBreakdownWasteDischarge({{ $waterWasteDischarge['id'] }}, 'Waste Discharge')">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Average Consumption Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Average Consumption Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Month</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterAverageConsumptions as $waterAverageConsumption)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterAverageConsumption['month'] }}</span></td>
                    <td><span>{{ $waterAverageConsumption['total_value'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                        href="{{ route('monthly-average-consumption', ['month' => $waterAverageConsumption['month'], 'water_id' => $water_id]) }}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Water Usage Detailed Tables Modal --}}
{{-- Energy Utilization Update Modal --}}
<div class="modal fade" id="editEnergyUtilization" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Energy Utilization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('energy-utilization-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="eighth_1" class="form-label">Eighth 1</label>
                            <input type="number" id="eighth_1" class="form-control" min="0" max="5000" name="eighth_1" required>
                            <input type="hidden" name="id" id="EnergyUtilizationid">
                            <input type="hidden" name="water_id" value="{{ $water_id }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_2" class="form-label">Eighth 2</label>
                            <input type="number" id="eighth_2" class="form-control" min="0" max="5000" name="eighth_2" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_3" class="form-label">Eighth 3</label>
                            <input type="number" id="eighth_3" class="form-control" min="0" max="5000" name="eighth_3" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_4" class="form-label">Eighth 4</label>
                            <input type="number" id="eighth_4" class="form-control" min="0" max="5000" name="eighth_4" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_5" class="form-label">Eighth 5</label>
                            <input type="number" id="eighth_5" class="form-control" min="0" max="5000" name="eighth_5" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_6" class="form-label">Eighth 6</label>
                            <input type="number" id="eighth_6" class="form-control" min="0" max="5000" name="eighth_6" required>
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

{{-- Energy Breakdown Update Modal --}}
<div class="modal fade" id="editEnergyBreakdown" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Energy Breakdown</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('energy-breakdown-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="industrial" class="form-label">Industrial</label>
                            <input type="number" id="industrial" class="form-control" min="0" max="100" name="industrial" required>
                            <input type="hidden" name="id" id="EnergyBreakdownid">
                            <input type="hidden" name="water_id" value="{{ $water_id }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="commerce" class="form-label">Commerce</label>
                            <input type="number" id="commerce" class="form-control" min="0" max="100" name="commerce" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="household" class="form-label">HouseHold</label>
                            <input type="number" id="household" class="form-control" min="0" max="100" name="household" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="transport" class="form-label">Transport</label>
                            <input type="number" id="transport" class="form-control" min="0" max="100" name="transport" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="others" class="form-label">Others</label>
                            <input type="number" id="others" class="form-control" min="0" max="100" name="others" required>
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

{{-- Usage Breakdown and Waste Discharge Update Modal --}}
<div class="modal fade" id="editUsageBreakdownWasteDischargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UsageBreakdownWasteDischargeModalHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usage-breakdown-waste-discharges-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="industrial" class="form-label">Industrial</label>
                            <input type="number" id="industrial1" class="form-control" min="0" max="100" name="industrial" required>
                            <input type="hidden" name="id" id="UsageBreakdownORWasteDischargeid">
                            <input type="hidden" name="type" id="UsageBreakdownORWasteDischargeType">
                            <input type="hidden" name="water_id" value="{{ $water_id }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="commercial" class="form-label">Commercial</label>
                            <input type="number" id="commercial" class="form-control" min="0" max="100" name="commercial" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="domestic" class="form-label">Domestic</label>
                            <input type="number" id="domestic" class="form-control" min="0" max="100" name="domestic" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="agriculture" class="form-label">Agriculture</label>
                            <input type="number" id="agriculture" class="form-control" min="0" max="100" name="agriculture" required>
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