@extends('layouts.app')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="pagename">Used Car</h3>
            <br>
            <table class="table" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Minimum_Price</th>
                        <th>Maximum_Price</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th>Car_ID</th>
                        <th>Data_File</th>
                        <th>Ownership_File</th>
                        <th>Images</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</main>
@endsection
@section('footer-scripts')
<script>
$(document).ready(function () {
        $('#datatable').DataTable({
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
                {"data": "max_price"},
                {"data": "registration"},
                {"data": "Status"},
                {"data": "car_id"},
                {"data": "Data_File", className: "text-center"},
                {"data": "Ownership_File", className: "text-center"},
                {"data": "Images", className: "text-center"},
                {"data": "Edit", orderable: false, searchable: false},
                {"data": "Delete", orderable: false, searchable: false}
            ]
        });

        $('#datatable').on('click', '.delete', function () {

            var confirmation = confirm('Delete the record?');

            if (confirmation == false){

                return false;

            }
        });

    });
</script>
@endsection
