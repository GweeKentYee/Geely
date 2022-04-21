@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <h3><u>Car Brand</u></h3>
            <div class="col-md-9">
                <div style="text-align:right" class="pb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newcarbrand"><i class="bi bi-plus-lg"></i> Add Car Brand</button>
                </div>
                <table class="table" id="datatable" style="width: 100%">
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
                            <p style="color:red">*Required</p>
                            <label >Car Brand<span style="color:red"> *</span></label>
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
</main>
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
            "ajax": "{{ route('api.carbrand')}}",
             "columns": [
                {"data": "id"},
                {"data": "brand"},
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
             $('#newcarbrand').modal("show");
        @endif

    });

</script>
@endsection