@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Car Model</u></h3>
        <div class="col-md-9">
            <div style="text-align:right" class="pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarmodel">Add Car Model</button>
            </div>
            <table class="table" id="datatable" style="width: 100%">
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
                        <label>Car Brand</label>
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
                        <label>Car Model</label>
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
            "scrollX": true,
            "ajax": "{{ route('api.carmodel')}}",
            "columns": [
                {"data": "id"},
                {"data": "Car_Brand"},
                {"data": "model"},
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
            $('#newcarmodel').modal("show");
        @endif
    });

</script>
@endsection

