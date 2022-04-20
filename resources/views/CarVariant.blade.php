@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <h3><u>Car Variant</u></h3>
            <div class="col-md-9">
                <div style="text-align:right" class="pb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarvariant"><i class="bi bi-plus-lg"></i> Add Car Variant</button>
                </div>
                <table class="table" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        <p style="color:red">*Required</p>
                        <label>Car Brand<span style="color:red"> *</span></label>
                        <select id="carBrand" name="car_brand" class="form-control @error('car_brand') is-invalid @enderror">
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
                        <label>Car Model<span style="color:red"> *</span></label>
                        <select id="carModel" name="car_model" class="form-control @error('car_model') is-invalid @enderror" disabled>
                        </select>
                        @error('car_model')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label>Car Variant<span style="color:red"> *</span></label>
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
</main>
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
            "ajax": "{{ route('api.carvariant')}}",
            "columns": [
                {"data": "id"},
                {"data": "Car_Model"},
                {"data": "variant"},
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

        @if (Session::has('errors'))
            $('#newcarvariant').modal("show");
        @endif
    });

</script>
@endsection