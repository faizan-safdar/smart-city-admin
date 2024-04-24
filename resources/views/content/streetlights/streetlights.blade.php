@php
use Carbon\Carbon;
function convertDate($date) {
        return Carbon::parse($date)->format('d-m-Y h:i A');
    }
@endphp
@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Street Lights - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  function openEditStreetlight(recordId) {
    let url = `{{url('fetchStreetlight/${recordId}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#name').val(data.name);
        $('#energy_consumed').val(data.energy_consumed);
        $('#schedule').val(data.schedule);
        $('#timezone').val(data.timezone);
        $('#last_contact').val(data.last_contact);
        $('#brightness_level').val(data.brightness_level);
        if (data.status == 'on') {  $('#status').prop("checked", true); } else { $('#status').prop("checked", false); }
        if (data.power_status == 'OK') {  $('#power_status').prop("checked", true); } else { $('#power_status').prop("checked", false); }
        if (data.device_status == 'OK') {  $('#device_status').prop("checked", true); } else { $('#device_status').prop("checked", false); }
        if (data.street_light_status == 'CS - ON') {  $('#street_light_status').prop("checked", true); } else { $('#street_light_status').prop("checked", false); }
        if (data.lamp_status == 'OK') {  $('#lamp_status').prop("checked", true); } else { $('#lamp_status').prop("checked", false); }
        if (data.knockdown_status == 'ON') {  $('#knockdown_status').prop("checked", true); } else { $('#knockdown_status').prop("checked", false); }
        if (data.photocell_mode_on == 'ON') {  $('#photocell_mode_on').prop("checked", true); } else { $('#photocell_mode_on').prop("checked", false); }
        if (data.photocell_mode_off == 'ON') {  $('#photocell_mode_off').prop("checked", true); } else { $('#photocell_mode_off').prop("checked", false); }
        if (data.beacon_control == 'ON') {  $('#beacon_control').prop("checked", true); } else { $('#beacon_control').prop("checked", false); }

        $('#streetlightid').val(recordId);

        $('#editStreetlight').modal('show');
        }
    });
  }

  function openEditLampData(recordId, lamp) {
    let url = `{{url('fetchLampData/${recordId}/${lamp}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#LampModalHeadingText').text('Update Lamp ' + lamp)
        $('#now').val(data.now);
        $('#min').val(data.min);
        $('#max').val(data.max);
        $('#avg').val(data.avg);
        
        $('#LampDataid').val(recordId);
        $('#LampDatatype').val(lamp);
        $('#LampDatastreetlight_id').val(data.lamp_id);

        $('#editLampData').modal('show');
    }
    });
  }

  function openEditLampGraphData(recordId, lamp) {
    let url = `{{url('fetchLampGraphData/${recordId}/${lamp}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
        $('#LampGraphModalHeadingText').text('Update Lamp ' + lamp + ' Graph Data')
        console.log(data);

        $('#hour_1').val(data.hour_1);
        $('#hour_2').val(data.hour_2);
        $('#hour_3').val(data.hour_3);
        $('#hour_4').val(data.hour_4);
        $('#hour_5').val(data.hour_5);
        $('#hour_6').val(data.hour_6);
        $('#hour_7').val(data.hour_7);
        $('#hour_8').val(data.hour_8);
        $('#hour_9').val(data.hour_9);
        $('#hour_10').val(data.hour_10);
        $('#hour_11').val(data.hour_11);
        $('#hour_12').val(data.hour_12);
        $('#hour_13').val(data.hour_13);
        $('#hour_14').val(data.hour_14);
        $('#hour_15').val(data.hour_15);
        $('#hour_16').val(data.hour_16);
        $('#hour_17').val(data.hour_17);
        $('#hour_18').val(data.hour_18);
        $('#hour_19').val(data.hour_19);
        $('#hour_20').val(data.hour_20);
        $('#hour_21').val(data.hour_21);
        $('#hour_22').val(data.hour_22);
        $('#hour_23').val(data.hour_23);
        $('#hour_24').val(data.hour_24);
    
        $('#LampGraphDataid').val(recordId);
        $('#LampGraphDatatype').val(lamp);
        $('#LampGraphDatastreetlight_id').val(data.lamp_id);

        $('#editLampGraphData').modal('show');
    }
    });
  }

</script>
@endsection

@section('content')

@if (!$streetLightId)

<div class="card">
    <h5 class="card-header text-bolder">Street Lights Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Name</th>
                    <th>Status</th>
                    <th>Energy Consumed</th>
                    <th>Schedule</th>
                    <th>Power Status</th>
                    <th>Device Status</th>
                    <th>Timezone</th>
                    <th>Last Contact</th>
                    <th>Street Light Status</th>
                    <th>Lamp Status</th>
                    <th>Knockdown Status</th>
                    <th>Brightness Level</th>
                    <th>Photocell Mode ON</th>
                    <th>Photocell Mode OFF</th>
                    <th>Beacon Control</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($formattedLamps as $formattedLamp)
                <tr class="text-center text-nowrap">
                    <td><span class="fw-medium">{{ $formattedLamp['name'] }}</span></td>
                    <td><span>{{ $formattedLamp['status'] }}</span></td>
                    <td><span>{{ $formattedLamp['energy_consumed'] }}</span></td>
                    <td><span>{{ $formattedLamp['schedule'] }}</span></td>
                    <td><span>{{ $formattedLamp['power_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['device_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['timezone'] }}</span></td>
                    <td><span>{{ convertDate($formattedLamp['last_contact']) }}</span></td>
                    <td><span>{{ $formattedLamp['street_light_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['lamp_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['knockdown_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['brightness_level'] }}</span></td>
                    <td><span>{{ $formattedLamp['photocell_mode_on'] }}</span></td>
                    <td><span>{{ $formattedLamp['photocell_mode_off'] }}</span></td>
                    <td><span>{{ $formattedLamp['beacon_control'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                        href="{{ route('streetlight-details', $formattedLamp['id']) }}">View</a></td>
                    <td><a class="btn btn-success btn-sm text-white"
                        onclick="openEditStreetlight({{ $formattedLamp['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Street Light Table Modal --}}
<div class="modal fade" id="editStreetlight" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Street Light</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('streetlight-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                            <input type="hidden" name="id" id="streetlightid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="energy_consumed" class="form-label">Energy Consumed</label>
                            <input type="text" id="energy_consumed" class="form-control" name="energy_consumed" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="schedule" class="form-label">Schedule</label>
                            <input type="text" id="schedule" class="form-control" name="schedule" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="timezone" class="form-label">Timezone</label>
                            <input type="text" id="timezone" class="form-control" name="timezone" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="last_contact" class="form-label">Last Contact</label>
                            <input type="text" id="last_contact" class="form-control" name="last_contact" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="brightness_level" class="form-label">Brightness Level</label>
                            <input type="text" id="brightness_level" class="form-control" name="brightness_level" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="status" style="transform: scale(1.5); margin-left: 5px;" name="status" value="on">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="power_status" class="form-label">Power Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="power_status" style="transform: scale(1.5); margin-left: 5px;" name="power_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="device_status" class="form-label">Device Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="device_status" style="transform: scale(1.5); margin-left: 5px;" name="device_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="street_light_status" class="form-label">Street Light Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="street_light_status" style="transform: scale(1.5); margin-left: 5px;" name="street_light_status" value="CS - ON">
                                <label class="form-check-label" style="margin-left: 15px;">CS-ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="lamp_status" class="form-label">Lamp Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="lamp_status" style="transform: scale(1.5); margin-left: 5px;" name="lamp_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="knockdown_status" class="form-label">Knockdown Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="knockdown_status" style="transform: scale(1.5); margin-left: 5px;" name="knockdown_status" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="photocell_mode_on" class="form-label">Photocell Mode On</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="photocell_mode_on" style="transform: scale(1.5); margin-left: 5px;" name="photocell_mode_on" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="photocell_mode_off" class="form-label">Photocell Mode Off</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="photocell_mode_off" style="transform: scale(1.5); margin-left: 5px;" name="photocell_mode_off" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="beacon_control" class="form-label">Beacon Control</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="beacon_control" style="transform: scale(1.5); margin-left: 5px;" name="beacon_control" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
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

@elseif ($streetLightId)
{{-- Lamp Current Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Current Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Now</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampCurrents as $lampcurrent)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampcurrent['now'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['min'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['max'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['avg'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampData({{ $lampcurrent['id'] }}, 'Current')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Voltage Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Voltage Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Now</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampVoltages as $lampvoltage)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampvoltage['now'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['min'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['max'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['avg'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampData({{ $lampvoltage['id'] }}, 'Voltage')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Photocells Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Photocells Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Now</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampPhotocells as $lampphotocell)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampphotocell['now'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocell['min'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocell['max'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocell['avg'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampData({{ $lampphotocell['id'] }}, 'Photocell')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Current Graph Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Current Graph Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Hour 1</th>
                    <th>Hour 2</th>
                    <th>Hour 3</th>
                    <th>Hour 4</th>
                    <th>Hour 5</th>
                    <th>Hour 6</th>
                    <th>Hour 7</th>
                    <th>Hour 8</th>
                    <th>Hour 9</th>
                    <th>Hour 10</th>
                    <th>Hour 11</th>
                    <th>Hour 12</th>
                    <th>Hour 13</th>
                    <th>Hour 14</th>
                    <th>Hour 15</th>
                    <th>Hour 16</th>
                    <th>Hour 17</th>
                    <th>Hour 18</th>
                    <th>Hour 19</th>
                    <th>Hour 20</th>
                    <th>Hour 21</th>
                    <th>Hour 22</th>
                    <th>Hour 23</th>
                    <th>Hour 24</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampCurrentGraphs as $lampcurrentgraph)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_1'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_2'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_3'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_4'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_5'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_6'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_7'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_8'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_9'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_10'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_11'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_12'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_13'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_14'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_15'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_16'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_17'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_18'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_19'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_20'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_21'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_22'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_23'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrentgraph['hour_24'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampGraphData({{ $lampcurrentgraph['id'] }}, 'Current')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Voltage Graph Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Voltage Graph Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Hour 1</th>
                    <th>Hour 2</th>
                    <th>Hour 3</th>
                    <th>Hour 4</th>
                    <th>Hour 5</th>
                    <th>Hour 6</th>
                    <th>Hour 7</th>
                    <th>Hour 8</th>
                    <th>Hour 9</th>
                    <th>Hour 10</th>
                    <th>Hour 11</th>
                    <th>Hour 12</th>
                    <th>Hour 13</th>
                    <th>Hour 14</th>
                    <th>Hour 15</th>
                    <th>Hour 16</th>
                    <th>Hour 17</th>
                    <th>Hour 18</th>
                    <th>Hour 19</th>
                    <th>Hour 20</th>
                    <th>Hour 21</th>
                    <th>Hour 22</th>
                    <th>Hour 23</th>
                    <th>Hour 24</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampVoltageGraphs as $lampvoltagegraph)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_1'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_2'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_3'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_4'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_5'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_6'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_7'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_8'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_9'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_10'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_11'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_12'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_13'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_14'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_15'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_16'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_17'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_18'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_19'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_20'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_21'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_22'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_23'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltagegraph['hour_24'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampGraphData({{ $lampvoltagegraph['id'] }}, 'Voltage')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Photocell Graph Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Photocell Graph Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Hour 1</th>
                    <th>Hour 2</th>
                    <th>Hour 3</th>
                    <th>Hour 4</th>
                    <th>Hour 5</th>
                    <th>Hour 6</th>
                    <th>Hour 7</th>
                    <th>Hour 8</th>
                    <th>Hour 9</th>
                    <th>Hour 10</th>
                    <th>Hour 11</th>
                    <th>Hour 12</th>
                    <th>Hour 13</th>
                    <th>Hour 14</th>
                    <th>Hour 15</th>
                    <th>Hour 16</th>
                    <th>Hour 17</th>
                    <th>Hour 18</th>
                    <th>Hour 19</th>
                    <th>Hour 20</th>
                    <th>Hour 21</th>
                    <th>Hour 22</th>
                    <th>Hour 23</th>
                    <th>Hour 24</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampPhotocellGraphs as $lampphotocellgraph)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_1'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_2'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_3'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_4'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_5'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_6'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_7'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_8'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_9'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_10'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_11'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_12'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_13'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_14'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_15'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_16'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_17'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_18'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_19'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_20'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_21'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_22'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_23'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampphotocellgraph['hour_24'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampGraphData({{ $lampphotocellgraph['id'] }}, 'Photocell')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Streetlights Detailed Tables Modal --}}
{{-- Lamp Current, Lamp Voltage and Photocell Update Modal --}}
<div class="modal fade" id="editLampData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LampModalHeadingText"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lamp-data-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="now" class="form-label">Now</label>
                            <input type="text" id="now" class="form-control" name="now" required>
                            <input type="hidden" name="id" id="LampDataid">
                            <input type="hidden" name="type" id="LampDatatype">
                            <input type="hidden" name="streetlight_id" id="LampDatastreetlight_id">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="min" class="form-label">Minimum</label>
                            <input type="text" id="min" class="form-control" name="min" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="max" class="form-label">Maximum</label>
                            <input type="text" id="max" class="form-control" name="max" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="avg" class="form-label">Average</label>
                            <input type="text" id="avg" class="form-control" name="avg" required>
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

{{-- Lamp Graph Data Update Modal --}}
<div class="modal fade" id="editLampGraphData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LampGraphModalHeadingText"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('LampGraph-data-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-4 mb-3">
                            <label for="hour_1" class="form-label">Hour 1</label>
                            <input type="text" id="hour_1" class="form-control" name="hour_1" required>
                            <input type="hidden" name="id" id="LampGraphDataid">
                            <input type="hidden" name="type" id="LampGraphDatatype">
                            <input type="hidden" name="streetlight_id" id="LampGraphDatastreetlight_id">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_2" class="form-label">Hour 2</label>
                            <input type="text" id="hour_2" class="form-control" name="hour_2" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_3" class="form-label">Hour 3</label>
                            <input type="text" id="hour_3" class="form-control" name="hour_3" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_4" class="form-label">Hour 4</label>
                            <input type="text" id="hour_4" class="form-control" name="hour_4" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_5" class="form-label">Hour 5</label>
                            <input type="text" id="hour_5" class="form-control" name="hour_5" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_6" class="form-label">Hour 6</label>
                            <input type="text" id="hour_6" class="form-control" name="hour_6" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_7" class="form-label">Hour 7</label>
                            <input type="text" id="hour_7" class="form-control" name="hour_7" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_8" class="form-label">Hour 8</label>
                            <input type="text" id="hour_8" class="form-control" name="hour_8" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_9" class="form-label">Hour 9</label>
                            <input type="text" id="hour_9" class="form-control" name="hour_9" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_10" class="form-label">Hour 10</label>
                            <input type="text" id="hour_10" class="form-control" name="hour_10" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_11" class="form-label">Hour 11</label>
                            <input type="text" id="hour_11" class="form-control" name="hour_11" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_12" class="form-label">Hour 12</label>
                            <input type="text" id="hour_12" class="form-control" name="hour_12" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_13" class="form-label">Hour 13</label>
                            <input type="text" id="hour_13" class="form-control" name="hour_13" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_14" class="form-label">Hour 14</label>
                            <input type="text" id="hour_14" class="form-control" name="hour_14" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_15" class="form-label">Hour 15</label>
                            <input type="text" id="hour_15" class="form-control" name="hour_15" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_16" class="form-label">Hour 16</label>
                            <input type="text" id="hour_16" class="form-control" name="hour_16" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_17" class="form-label">Hour 17</label>
                            <input type="text" id="hour_17" class="form-control" name="hour_17" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_18" class="form-label">Hour 18</label>
                            <input type="text" id="hour_18" class="form-control" name="hour_18" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_19" class="form-label">Hour 19</label>
                            <input type="text" id="hour_19" class="form-control" name="hour_19" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_20" class="form-label">Hour 20</label>
                            <input type="text" id="hour_20" class="form-control" name="hour_20" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_21" class="form-label">Hour 21</label>
                            <input type="text" id="hour_21" class="form-control" name="hour_21" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_22" class="form-label">Hour 22</label>
                            <input type="text" id="hour_22" class="form-control" name="hour_22" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_23" class="form-label">Hour 23</label>
                            <input type="text" id="hour_23" class="form-control" name="hour_23" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="hour_24" class="form-label">Hour 24</label>
                            <input type="text" id="hour_24" class="form-control" name="hour_24" required>
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