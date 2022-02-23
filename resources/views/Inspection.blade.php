@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><u>Inspection</u></h3>
        <div class="col-md-9">
            <div style = "text-align:right" class = "pb-1">
                <button class = "btn btn-primary" data-toggle="modal" data-target="#newinspection">New Inspection</button>
            </div>
            <table class = "table" id = "datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Used_Car_ID</th>
                        <th>Action</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">New Inspection</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="playerfile">
                            <label>File ( JSON, XML, Txt, PNG, JPEG ):</label>
                            <input type = "file" name = "json/txt" id = "playerjson" class = "form-control-file @error('json/txt') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                                @error('json/txt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                <label>Type:</label>
                                <input id="filetype" name = "file_type" type="text" class="form-control @error('file_type') is-invalid @enderror" value = "{{ old('file_type') }}" autocomplete="off" autofocus>
                                @error('file_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                <br>
                                <label>Permission:</label>
                                <select id="filepermission" name = "permission" class = "form-control @error('permission') is-invalid @enderror">
                                    <option value="0" disabled selected>-- Please Select Permission --</option>
                                    <option value="private">Private</option>
                                    <option value="global">Global</option>
                                </select>
                                    @error('permission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-outline-success" id = "AddSubmit" value="Add">
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
                "ajax": "{{ route('api.inspection')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "inspection_date"},
                    {"data": "file"},
                    {"data": "used_car_id"},
                    {"data": "Action", orderable: false, searchable: false}
                ]
            });

            $('#datatable').on('click', '.delete', function () {

                var confirmation = confirm('Delete the record?');

                if (confirmation == false){
                    return false;
                }
            });

        });

</script>
@endsection
