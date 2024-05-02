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
    
    function openEditElectricityConsumption(recordId) {
        let url = `{{url('fetchElectricityConsumption/${recordId}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        console.log(data);
        $('#room_name').val(data.room_name);
        $('#energy_usage').val(data.energy_usage);
        
        $('#ElectricityConsumptionid').val(recordId);
        $('#ElectricityConsumptionMonth').val(data.month);
        $('#editElectricityConsumption').modal('show');
        }
        });
    }
    
    function openEditAverageConsumption(recordId) {
        let url = `{{url('fetchAverageConsumption/${recordId}')}}`;
        $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
        console.log(data);
        $('#type').val(data.type);
        $('#value').val(data.value);

        $('#AverageConsumptionid').val(recordId);
        $('#AverageConsumptionMonth').val(data.month);
        $('#editAverageConsumption').modal('show');
        }
        });
    }
    
</script>
@endsection

@section('content')
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
@if ($type == 'electricity')

{{-- Electricity Consumption Table --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="text-bolder" style="display: inline; float: left; width: 50%; top: 0;">Electricity Consumption Data</h5>
        <a class="btn btn-primary btn-sm text-white" style="width: 100px; display: inline; float: right;" href="{{ route('water-usage-details', $water_id) }}">Back</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Month</th>
                    <th>Room Name</th>
                    <th>Energy Usage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterElectricityConsumptions as $waterElectricityConsumption)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterElectricityConsumption['month'] }}</span></td>
                    <td><span>{{ $waterElectricityConsumption['room_name'] }}</span></td>
                    <td><span>{{ $waterElectricityConsumption['energy_usage'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditElectricityConsumption({{ $waterElectricityConsumption['id'] }})">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Electricity Consumption Update Modal --}}
<div class="modal fade" id="editElectricityConsumption" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Electricity Consumption</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('electricity-consumption-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="room_name" class="form-label">Room Name</label>
                            <input type="text" id="room_name" class="form-control" name="room_name" required>
                            <input type="hidden" name="id" id="ElectricityConsumptionid">
                            <input type="hidden" name="month" id="ElectricityConsumptionMonth">
                            <input type="hidden" name="water_id" value="{{ $water_id }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="energy_usage" class="form-label">Energy Usage</label>
                            <input type="number" id="energy_usage" class="form-control" min="0" max="125" name="energy_usage" required>
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

@elseif ($type == 'average')

{{-- Average Water Consumption Table --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="text-bolder" style="display: inline; float: left; width: 50%; top: 0;">Average Water Consumption Data</h5>
        <a class="btn btn-primary btn-sm text-white" style="width: 100px; display: inline; float: right;" href="{{ route('water-usage-details', $water_id) }}">Back</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Month</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($waterAverageConsumptions as $waterAverageConsumption)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $waterAverageConsumption['month'] }}</span></td>
                    <td><span>{{ $waterAverageConsumption['type'] }}</span></td>
                    <td><span>{{ $waterAverageConsumption['value'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditAverageConsumption({{ $waterAverageConsumption['id'] }})">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Average Water Consumption Update Modal --}}
<div class="modal fade" id="editAverageConsumption" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Average Water Consumption</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('average-consumption-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" id="type" class="form-control" name="type" required>
                            <input type="hidden" name="id" id="AverageConsumptionid">
                            <input type="hidden" name="month" id="AverageConsumptionMonth">
                            <input type="hidden" name="water_id" value="{{ $water_id }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" id="value" class="form-control" min="0" max="90" name="value" required>
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