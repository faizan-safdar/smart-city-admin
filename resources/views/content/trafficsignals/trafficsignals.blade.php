@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Traffisignals - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
    function openEditTrafficSignals(id, signal) {
    let url = `{{url('fetchTrafficsignals/${id}/${signal}')}}`;
    console.log(url);
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
    console.log(data);
    $("#exampleModalLabel1").text('Update Traffic Signal - ' + signal);
    $('#l1_current_vehicles').val(data.l1_current_vehicles);
    $('#l1_max_vehicles').val(data.l1_max_vehicles);
    $('#l1_traffic_text').val(data.l1_traffic_text);
    $('#l2_current_vehicles').val(data.l2_current_vehicles);
    $('#l2_max_vehicles').val(data.l2_max_vehicles);
    $('#l2_traffic_text').val(data.l2_traffic_text);
    
    $('#trafficsignalsupdateid').val(data.id);
    $('#trafficsignalsupdatesignal').val(data.signal);
    
    $('#editTrafficSignalsModal').modal('show');
    }
    });
    }
</script>
@endsection

@section('content')
<div class="card mb-4">
    <h5 class="card-header text-bolder">Signal One Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="trafficsignalstable" class="table">
            <thead class="table-border-bottom-1 table-primary">
                <tr>
                    <th>Lane No</th>
                    <th>Current Vehicles</th>
                    <th>Max Vehicles</th>
                    <th>Traffic Text</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($success['signalOne'] as $trafficsignal)
                <tr>
                    <td><span class="fw-medium">Lane 1</span></td>
                    <td>{{ $trafficsignal['l1_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_traffic_text'] }}</td>
                    <td rowspan="2" class=" text-center border-bottom-0"><a class="btn btn-success btn-sm text-white"
                        onclick="openEditTrafficSignals({{ $trafficsignal['id'] }}, 'One')">Update</a></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Lane 2</span></td>
                    <td>{{ $trafficsignal['l2_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_traffic_text'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header text-bolder">Signal Two Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="trafficsignalstable" class="table">
            <thead class="table-border-bottom-1 table-primary">
                <tr>
                    <th>Lane No</th>
                    <th>Current Vehicles</th>
                    <th>Max Vehicles</th>
                    <th>Traffic Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($success['signalTwo'] as $trafficsignal)
                <tr>
                    <td><span class="fw-medium">Lane 1</span></td>
                    <td>{{ $trafficsignal['l1_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_traffic_text'] }}</td>
                    <td rowspan="2" class=" text-center border-bottom-0"><a class="btn btn-success btn-sm text-white"
                            onclick="openEditTrafficSignals({{ $trafficsignal['id'] }}, 'Two')">Update</a></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Lane 2</span></td>
                    <td>{{ $trafficsignal['l2_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_traffic_text'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header text-bolder">Signal Three Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="trafficsignalstable" class="table">
            <thead class="table-border-bottom-1 table-primary">
                <tr>
                    <th>Lane No</th>
                    <th>Current Vehicles</th>
                    <th>Max Vehicles</th>
                    <th>Traffic Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($success['signalThree'] as $trafficsignal)
                <tr>
                    <td><span class="fw-medium">Lane 1</span></td>
                    <td>{{ $trafficsignal['l1_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_traffic_text'] }}</td>
                    <td rowspan="2" class=" text-center border-bottom-0"><a class="btn btn-success btn-sm text-white"
                            onclick="openEditTrafficSignals({{ $trafficsignal['id'] }}, 'Three')">Update</a></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Lane 2</span></td>
                    <td>{{ $trafficsignal['l2_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_traffic_text'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header text-bolder">Signal Four Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="trafficsignalstable" class="table">
            <thead class="table-border-bottom-1 table-primary">
                <tr>
                    <th>Lane No</th>
                    <th>Current Vehicles</th>
                    <th>Max Vehicles</th>
                    <th>Traffic Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($success['signalFour'] as $trafficsignal)
                <tr>
                    <td><span class="fw-medium">Lane 1</span></td>
                    <td>{{ $trafficsignal['l1_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l1_traffic_text'] }}</td>
                    <td rowspan="2" class=" text-center border-bottom-0"><a class="btn btn-success btn-sm text-white"
                            onclick="openEditTrafficSignals({{ $trafficsignal['id'] }}, 'Four')">Update</a></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Lane 2</span></td>
                    <td>{{ $trafficsignal['l2_current_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_max_vehicles'] }}</td>
                    <td>{{ $trafficsignal['l2_traffic_text'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- TrafficSignals Table Modal --}}
<div class="modal fade" id="editTrafficSignalsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('trafficsignals-update') }}" method="post">
                    @csrf
                    <div class="row g-3 mb-3">
                        <label class="form-label" style="font-size: 18px;">Lane 1</label>
                        <div class="col-6 mb-3">
                            <label for="l1_current_vehicles" class="form-label">Current Vehicles</label>
                            <input type="text" id="l1_current_vehicles" class="form-control" name="l1_current_vehicles" required>
                            <input type="hidden" name="id" id="trafficsignalsupdateid">
                            <input type="hidden" name="signal" id="trafficsignalsupdatesignal">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="l1_max_vehicles" class="form-label">Max Vehicles</label>
                            <input type="text" id="l1_max_vehicles" class="form-control" name="l1_max_vehicles" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="l1_traffic_text" class="form-label">Traffic Text</label>
                            <input type="text" id="l1_traffic_text" class="form-control" name="l1_traffic_text" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <label class="form-label" style="font-size: 18px;">Lane 2</label>
                        <div class="col-6 mb-3">
                            <label for="l2_current_vehicles" class="form-label">Current Vehicles</label>
                            <input type="text" id="l2_current_vehicles" class="form-control" name="l2_current_vehicles" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="l2_max_vehicles" class="form-label">Max Vehicles</label>
                            <input type="text" id="l2_max_vehicles" class="form-control" name="l2_max_vehicles" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="l2_traffic_text" class="form-label">Traffic Text</label>
                            <input type="text" id="l2_traffic_text" class="form-control" name="l2_traffic_text" required>
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
@endsection