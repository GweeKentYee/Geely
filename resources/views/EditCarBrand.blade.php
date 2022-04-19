@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <span style="font-size: 20px"><a href="/admin/carbrand">Car Brand</a> / {{ $CarBrand->brand }}</span>
                </div>
                <div class="card-body">
                <form action="/admin/carbrand/editfunction/{{ $CarBrand->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @if (Session::has('field_empty'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('field_empty') }}</p>
                        </div>
                    @endif
                    <div class="modal-body">
                        <label>ID</label>
                        <input type="text" name="brand_id" class="form-control" value="{{ $CarBrand->id }}" readonly>
                        <br>
                        <label>Car Brand</label>
                        <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" placeholder="{{ $CarBrand->brand }}">
                        @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="/admin/carbrand">Back</a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection