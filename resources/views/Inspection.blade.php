@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Inspection</u></h3>
        <div class="col-md-9">
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newinspection">New Inspection</button>
            </div>
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
    <div class="modal fade" id="newinspection" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Inspection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/inspection/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class = "inspection">
                            <label>Car Model:</label>
                            <select id = "carModel" name = "car_model" class = "form-control @error('car_model') is-invalid @enderror">
                                <option value="0" disabled selected>-- Please Select Car Model --</option>
                                @foreach ($CarModel as $CarModel)
                                    <option value="{{$CarModel->id}}">{{$CarModel->car_model}}</option>
                                @endforeach
                            </select>
                                @error('car_model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <label>Car Variant:</label>
                            <select id = "carVariant" name = "car_variant" class = "form-control @error('car_variant') is-invalid @enderror" disabled>
                            </select>
                                @error('car_variant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <label>File:</label>
                            <input type = "file" name = "data_file" class = "form-control-file @error('data_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                @error('data_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-outline-primary" value = "Add"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#datatable').DataTable({
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.inspection')}}",
            "columns": [
                {"data": "id"},
                {"data": "inspection_date"},
                {"data": "file"},
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

        $('#carModel').on('change', function(e) {
            var CarModel_id = e.target.value;
            $.ajax({
                url: "{{ route('subCarVariant') }}",
                type: "POST",
                data: {
                    CarModel_id: CarModel_id
                },
                success: function(data) {
                    if($('#carVariant').prop('disabled')){
                        $("#carVariant").prop("disabled", false);
                    }
                    $('#carVariant').empty();
                    $('#carVariant').append('<option value="0" disabled selected>-- Please Select Car Variant --</option>');
                    $.each(data.CarVariants, function(index, CarVariant) {
                        $('#carVariant').append('<option value="'+CarVariant.id+'">'+CarVariant.variant+'</option>');
                    })
                }
            })
        });
    });

</script>
@endsection
