@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Car Variant</u></h3>
        <div class="col-md-9">
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-toggle="modal" data-target="#newinspection">Add Car Variant</button>
            </div>
            <table class = "table" id = "datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Variant</th>
                        <th>Type</th>
                        <th>Data_File_Path</th>
                        <th>Car_Model</th>
                        <th>Action</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>
</div>
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
                "ajax": "{{ route('api.carvariant')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "year"},
                    {"data": "variant"},
                    {"data": "type"},
                    {"data": "file"},
                    {"data": "car_model_id"},
                    {"data": "Action", orderable: false, searchable: false}
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