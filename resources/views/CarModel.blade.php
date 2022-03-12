@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3><u>Car Model</u></h3>
            <div class="col-md-9">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

                <div style = "text-align:left" class = "pb-1">
                    <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarmodel">New CarModel</button>
                </div>

                <table class = "table" id = "datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Car_Model</th>
                            <th>Created_At</th>
                            <th>Updated_At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
        </div>
    </div>
    <div class="modal fade" id="newcarmodel" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">New Car Model</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <form action="/admin/carmodel/add" method="put" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">

                      <div class="carmodel">
                        <label for="message-text" class="col-form-label">Car Model:</label>
                        <input type="text" class="form-control" id="carmodel" name="carmodel">
                      </div>
                  </div>
                  <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">add</button>

                  </div>
                </form >
            </div>
        </div>
    </div>
    <div class="modal fade" id="carmodeldetails" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Details of Car Model</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form  enctype="multipart/form-data">

                <div class="modal-body">

                        <div class="details-carmodel">
                        <label for="message-text" class="col-form-label">ID:</label>
                        <p id = "detail-id" class="form-control"type="integer" readonly></p>
                        </div>
                        <div class="details-carmodel">
                        <label for="message-text" class="col-form-label">Car Model:</label>
                        <p id = "detail-carModel" class="form-control" type="varchar" readonly></p>
                        </div>
                        <div class="details-carmodel">
                        <label for="message-text" class="col-form-label">Updated At:</label>
                        <p id="detail-updatedAt" class="form-control" type="timestamp" readonly></p>
                        </div>
                        <div class="details-carmodel">
                        <label for="message-text" class="col-form-label">Created At:</label>
                        <p id="detail-createdAt" class="form-control" type="timestamp" readonly></p>
                      </div>
                  </div>
                </form >
            </div>
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
        "ajax": "{{ route('api.carmodel')}}",
        "columns": [
            {"data": "id"},
            {"data": "car_model"},
            {"data": "created_at"},
            {"data": "updated_at"},
            {"data": "Action", orderable: false, searchable: false}
        ]
    });

});
</script>
<script>
$(document).ready(function(){
        $('#datatable').on('click', '.detail', function () {
            const id = $(this).attr('data-id');
            $.ajax({
                url:'/carmodel/fetch/'+id,
                type:'get',
                data:{
                    "id": id
                },
                success:function(data){
                    $('#detail-id').html(data.id),
                    $('#detail-carModel').html(data.car_model),
                    $('#detail-updatedAt').html(data.updated_at),
                    $('#detail-createdAt').html(data.created_at);
                }
            })
        });

    });
</script>
@endsection
