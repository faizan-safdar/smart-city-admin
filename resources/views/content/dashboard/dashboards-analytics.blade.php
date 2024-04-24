@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<style>
  .hoverdiv:hover {
    border-radius: 20px;
    box-shadow: 5px 6px 6px 2px #d8d9db;
    transform: scale(1.1);
  }
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <!-- recycle Bin  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('dustbin') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">Recycle Bins <i class="fa-solid fa-recycle ml-3"></i></h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-trash text-success" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{ $bins->count() }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div>
  <!-- cameras  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('cctv') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">CCTV's <i class="fa-solid fa-camera-rotate ml-3"></i> </h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-video text-danger" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{ $cctvs->count() }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div><!-- Street Lights  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('streetlights') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">Street lights <i class="fa-solid fa-lightbulb ml-3"></i></h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-lightbulb text-warning" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{ $streetlights->count() }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div>
  <!-- Buildings  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('energy') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">Buildings <i class="fa-solid fa-building ml-3"></i></h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-building-columns text-primary" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{ $energy->count() }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div>
  <!-- Water Floors  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('water-usage') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">Water Floors <i class="fa-solid fa-water ml-3"></i></h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-house-flood-water-circle-arrow-right text-info" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{ $waterfloor->count() }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div> <!-- Traffic Signals  -->
  <div class="col-lg-4 mb-4">
    <a href="{{ route('trafficsignals') }}">
      <div class="card hoverdiv">
        <div class="card-body p-3">
          <div class="">
            <div class="card-title m-0">
              <h5 class="text-nowrap mb-2">Traffic Signals <i class="fa-solid fa-traffic-light ml-3"></i></h5>
            </div>
            <div class="d-flex align-items-start justify-content-between mt-3">
              <div class="mt-sm-auto">
                <i class="fa-solid fa-road-bridge text-secondary" style="font-size: 35px;"></i>
              </div>
              <h1 class="mb-0">{{
                $trafficSignalOne->count()+$trafficSignalTwo->count()+$trafficSignalThree->count()+$trafficSignalFour->count()
                }}</h1>
            </div>
            <!-- <div id="profileReportChart"></div> -->
          </div>
        </div>
      </div>
    </a>
  </div>

</div>

@endsection