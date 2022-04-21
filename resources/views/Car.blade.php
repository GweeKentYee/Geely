@extends('layouts.app')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="pagename">Car</h3>
            <div style="text-align:right" class="pb-1">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcar"><i class="bi bi-plus-lg"></i> Add Car</button>
            </div>
            <table class="table" id="datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Variant</th>
                        <th>Year</th>
                        <th>Body_Type</th>
                        <th>Transmission</th>
                        <th>Fuel</th>
                        <th>Spec_File</th>
                        <th>Data_File</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>
    
    <div class="modal fade" id="newcar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Car</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/admin/car/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p class="required">*Required</p>
                        <label>Car Brand<span class="required"> *</span></label>
                        <select id="carBrand" name="car_brand" class="form-control">
                            <option value="0" disabled selected>-- Please Select Car Brand --</option>
                            @foreach ($CarBrand as $CarBrand)
                                <option value="{{$CarBrand->id}}">{{$CarBrand->brand}}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>Car Model<span class="required"> *</span></label>
                        <select id="carModel" name="car_model" class="form-control" disabled>
                        </select>
                        <br>
                        <label>Car Variant<span class="required"> *</span></label>
                        <select id="carVariant" name="car_variant" class="form-control @error('car_variant') is-invalid @enderror" disabled>
                        </select>
                        @error('car_variant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Manufacture Year<span class="required"> *</span></label>
                        <select name="year" class="form-control @error('year') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Year --</option>
                            @for ($year=1920; $year<=2022; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Body Type<span class="required"> *</span></label>
                        <select name="car_body_type" class="form-control @error('car_body_type') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Car Body Type --</option>
                            @foreach ($CarBodyType as $CarBodyType)
                            <option value="{{$CarBodyType->id}}">{{$CarBodyType->body_type}}</option>
                        @endforeach
                        </select>
                        @error('car_body_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>General Spec<span class="required"> *</span></label>
                        <select name="car_general_spec" class="form-control @error('car_general_spec') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Transmission-Fuel --</option>
                            @foreach ($CarGeneralSpec as $CarGeneralSpec)
                            <option value="{{$CarGeneralSpec->id}}">{{$CarGeneralSpec->transmission}}-{{$CarGeneralSpec->fuel}}</option>
                        @endforeach
                        </select>
                        @error('car_general_spec')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <hr>
                        <label>Spec File</label>
                        <input type="file" name="spec_file" class="form-control @error('spec_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        @error('spec_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Data File<span class="required"> *</span></label>
                        <input type="file" name="data_file" class="form-control @error('data_file') is-invalid @enderror" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        @error('data_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
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
            "scrollX": true, 
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.car')}}",
            "columns": [
                {"data": "id"},
                {"data": "Car_Brand"},
                {"data": "Car_Model"},
                {"data": "Car_Variant"},
                {"data": "year"},
                {"data": "Body_Type"},
                {"data": "Transmission"},
                {"data": "Fuel"},
                {"data": "Spec_File", className: "text-center"},
                {"data": "Data_File", className: "text-center"},
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

        $('#carBrand').on('change', function(e) {
            var CarBrand_id = e.target.value;
            $.ajax({
                url: "{{ route('subModels') }}",
                type: "POST",
                data: {
                    CarBrand_id: CarBrand_id
                },
                success: function(data) {
                    if($('#carModel').prop('disabled')){
                        $("#carModel").prop("disabled", false);
                    }

                    $('#carModel').empty();
                    $('#carModel').append('<option value="0" disabled selected>-- Please Select Car Model --</option>');

                    $.each(data.CarModels, function(index, CarModel) {
                        $('#carModel').append('<option value="'+CarModel.id+'">'+CarModel.model+'</option>');
                    })
                    
                }
            })
        });

        $('#carModel').on('change', function(e) {
            var CarModel_id = e.target.value;
            $.ajax({
                url: "{{ route('subVariants') }}",
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

        @if (Session::has('errors'))
            $('#newcar').modal("show");
        @endif

    });

</script>
@endsection