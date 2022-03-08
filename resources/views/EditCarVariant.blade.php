@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h3><u>Edit Car Variant</u></h3>
            <form action="/admin/carvariant/editfunction/{{ $car_variant->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if (Session::has('field_empty'))
                    <div class="alert alert-danger">
                        <p>{{ Session::get('field_empty') }}</p>
                    </div>
                @endif
                <div class="modal-body">
                    <label>Car Model</label>
                    <input type="text" name="car_model_id" class="form-control" value="{{ $car_variant->car_model_id }}" readonly>
                    <br>
                    <label>Variant</label>
                    <input type="text" name="variant" class="form-control @error('variant') is-invalid @enderror" value="{{ old('variant') }}" placeholder="{{ $car_variant->variant }}">
                    @error('variant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>Year: {{ $car_variant->year }}</label>
                    <select id="year" name="year" class="form-control @error('year') is-invalid @enderror">
                        <option value="0" disabled selected>-- Please Select Year --</option>
                        @for ($year=1920; $year<=2022; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>Type: {{ $car_variant->type }}</label>
                    <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                        <option value="0" disabled selected>-- Please Select Type --</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Wagon">Wagon</option>
                        <option value="Multi-Purpose Vehicle (MPV)">Multi-Purpose Vehicle (MPV)</option>
                        <option value="Sport Utility Vehicle (SUV)">Sport Utility Vehicle (SUV)</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Convertible">Convertible</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Commercial/Van">Commercial/Van</option>
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr>
                    <label>Data File: <a href="/admin/carvariant/file/view/{{ $car_variant->id }}">{{ $car_variant->file }}</a></label>
                    <br>
                    <input type="file" name="data_file" class="form-control-file @error('data_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                    @error('data_file')
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