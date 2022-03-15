@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Car Variant</u></h3>
        <div class="col-md-12">
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarvariant">Add Car Variant</button>
            </div>
            <table class = "table" id = "datatable" style = "width: 100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Car_Model</th>
                        <th>Year</th>
                        <th>Variant</th>
                        <th>Type</th>
                        <th>Transmission</th>
                        <th>Fuel</th>
                        <th>Files</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>
    
    <div class="modal fade" id="newcarvariant" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Car Variant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/admin/carvariant/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label>Car Model</label>
                        <input type="text" name="car_model_id" class="form-control @error('car_model_id') is-invalid @enderror" value="{{ old('car_model_id') }}" placeholder="">
                        @error('car_model_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Variant</label>
                        <input type="text" name="variant" class="form-control @error('variant') is-invalid @enderror" value="{{ old('variant') }}" placeholder="">
                        @error('variant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Year</label>
                        <select id="year" name="year" class="form-control @error('year') is-invalid @enderror">
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
                        <label>Type</label>
                        <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Type --</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Wagon">Wagon</option>
                            <option value="Multi-Purpose Vehicle (MPV)">Multi-Purpose Vehicle (MPV)</option>
                            <option value="Sport Utility Vehicle (SUV)">Sport Utility Vehicle (SUV)</option>
                            <option value="Coupe">Coupe</option>
                            <option value="Convertible">Convertible</option>
                            <option value="Pickup">Pickup</option>
                            <option value="Commercial/Van">Commercial/Van</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Transmission</label>
                        <select id="transmission" name="transmission" class="form-control @error('transmission') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Transmission --</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                        @error('transmission')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Fuel</label>
                        <select id="fuel" name="fuel" class="form-control @error('fuel') is-invalid @enderror">
                            <option value="0" disabled selected>-- Please Select Fuel --</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                        </select>
                        @error('fuel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <hr>
                        <label>Specs File</label>
                        <input type="file" name="specs_file" class="form-control @error('specs_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                        @error('specs_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Data File</label>
                        <input type="file" name="data_file" class="form-control @error('data_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
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
            $('#datatable').DataTable({
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "scrollX": true, 
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.carvariant')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "Car_Model"},
                    {"data": "year"},
                    {"data": "variant"},
                    {"data": "type"},
                    {"data": "transmission"},
                    {"data": "fuel"},
                    {"data": "File"},
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

            @if (Session::has('errors'))
                $('#newcarvariant').modal("show");
            @endif

        });

</script>
@endsection