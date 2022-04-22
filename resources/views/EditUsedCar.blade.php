@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                    <span style="font-size: 20px"><a href="/admin/usedcar">Used Car</a> / {{ $UsedCar->registration }}</span>
                    </div>
                    <div class="card-body">
                    <form action="{{ url('/admin/usedcar/edit/'.$UsedCar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                                <div class="form-group mb-3">
                                <label for="message-text" class="col-form-label">Minimum Price</label>
                                <input type="integer" placeholder="{{$UsedCar->min_price}}" class="form-control @error('min_price') is-invalid @enderror" id="min_price" name="min_price">
                                @error('min_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>

                            <div class="form-group mb-3">
                                <label for="message-text" class="col-form-label">Maximum Price</label>
                                <input type="integer"  placeholder="{{$UsedCar->max_price}}" class="form-control @error('max_price') is-invalid @enderror" id="max_price" name="max_price">
                                @error('max_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="message-text" class="col-form-label">Car Registration Number</label>
                                <input type="varchar" value="{{$UsedCar->registration}}" placeholder="{{$UsedCar->registration}}" class="form-control @error('registration') is-invalid @enderror" id="registration" name="registration" readonly>
                                @error('registration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                @if ($UsedCar->status == 0 )
                                <label for="message-text" class="col-form-label">Status: Hidden</label>
                                @elseif($UsedCar->status == 1)
                                <label for="message-text" class="col-form-label">Status: Catalogue</label>
                                @elseif($UsedCar->status == 2)
                                    <label for="message-text" class="col-form-label">Status: Whole Sale</label>
                                @endif
                                <select type="integer" class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option selected disabled>-- Please Select a Status --</option>
                                    <option value="0">Hidden</option>
                                    <option value="1">Catalogue</option>
                                    <option value="2">Wholesale</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="message-text" class="col-form-label">Car ID</label>
                                <input type= "bigint" placeholder="{{$UsedCar->car_id}}" class="form-control @error('car_id') is-invalid @enderror" name="car_id" id="car_id" readonly>
                                @error('car_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>

                            <div class="form-group mb-3">
                                <label for="" class="col-form-label">Data File: <a href = "/admin/usedcar/file/viewdata/{{ $UsedCar->car_id }}">{{ $UsedCar->data_file }}</a></label>
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="col-form-label">Ownership File: <a href = "/admin/usedcar/file/viewownership/{{ $UsedCar->car_id }}">{{ $UsedCar->ownership_file }}</a></label>
                                <input type="file" value="{{$UsedCar->ownership_file}}" class="form-control @error('ownership_file') is-invalid @enderror" id="ownership_file" name="ownership_file">
                                @error('ownership_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <a class="btn btn-secondary" href="/admin/usedcar">Back</a>
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
