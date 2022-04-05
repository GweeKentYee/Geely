@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Manage Newsletter</u></h3>
        <div class="col-md-9">
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newnewsletter">New Newsletter</button>
            </div>
            <table class = "table" id = "datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Sequence</th>
                        <th>Action</th>
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
                            <label>Link:</label>
                            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" >
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label>Sequence:</label>
                            <input type="number" value="0" name="sequence" class="form-control @error('sequence') is-invalid @enderror" value="{{ old('sequence') }}" min = "0" max = "">
                            @error('sequence')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label>Image:</label>
                            <input type = "file" name = "image" class = "form-control @error('image') is-invalid @enderror" accept = "image/*">
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
                {"data": "Link"},
                {"data": "Image"},
                {"data": "sequence"},
                {"data": "Action", orderable: false, searchable: false}
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
