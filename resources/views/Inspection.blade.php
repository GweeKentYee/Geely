@extends('layouts.app')

@section('content')
<main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Inspection</u></h3>
        <div class="col-md-9">
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
        <div class="modal fade" id="newinspection" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Inspection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check form-switch">
                            <label class="form-check-label">Existing Used Car</label>
                            <input id = "ExistOption" name = "exist_option" class="form-check-input" type="checkbox" {{(old('exist_option') == "1") ? 'checked': ''}}>
                        </div>
                        <br>
                        <form id = "inspectionForm" action="/admin/inspection/add" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class = "newInspection">
                                <label>Car Brand:</label>
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
                                <label>Car:</label>
                                <select id = "Car" name = "car" class = "form-control @error('car') is-invalid @enderror" disabled>
                                </select>
                                    @error('car')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                                <label>Registration Number:</label>
                                <input type="text" id = "registration" name="registration_number" class="form-control @error('registration_number') is-invalid @enderror" value="{{ old('registration_number') }}" >
                                @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Data File:</label>
                                <input type = "file" name = "data_file" class = "form-control @error('data_file') is-invalid @enderror" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    @error('data_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                                <label>Ownership File:</label>
                                <input type = "file" name = "ownership_file" class = "form-control @error('ownership_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                    @error('ownership_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                            </div>
                            <div class = "newExistInspection">
                                <label>Registration Number:</label>
                                <select id = "registration" name = "registration_option" class = "form-control @error('registration_option') is-invalid @enderror">
                                    <option value="0" disabled selected>-- Please Select Registration Number --</option>
                                    @foreach ($UsedCars as $UsedCar)
                                        <option value="{{$UsedCar->id}}">{{$UsedCar->registration}}</option>
                                    @endforeach
                                </select>
                                    @error('registration_option')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                                <label>Data File:</label>
                                <input type = "file" name = "data_file" class = "form-control @error('data_file') is-invalid @enderror" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    @error('data_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                                <label>Ownership File:</label>
                                <input type = "file" name = "ownership_file" class = "form-control @error('ownership_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                    @error('ownership_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
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
    </div>
</main>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function () {

        $(".newExistInspection *").prop('disabled',true).hide();

        $("#ExistOption").click(function() {

            if ($('#ExistOption').is(':checked')) {

                $('#inspectionForm').attr('action', '/admin/inspection/exist/add');

                $(".newInspection *").prop('disabled',true).hide();

                $(".newExistInspection *").prop('disabled',false).show();


            } else {

                $('#inspectionForm').attr('action', '/admin/inspection/add');

                $(".newInspection *").prop('disabled',false).show();

                $(".newExistInspection *").prop('disabled',true).hide();

            }

        });

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
                    $('#Car').append('<option value="volvo" disabled selected>-- Please Select Available Car --</option>');
                    $.each(data.Cars, function(index, Car) {
                        $('#Car').append('<option value="'+Car.id+'">'+Car.car_variant.car_model.model+' - '+Car.car_variant.variant+' - '+Car.year+' - '+Car.car_body_type.body_type+' - '+Car.car_general_spec.transmission+' - '+Car.car_general_spec.fuel+'</option>');
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
