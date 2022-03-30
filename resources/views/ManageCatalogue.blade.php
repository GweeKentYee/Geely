@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Manage Catalogue</u></h3>
        <div class="col-md-9">
            <table class = "table" id = "datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Used_Car_ID</th>
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
                "ajax": "{{ route('api.ManageCatalogue')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "min_price"},
                    {"data": "max_price"},
                    {"data": "used_car_id"},
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
