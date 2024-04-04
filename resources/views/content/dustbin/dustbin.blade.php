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
<head>

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
</head>
<body>
    <table class="table">
        <th>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>text</td>
                <td>fill_percentage</td>
                <td>image</td>
            </tr>
        </th>
        <tbody>
            <tr>
                <td>1</td>
                <td>bin1</td>
                <td>fillit</td>
                <td>50%</td>
                <td>image</td>
            </tr>
            <tr>
                <td>2</td>
                <td>bin1</td>
                <td>fillit</td>
                <td>70%</td>
                <td>image</td>
            </tr>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function (){
            $('.table').Datatable();
        });
    </script>
</body>
@endsection
