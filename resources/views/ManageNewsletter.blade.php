@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <h3><u>Manage Newsletter</u></h3>
            <div class="col-md-9">
                <div style = "text-align:right" class = "pb-1">
                    <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newnewsletter"><i class="bi bi-plus-lg"></i> New Newsletter</button>
                </div>
                <table class = "table" id = "datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Remarks</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    <thead>
                </table>
            </div>
        </div>

        <div class="modal fade" id="newnewsletter" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Newsletter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="/admin/newsletter/add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class = "newsletter">
                                <label>Remarks:</label>
                                <input type="text" name="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}" >
                                @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Link:</label>
                                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" >
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Status:</label>
                                <select id = "status" name = "status" class = "form-control @error('status') is-invalid @enderror">
                                    <option value="Hidden">Hidden</option>
                                    <option value="Show">Show</option>
                                </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br>
                                <label>Image:</label>
                                <input type = "file" name = "image" class = "form-control @error('image') is-invalid @enderror" accept = "image/png,image/jpeg,image/bmp,image/tiff">
                                    @error('image')
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
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax": "{{ route('api.newsletter')}}",
            "columns": [
                {"data": "id"},
                {"data": "remarks"},
                {"data": "Link"},
                {"data": "Image"},
                {"data": "status"},
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

        $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
        });

        @if (Session::has('errors'))
            $('#newnewsletter').modal("show");
        @endif

    });

</script>

@endsection
