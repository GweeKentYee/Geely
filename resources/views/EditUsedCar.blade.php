@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <a href="/admin/usedcar">UsedCar/</a>Edit
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/usedcar/update/'.$UsedCar->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Minimum Price:</label>
                            <input type="integer" value="{{ $UsedCar->min_price }}"
                                class="form-control @error('minimum_price') is-invalid @enderror" id="minimum_price"
                                name="minimum_price">
                            @error('minimum_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Maximum Price:</label>
                            <input type="integer" value="{{ $UsedCar->max_price }}"
                                class="form-control @error('maximum_price') is-invalid @enderror" id="maximum_price"
                                name="maximum_price">
                            @error('maximum_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Registration:</label>
                            <input type="varchar" value="{{ $UsedCar->registration }}"
                                placeholder="{{ $UsedCar->registration }}"
                                class="form-control @error('registration') is-invalid @enderror" id="registration"
                                name="registration" readonly>
                            @error('registration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="col-form-label">Data File:</label>
                            <input type="varchar" value="{{ $UsedCar->data_file }}"
                                placeholder="{{ $UsedCar->data_file }}"
                                class="form-control @error('data_file') is-invalid @enderror" id="data_file"
                                name="data_file" readonly>
                            @error('data_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="col-form-label">Ownership File:
                                {{ $UsedCar->ownership_file }}</label>
                            <input type="file" value="{{ $UsedCar->ownership_file }}"
                                class="form-control @error('ownership_file') is-invalid @enderror" id="ownership_file"
                                name="ownership_file">
                            @error('ownership_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            @if($UsedCar->status == 1 )
                                <label for="message-text" class="col-form-label">Status: Hidden</label>
                            @elseif($UsedCar->status == 2)
                                <label for="message-text" class="col-form-label">Status: Catalogue</label>
                            @elseif($UsedCar->status == 2)
                                <label for="message-text" class="col-form-label">Status: Whole Sale</label>
                            @endif
                            <select type="integer" value="{{ $UsedCar->status }}"
                                class="form-control @error('status_') is-invalid @enderror" id="status_" name="status_">
                                <option value="{{ $UsedCar->status }}">---Please Select a Status---</option>
                                <option value="1">Hidden</option>
                                <option value="2">Catalogue</option>
                                <option value="3">Whole Sale</option>
                            </select>
                            @error('status_')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Car ID:</label>
                            <input type="bigint" placeholder="{{ $UsedCar->car_id }}"
                                class="form-control @error('car_id') is-invalid @enderror" name="car_id" id="car_id"
                                readonly>
                            @error('car_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Used Car Image</button>
                        </div>



                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
