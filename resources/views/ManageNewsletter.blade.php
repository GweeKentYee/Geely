@extends('layouts.app')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="pagename">Manage Newsletter</h3>
                <div style = "text-align:right" class = "pb-1">
                    <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newnewsletter"><i class="bi bi-plus-lg"></i> Add Newsletter</button>
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
                        <h5 class="modal-title">Add Newsletter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="/admin/newsletter/add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <p class="required">*Required</p>
                            <div class = "newsletter">
                                <label>Remarks<span class="required"> *</span></label>
                                <input type="text" name="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}" >
                                @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Link<span class="required"> *</span></label>
                                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" >
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Status<span class="required"> *</span></label>
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
                                <label>Image<span class="required"> *</span></label>
                                <input type = "file" name = "image" class = "form-control @error('image') is-invalid @enderror" accept = "image/png,image/jpeg,image/bmp,image/tiff">
                                    @error('image')
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
                {"data": "Link", className: "text-center"},
                {"data": "Image", className: "text-center"},
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
