@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <span style="font-size: 20px"><a href = "/admin/newsletter">Manage Newsletter</a> / {{ $newsletter->id }}</span>
                    </div>
                    <div class="card-body">
                        <form action="/admin/newsletter/editfunction/{{ $newsletter->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            @if (Session::has('field_empty'))
                            <br>
                            <div class="alert alert-danger">
                                <p>{{ Session::get('field_empty') }}</p>
                            </div>
                            @endif
                            <div class="modal-body">
                                <br>
                                <h5>Image: <a href="/admin/newsletter/view/{{ $newsletter->id }}" target="_blank">{{ $newsletter->image }}</a></h5>
                                <br>
                                <label>ID</label>
                                <input type="text" name="brand_id" class="form-control" value="{{ $newsletter->id }}" readonly>
                                <br>
                                <label>Remarks:</label>
                                <input type="text" name="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}" placeholder="{{$newsletter->remarks}}">
                                @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Link:</label>
                                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="{{$newsletter->link}}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Status: {{ $newsletter->status }}</label>
                                <select id = "status" name = "status" class = "form-select" placeholder="status" @error('status') is-invalid @enderror>
                                    <option value="Hidden">Hidden</option>
                                    <option value="Show">Show</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary" href="/admin/newsletter">Back</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
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
        $('#sequence').on('change', function (e) {
            $value = e.target.value;

            if($value==0){
                $('#sequence').value='Do Not Display';
            }
        });
    });
</script>

@endsection
