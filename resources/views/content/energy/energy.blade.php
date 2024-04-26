@php
use Carbon\Carbon;
@endphp
@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Energy - Analytics')

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
    function openEditEnergy(recordId) {
    let url = `{{url('fetchEnergy/${recordId}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#energy').val(data.energy);
        $('#name').val(data.name);
        $('#owner_name').val(data.owner_name);
        $('#built_date').val(data.built_date);
        $('#built_area').val(data.built_area);
        $('#occupents').val(data.occupents);
        $('#active_power').val(data.active_power);
        $('#used_active_power').val(data.used_active_power);
        $('#total_current_hour').val(data.total_current_hour);
        $('#cost').val(data.cost);
        $('#co2').val(data.co2);
        $('#KWH_person').val(data.KWH_person);
        $('#KWHM2').val(data['KWHM2']);
        
        $('#energyid').val(recordId);
        $('#editEnergy').modal('show');
        }
    });
  }

  function openEditEnergyData(recordId, energy) {
    let url = `{{url('fetchEnergyData/${recordId}/${energy}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        console.log(data);
        $('#EnergyDataModalHeadingText').text('Update ' + energy + ' Energy Data')
        $('#energy_intensity').val(data.energy_intensity);
        $('#energy').val(data.energy);
        $('#co2').val(data.co2);

        $('#EnergyDataid').val(recordId);
        $('#EnergyDatatype').val(energy);
        
        $('#editEnergyData').modal('show');
    }
    });
  }

  function openEditConnectionType(recordId) {
    let url = `{{url('fetchConnectionType/${recordId}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#power').val(data.power);
        $('#acmv').val(data.acmv);
        $('#elec_esc').val(data.elec_esc);
        $('#lightning').val(data.lightning);
        $('#mixed_load').val(data.mixed_load);
        
        $('#ConnectionTypeid').val(recordId);
        
        $('#editConnectionType').modal('show');
    }
    });
  }

  function openEditUsageHour(recordId) {
    let url = `{{url('fetchUsageHours/${recordId}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#eighth_1').val(data.eighth_1);
        $('#eighth_2').val(data.eighth_2);
        $('#eighth_3').val(data.eighth_3);
        $('#eighth_4').val(data.eighth_4);
        $('#eighth_5').val(data.eighth_5);
        $('#eighth_6').val(data.eighth_6);
        
        $('#UsageHoursid').val(recordId);
        
        $('#editUsageHours').modal('show');
    }
    });
  }

</script>
@endsection

@section('content')

@if (!$energyid)

{{-- Energy Table --}}
<div class="card">
    <h5 class="card-header text-bolder">Energy Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Energy</th>
                    <th>Name</th>
                    <th>Owner Name</th>
                    <th>Built Date</th>
                    <th>Built Area</th>
                    <th>Occupents</th>
                    <th>Active Power</th>
                    <th>Used Active Power</th>
                    <th>Total Current Hour</th>
                    <th>Cost</th>
                    <th>CO2</th>
                    <th>KWH_person</th>
                    <th>KWHM2</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($formattedEnergies as $formattedEnergy)
                <tr class="text-center text-nowrap">
                    <td><span class="fw-medium">{{ $formattedEnergy['energy'] }}</span></td>
                    <td><span>{{ $formattedEnergy['name'] }}</span></td>
                    <td><span>{{ $formattedEnergy['owner_name'] }}</span></td>
                    <td><span>{{ Carbon::parse($formattedEnergy['built_date'])->format('d-m-Y h:i A') }}</span></td>
                    <td><span>{{ $formattedEnergy['built_area'] }}</span></td>
                    <td><span>{{ $formattedEnergy['occupents'] }}</span></td>
                    <td><span>{{ $formattedEnergy['active_power'] }}</span></td>
                    <td><span>{{ $formattedEnergy['used_active_power'] }}</span></td>
                    <td><span>{{ $formattedEnergy['total_current_hour'] }}</span></td>
                    <td><span>{{ $formattedEnergy['cost'] }}</span></td>
                    <td><span>{{ $formattedEnergy['co2'] }}</span></td>
                    <td><span>{{ $formattedEnergy['KWH_person'] }}</span></td>
                    <td><span>{{ $formattedEnergy['KWHM2'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            href="{{ route('energy-details', $formattedEnergy['id']) }}">View</a></td>
                    <td><a class="btn btn-success btn-sm text-white"
                            onclick="openEditEnergy({{ $formattedEnergy['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Energy Table Modal --}}
<div class="modal fade" id="editEnergy" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Energy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('energy-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="energy" class="form-label">Energy</label>
                            <input type="text" id="energy" class="form-control" name="energy" required>
                            <input type="hidden" name="id" id="energyid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="owner_name" class="form-label">Owner Name</label>
                            <input type="text" id="owner_name" class="form-control" name="owner_name" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="built_date" class="form-label">Built Date</label>
                            <input type="text" id="built_date" class="form-control" name="built_date" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="built_area" class="form-label">Built Area</label>
                            <input type="text" id="built_area" class="form-control" name="built_area" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="occupents" class="form-label">Occupents</label>
                            <input type="text" id="occupents" class="form-control" name="occupents" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="active_power" class="form-label">Active Power</label>
                            <input type="text" id="active_power" class="form-control" name="active_power" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="used_active_power" class="form-label">Used Active Power</label>
                            <input type="text" id="used_active_power" class="form-control" name="used_active_power"
                                required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="total_current_hour" class="form-label">Total Current Hour</label>
                            <input type="text" id="total_current_hour" class="form-control" name="total_current_hour"
                                required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="cost" class="form-label">Cost</label>
                            <input type="text" id="cost" class="form-control" name="cost" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="co2" class="form-label">CO2</label>
                            <input type="text" id="co2" class="form-control" name="co2" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="KWH_person" class="form-label">KWH_person</label>
                            <input type="text" id="KWH_person" class="form-control" name="KWH_person" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="KWHM2" class="form-label">KWHM2</label>
                            <input type="text" id="KWHM2" class="form-control" name="KWHM2" required>
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

@elseif ($energyid)
{{-- Energy Detailed Tables Data --}}
{{-- Power Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Power Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Energy Intensity</th>
                    <th>Energy</th>
                    <th>Co2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($Powers as $power)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $power['energy_intensity'] }}</span></td>
                    <td><span>{{ $power['energy'] }}</span></td>
                    <td><span>{{ $power['co2'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditEnergyData({{ $power['id'] }}, 'Power')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ACMV Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">ACMV Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Energy Intensity</th>
                    <th>Energy</th>
                    <th>Co2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($acmvs as $acmv)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $acmv['energy_intensity'] }}</span></td>
                    <td><span>{{ $acmv['energy'] }}</span></td>
                    <td><span>{{ $acmv['co2'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditEnergyData({{ $acmv['id'] }}, 'ACMV')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- EleECV Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">EleECV Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Energy Intensity</th>
                    <th>Energy</th>
                    <th>Co2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($elecvs as $elecv)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $elecv['energy_intensity'] }}</span></td>
                    <td><span>{{ $elecv['energy'] }}</span></td>
                    <td><span>{{ $elecv['co2'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditEnergyData({{ $elecv['id'] }}, 'ELECV')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lighting Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lightning Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Energy Intensity</th>
                    <th>Energy</th>
                    <th>Co2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($lightings as $lighting)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lighting['energy_intensity'] }}</span></td>
                    <td><span>{{ $lighting['energy'] }}</span></td>
                    <td><span>{{ $lighting['co2'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditEnergyData({{ $lighting['id'] }}, 'Lightning')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Mixed Loads Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Mixed Loads Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Energy Intensity</th>
                    <th>Energy</th>
                    <th>Co2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($mixedLoads as $mixedLoad)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $mixedLoad['energy_intensity'] }}</span></td>
                    <td><span>{{ $mixedLoad['energy'] }}</span></td>
                    <td><span>{{ $mixedLoad['co2'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditEnergyData({{ $mixedLoad['id'] }}, 'Mixed Load')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Connection Types Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Connection Types Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Power</th>
                    <th>ACMV</th>
                    <th>Elec Esc</th>
                    <th>Lightning</th>
                    <th>Mixed Load</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($connectionTypes as $connectionType)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $connectionType['power'] }}</span></td>
                    <td><span>{{ $connectionType['acmv'] }}</span></td>
                    <td><span>{{ $connectionType['elec_esc'] }}</span></td>
                    <td><span>{{ $connectionType['lightning'] }}</span></td>
                    <td><span>{{ $connectionType['mixed_load'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditConnectionType({{ $connectionType['id'] }})">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Usage Hours Graph Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Usage Hours Graph Data</h5>
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

                @foreach ($usageHours as $usageHour)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $usageHour['eighth_1'] }}</span></td>
                    <td><span>{{ $usageHour['eighth_2'] }}</span></td>
                    <td><span>{{ $usageHour['eighth_3'] }}</span></td>
                    <td><span>{{ $usageHour['eighth_4'] }}</span></td>
                    <td><span>{{ $usageHour['eighth_5'] }}</span></td>
                    <td><span>{{ $usageHour['eighth_6'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditUsageHour({{ $usageHour['id'] }})">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- Energy Detailed Tables Modal --}}
{{-- Power, ACMV, ELECV, Lighting, Mixed Loads, Update Modal --}}
<div class="modal fade" id="editEnergyData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EnergyDataModalHeadingText"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('energy-data-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="energy_intensity" class="form-label">Energy Intensity</label>
                            <input type="text" id="energy_intensity" class="form-control" name="energy_intensity" required>
                            <input type="hidden" name="id" id="EnergyDataid">
                            <input type="hidden" name="type" id="EnergyDatatype">
                            <input type="hidden" name="Energy_id" value="{{ $energyid }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="energy" class="form-label">Energy</label>
                            <input type="text" id="energy" class="form-control" name="energy" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="co2" class="form-label">Co2</label>
                            <input type="text" id="co2" class="form-control" name="co2" required>
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

{{-- Connection Type Update Modal --}}
<div class="modal fade" id="editConnectionType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ConnectionTypeModalHeadingText">Update Connection Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('connection-types-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="power" class="form-label">Power</label>
                            <input type="text" id="power" class="form-control" name="power" required>
                            <input type="hidden" name="id" id="ConnectionTypeid">
                            <input type="hidden" name="Energy_id" value="{{ $energyid }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="acmv" class="form-label">ACMV</label>
                            <input type="text" id="acmv" class="form-control" name="acmv" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="elec_esc" class="form-label">ELECV</label>
                            <input type="text" id="elec_esc" class="form-control" name="elec_esc" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="lightning" class="form-label">Lighting</label>
                            <input type="text" id="lightning" class="form-control" name="lightning" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="mixed_load" class="form-label">Mixed Loads</label>
                            <input type="text" id="mixed_load" class="form-control" name="mixed_load" required>
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

{{-- Usage Hours Graph Update Modal --}}
<div class="modal fade" id="editUsageHours" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UsageHoursModalHeadingText">Update Usage Hours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usage-hours-graph-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="eighth_1" class="form-label">Eighth 1</label>
                            <input type="text" id="eighth_1" class="form-control" name="eighth_1" required>
                            <input type="hidden" name="id" id="UsageHoursid">
                            <input type="hidden" name="Energy_id" value="{{ $energyid }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_2" class="form-label">Eighth 2</label>
                            <input type="text" id="eighth_2" class="form-control" name="eighth_2" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_3" class="form-label">Eighth 3</label>
                            <input type="text" id="eighth_3" class="form-control" name="eighth_3" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_4" class="form-label">Eighth 4</label>
                            <input type="text" id="eighth_4" class="form-control" name="eighth_4" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_5" class="form-label">Eighth 5</label>
                            <input type="text" id="eighth_5" class="form-control" name="eighth_5" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="eighth_6" class="form-label">Eighth 6</label>
                            <input type="text" id="eighth_6" class="form-control" name="eighth_6" required>
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