@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h3><u>Edit Car</u></h3>
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
                    <label>Manufacture Year: {{ $Car->year }}</label>
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
                    <label>Body Type: {{ $Car->carBodyType->body_type }}</label>
                    <select id="bodyType" name="car_body_type_id" class="form-control @error('car_body_type_id') is-invalid @enderror">
                        <option value="0" disabled selected>-- Please Select Car Body Type --</option>
                        @foreach ($CarBodyType as $CarBodyType)
                            <option value="{{$CarBodyType->id}}">{{$CarBodyType->body_type}}</option>
                        @endforeach
                    </select>
                    @error('car_body_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>General Spec: {{ $Car->carGeneralSpec->transmission }}-{{ $Car->carGeneralSpec->fuel }}</label>
                    <select id="generalSpec" name="car_general_spec_id" class="form-control @error('car_general_spec_id') is-invalid @enderror">
                        <option value="0" disabled selected>-- Please Select Transmission-Fuel --</option>
                        @foreach ($CarGeneralSpec as $CarGeneralSpec)
                            <option value="{{$CarGeneralSpec->id}}">{{$CarGeneralSpec->transmission}}-{{$CarGeneralSpec->fuel}}</option>
                        @endforeach
                    </select>
                    @error('car_general_spec_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <hr>
                    <label>Spec File: <a href="/admin/car/file/viewspec/{{ $Car->id }}">{{ $Car->spec_file }}</a></label>
                    <input type="file" name="spec_file" class="form-control @error('spec_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    @error('spec_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>Data File: <a href="/admin/car/file/viewdata/{{ $Car->id }}">{{ $Car->data_file }}</a></label>
                    <input type="file" name="data_file" class="form-control @error('data_file') is-invalid @enderror" accept="application/JSON,application/xml,text/plain,text/xml,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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
@endsection