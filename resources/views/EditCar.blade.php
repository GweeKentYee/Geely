@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <span style="font-size: 20px"><a href="/admin/car">Car</a> / {{ $Car->carVariant->carModel->carBrand->brand }} {{ $Car->carVariant->carModel->model }} {{ $Car->carVariant->variant }}</span>
                    </div>
                    <div class="card-body">
                    <form action="/admin/car/editfunction/{{ $Car->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if (Session::has('field_empty'))
                            <div class="alert alert-danger">
                                <p>{{ Session::get('field_empty') }}</p>
                            </div>
                        @endif
                        <div class="modal-body">
                            <label>ID</label>
                            <input type="text" name="car_id" class="form-control" value="{{ $Car->id }}" readonly>
                            <br>
                            <label>Car</label>
                            <input type="text" name="car" class="form-control" value="{{ $Car->carVariant->carModel->carBrand->brand }} {{ $Car->carVariant->carModel->model }} {{ $Car->carVariant->variant }}" readonly>
                            <br>
                            <label>Manufacture Year</label>
                            <input type="text" name="year" class="form-control" value="{{ $Car->year }}" readonly>
                            <br>
                            <label>Body Type: {{ $Car->carBodyType->body_type }}</label>
                            <input type="text" name="car_body_type_id" class="form-control" value="{{ $Car->carBodyType->body_type }}" readonly>
                            <br>
                            <label>General Spec</label>
                            <input type="text" name="car_general_spec_id" class="form-control" value="{{ $Car->carGeneralSpec->transmission }}-{{ $Car->carGeneralSpec->fuel }}" readonly>
                            <hr>
                            <label>Spec File: <a href="/admin/car/file/viewspec/{{ $Car->id }}" target="_blank">{{ $Car->spec_file }}</a></label>
                            <input type="file" name="spec_file" class="form-control @error('spec_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            @error('spec_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label>Data File: <a href="/admin/car/file/viewdata/{{ $Car->id }}">{{ $Car->data_file }}</a></label>
                            <input type="file" name="data_file" class="form-control @error('data_file') is-invalid @enderror" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            @error('data_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="/admin/car">Back</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection