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
            <div style = "text-align:left" class = "pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newusedcar">New UsedCar</button>
            </div>

            <table class = "table" id = "usedcar">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Car_variant_id</th>
                        <th>Created_at</th>
                        <th>updated_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="newusedcar" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">New Used Car</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <form action="/admin/usedcar/add" method="get" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">

                      <div class="add-usedcar">
                        <label for="message-text" class="col-form-label">File:</label>
                        <input type="varchar" class="form-control" id="add-file" name="add-file">
                      </div>

                      <div class="add-usedcar">
                        <label for="message-text" class="col-form-label">Status:</label>
                        <input type="varchar" class="form-control" id="add-status" name="add-status">
                      </div>

                      <div class="add-usedcar">
                        <label for="message-text" class="col-form-label">Car Variant ID:</label>
                        <select type= "bigint" class="form-control" name="add-car_variant_id" id="add-car_variant_id">
                            <option value="">Select a Car Variant Id</option>
                            @foreach($carvariantid as $carvariantid) 
                              <option id="add-car_variant_id" value="{{ $carvariantid->id }}">{{ $carvariantid->id }}  </option>
                            @endforeach
                        </select>

                      </div>
                  </div>
                  <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">add</button>

                  </div>
                </form >
            </div>
        </div>
    </div>
    <div class="modal fade" id="usedcardetails" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Details of Used Car</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form  enctype="multipart/form-data">

                <div class="modal-body">

                        <div class="details-usedcar">
                        <label for="message-text" class="col-form-label">ID:</label>
                        <p id = "detail-id" class="form-control"type="integer" readonly></p>
                        </div>
                        <div class="details-usedcar">
                        <label for="message-text" class="col-form-label">File:</label>
                        <p id = "detail-file" class="form-control" type="varchar" readonly></p>
                        </div>
                        <div class="details-usedcar">
                        <label for="message-text" class="col-form-label">Status:</label>
                        <p id="detail-status" class="form-control" type="varchar" readonly></p>
                        </div>
                        <div class="details-usedcar">
                        <label for="message-text" class="col-form-label">Car Variant ID:</label>
                        <p id="detail-carvariantid" class="form-control" type="bigint" readonly></p>
                        </div>
                        <div class="details-usedcar">
                        <label for="message-text" class="col-form-label">Updated At:</label>
                        <p id="detail-updatedAt" class="form-control" type="timestamp" readonly></p>
                        </div>
                        <div class="details-usedcar">
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
                    {"data": "file"},
                    {"data":"status"},
                    {"data": "car_variant_id"},
                    {"data": "created_at"},
                    {"data": "updated_at"},
                    {"data": "Action", orderable: false, searchable: false}
                ]
            });
            
        });
</script>
<script>
    $(document).ready(function(){
        $('#usedcar').on('click', '.detail', function () {
            const id = $(this).attr('usedcar-data-id');
            $.ajax({
                url:'/usedcar/fetch/'+id,
                type:'GET',
                data:{
                    "id": id
                },
                success:function(data){
                    $('#detail-id').html(data.id),
                    $('#detail-file').html(data.file),
                    $('#detail-status').html(data.status),
                    $('#detail-carvariantid').html(data.car_variant_id),
                    $('#detail-createdAt').html(data.created_at),
                    $('#detail-updatedAt').html(data.updated_at);
                }
            })
        });

    });
</script>
@endsection
