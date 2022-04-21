@extends('layouts.app')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <h3 class="pagename">Brand/Model/Variant</h3>
    </div>
    <br>
    <br>
    <div>
        <ul class="nav nav-tabs" id="tabMenu">
            <li class="nav-item">
                <a href="#carbrandtab" id="brandtab" class="nav-link active" data-bs-toggle="tab">Brand</a>
            </li>
            <li class="nav-item">
                <a href="#carmodeltab" id="modeltab" class="nav-link" data-bs-toggle="tab">Model</a>
            </li>
            <li class="nav-item">
                <a href="#carvarianttab" id="varianttab" class="nav-link" data-bs-toggle="tab">Variant</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="carbrandtab">
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div style="text-align:right" class="pb-1">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarbrand"><i class="bi bi-plus-lg"></i> Add Car Brand</button>
                        </div>
                        <table class="table" id="carbrandtab-dt" style="width: 100%">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            <thead>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="newcarbrand" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Car Brand</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="/admin/carbrand/add" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p class="required">*Required</p>
                                    <label >Car Brand<span class="required"> *</span></label>
                                    <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" placeholder="">
                                    @error('brand')
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
            <div class="tab-pane fade" id="carmodeltab">
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div style="text-align:right" class="pb-1">
                            <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarmodel"><i class="bi bi-plus-lg"></i> Add Car Model</button>
                        </div>
                        <table class="table" id="carmodeltab-dt" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            <thead>
                        </table>
                    </div>
                </div>
            
                <div class="modal fade" id="newcarmodel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Car Model</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="/admin/carmodel/add" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p class="required">*Required</p>
                                    <label>Car Brand<span class="required"> *</span></label>
                                    <select name = "car_brand" class = "form-control @error('car_brand') is-invalid @enderror">
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
                                    <label>Car Model<span class="required"> *</span></label>
                                    <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" placeholder="">
                                    @error('model')
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
            <div class="tab-pane fade" id="carvarianttab">
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div style="text-align:right" class="pb-1">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarvariant"><i class="bi bi-plus-lg"></i> Add Car Variant</button>
                        </div>
                        <table class="table" id="carvarianttab-dt" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Variant</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            <thead>
                        </table>
                    </div>
                </div>
            
                <div class="modal fade" id="newcarvariant" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Car Variant</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="/admin/carvariant/add" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p class="required">*Required</p>
                                    <label>Car Brand<span class="required"> *</span></label>
                                    <select id="carBrand" name="car_brand" class="form-control">
                                        <option value="0" disabled selected>-- Please Select Car Brand --</option>
                                        @foreach ($CarBrand2 as $CarBrand)
                                            <option value="{{$CarBrand->id}}">{{$CarBrand->brand}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Car Model<span class="required"> *</span></label>
                                    <select id="carModel" name="car_model" class="form-control @error('car_model') is-invalid @enderror" disabled>
                                    </select>
                                    @error('car_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                                    <label>Car Variant<span class="required"> *</span></label>
                                    <input type="text" name="variant" class="form-control @error('variant') is-invalid @enderror" value="{{ old('variant') }}" placeholder="">
                                    @error('variant')
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
        </div>
    </div>
</div>
</main>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function () {
        $('#carbrandtab-dt').DataTable({
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "scrollX": true, 
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.carbrand')}}",
             "columns": [
                {"data": "id"},
                {"data": "brand"},
                {"data": "Edit", orderable: false, searchable: false},
                {"data": "Delete", orderable: false, searchable: false}
            ]}
        );

        $('#brandtab').on("show.bs.tab", function(e){
            $('#carbrandtab-dt').DataTable().ajax.reload();
        });
        
        $('#carbrandtab-dt').on('click', '.delete', function () {

            var confirmation = confirm('Delete the record?');

            if (confirmation == false){
                return false;
            }
        });

        $('#modeltab').on("show.bs.tab", function(e){
            $('#carmodeltab-dt').DataTable({
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax": "{{ route('api.carmodel')}}",
            "columns": [
                {"data": "id"},
                {"data": "Car_Brand"},
                {"data": "model"},
                {"data": "Edit", orderable: false, searchable: false},
                {"data": "Delete", orderable: false, searchable: false}
            ]});
        });

        $('#carmodeltab-dt').on('click', '.delete', function () {

            var confirmation = confirm('Delete the record?');

            if (confirmation == false){
                return false;
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#varianttab').on("show.bs.tab", function(e){
            $('#carvarianttab-dt').DataTable({
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax": "{{ route('api.carvariant')}}",
            "columns": [
                {"data": "id"},
                {"data": "Car_Brand"},
                {"data": "Car_Model"},
                {"data": "variant"},
                {"data": "Edit", orderable: false, searchable: false},
                {"data": "Delete", orderable: false, searchable: false}
            ]});
        });

        $('#carvarianttab-dt').on('click', '.delete', function () {

            var confirmation = confirm('Delete the record?');

            if (confirmation == false){
                return false;
            }
        });

        $('#carBrand').on('change', function(e) {
            var CarBrand_id = e.target.value;
            $.ajax({
                url: "{{ route('subOptions') }}",
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

        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });

</script>
@if(Session::get('error_code') == 1)
<script>
    $(function() {
        $('#newcarbrand').modal("show");
    });
</script>
@elseif(Session::get('error_code') == 2)
<script>
    $(function() {
        $('#newcarmodel').modal("show");
    });
</script>
@elseif(Session::get('error_code') == 3)
<script>
    $(function() {
        $('#newcarvariant').modal("show");
    });
</script>
@endif
@endsection