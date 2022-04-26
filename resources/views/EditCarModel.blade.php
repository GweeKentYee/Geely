@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <span style="font-size: 20px"><a href="/admin/brand_model_variant">Car Model</a> / {{ $CarModel->model }}</span>
                    </div>
                    <div class="card-body">
                    <form action="/admin/carmodel/editfunction/{{ $CarModel->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if (Session::has('field_empty'))
                            <div class="alert alert-danger">
                                <p>{{ Session::get('field_empty') }}</p>
                            </div>
                        @endif
                        <div class="modal-body">
                            <label>ID</label>
                            <input type="text" name="car_model_id" class="form-control" value="{{ $CarModel->id }}" readonly>
                            <br>
                            <label>Car Brand</label>
                            <input type="text" name="car_brand" class="form-control" value="{{ $CarModel->carBrand->brand }}" readonly>
                            <br>
                            <label>Car Model</label>
                            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" placeholder="{{ $CarModel->model }}">
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="/admin/brand_model_variant">Back</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
