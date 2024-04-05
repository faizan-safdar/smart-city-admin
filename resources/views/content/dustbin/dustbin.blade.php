@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <td><a class="btn btn-primary btn-sm text-white" href="{{ route('dustbin-details', $bin['id']) }}">View</a></span></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection