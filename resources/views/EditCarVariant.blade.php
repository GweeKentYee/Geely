@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h3><u>Edit Car Variant</u></h3>
            <form action="/admin/carvariant/editfunction/{{ $CarVariant->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if (Session::has('field_empty'))
                    <div class="alert alert-danger">
                        <p>{{ Session::get('field_empty') }}</p>
                    </div>
                @endif
                <div class="modal-body">
                    <label>ID</label>
                    <input type="text" name="car_variant_id" class="form-control" value="{{ $CarVariant->id }}" readonly>
                    <br>
                    <label>Car Brand: {{ $CarVariant->carBrand->brand }}</label>
                    <select name="car_brand_id" class="form-control @error('car_brand_id') is-invalid @enderror">
                        <option value="0" disabled selected>-- Please Select Car Brand --</option>
                        @foreach ($CarBrand as $CarBrand)
                            <option value="{{$CarBrand->id}}">{{$CarBrand->brand}}</option>
                        @endforeach
                    </select>
                    @error('car_brand_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>Car Variant</label>
                    <input type="text" name="variant" class="form-control @error('variant') is-invalid @enderror" value="{{ old('variant') }}" placeholder="{{ $CarVariant->variant }}">
                    @error('variant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="/admin/carvariant">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection