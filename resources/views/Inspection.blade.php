@extends('layouts.app')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="pagename">Inspection</h3>
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newinspection"><i class="bi bi-plus-lg"></i> New Inspection</button>
            </div>
            <table class = "table" id = "datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Registration_Number</th>
                        <th>Details</th>
                        <th>Delete</th>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/admin/inspection/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class = "inspection">
                            <p class="required">*Required</p>
                            <label>Car Brand<span class="required"> *</span></label>
                            <select id = "carBrand" name = "car_brand" class = "form-control @error('car_brand') is-invalid @enderror">
                                <option value="0" disabled selected>-- Please Select Car Brand --</option>
                                @foreach ($CarBrand as $CarBrand)
                                    <option value="{{$CarBrand->id}}">{{$CarBrand->brand}}</option>
                                @endforeach
                            </select>
                                @error('car_brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <label>Car<span class="required"> *</span></label>
                            <select id = "Car" name = "car" class = "form-control @error('car') is-invalid @enderror" disabled>
                            </select>
                                @error('car')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <label>Registration Number<span class="required"> *</span></label>
                            <input type="text" name="reg_num" class="form-control @error('reg_num') is-invalid @enderror" value="{{ old('reg_num') }}" >
                            @error('reg_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <hr>
                            <label>Data File<span class="required"> *</span></label>
                            <input type = "file" name = "data_file" class = "form-control @error('data_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                @error('data_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <label>Ownership File<span class="required"> *</span></label>
                            <input type = "file" name = "ownership_file" class = "form-control @error('ownership_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                @error('ownership_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value = "Add"></button>
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
            "scrollX": true,
            "ajax": "{{ route('api.inspection')}}",
            "columns": [
                {"data": "id"},
                {"data": "inspection_date"},
                {"data": "File", className: "text-center"},
                {"data": "Reg_Num"},
                {"data": "Details", orderable: false, searchable: false},
                {"data": "Delete", orderable: false, searchable: false}
            ]
        });

        $('#datatable').on('click', '.delete', function () {

            var confirmation = confirm('Delete the record?');

            if (confirmation == false){
                return false;
            }
        });

        $('#carBrand').on('change', function(e) {
            var CarBrand_id = e.target.value;
            $.ajax({
                url: "{{ route('carOption') }}",
                type: "POST",
                data: {
                    CarBrand_id: CarBrand_id
                },
                success: function(data) {
                    if($('#Car').prop('disabled')){
                        $("#Car").prop("disabled", false);
                    }
                    $('#Car').empty();
                    $('#Car').append('<option value="0" disabled selected>-- Please Select Available Car --</option>');
                    $.each(data.Cars, function(index, Car) {
                        $('#Car').append('<option value="'+Car.id+'">'+Car.car_model.model+' - '+Car.car_variant.variant+' - '+Car.year+' - '+Car.car_body_type.body_type+' - '+Car.car_general_spec.transmission+' - '+Car.car_general_spec.fuel+'</option>');
                    })
                }
            })
        });

        @if (Session::has('errors'))
            $('#newinspection').modal("show");
        @endif
    });

</script>

@endsection
