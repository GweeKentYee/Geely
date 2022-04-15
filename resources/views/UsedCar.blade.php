@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3><u>Used Car Details</u></h3>
            <div class="col-md-9">

             @if (session('status'))
             <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <table class = "table" id = "usedcar">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Minimum_Price</th>
                    <th>Maximum_Price</th>
                    <th>Registration</th>
                    <th>Data_File</th>
                    <th>Ownership_File</th>
                    <th>Status</th>
                    <th>Car_ID</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('footer-scripts')
<script>
$(document).ready(function () {
        $('#usedcar').DataTable({
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.usedcar')}}",
            "columns": [
                {"data": "id"},
                {"data": "min_price"},
                {"data":"max_price"},
                {"data": "registration"},
                {"data": "data_file"},
                {"data": "ownership_file"},
                {"data": "status"},
                {"data": "car_id"},
                {"data": "Action", orderable: false, searchable: false}
            ]
        });
        
    });
</script>
@endsection