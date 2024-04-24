@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Cctvs - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

<script>
    function openEditCCTV(recordId) {
    let url = `{{url('fetchCCTV/${recordId}')}}`;
    $.ajax({
    url: url,
    type: 'GET',
    success: function(data) {
      $('#name').val(data.name);
      $('#video_url').val(data.video_url);
      
      $('#cctvupdateid').val(recordId);

      $('#editCCTVModal').modal('show');
    }
    });
  }
</script>
@endsection

@section('content')
<div class="card">
    <h5 class="card-header text-bolder">CCTV Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="cctvtable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr>
                    <th>Name</th>
                    <th>Date/Time</th>
                    <th>Video Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($cctvs as $cctv)
                <tr>
                    <td><span class="fw-medium">{{ $cctv['name'] }}</span></td>
                    <td>{{ convertDate($cctv['timestamp']) }}</td>
                    <td>{{ $cctv['video_url'] }}</td>
                    <td><a class="btn btn-success btn-sm text-white"
                            onclick="openEditCCTV({{ $cctv['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- CCTV Table Modal --}}
<div class="modal fade" id="editCCTVModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update CCTV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cctv-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                            <input type="hidden" name="id" id="cctvupdateid">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="video_url" class="form-label">Video Url</label>
                            <input type="text" id="video_url" class="form-control" name="video_url" required>
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

@php
    use Carbon\Carbon;
    function convertDate($date) {
        return Carbon::parse($date)->format('d-m-Y h:i A');
    }
@endphp