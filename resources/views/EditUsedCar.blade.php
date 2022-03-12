@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit & Update Used Car
                        <a href="/admin/usedcar" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/usedcar/update/'.$UsedCar->id) }}" method="get">
                        @csrf
                        @method('get')

                        <div class="form-group mb-3">
                            <label for="">ID:</label>
                            <input type="integer" name="usedcar-id" placeholder="{{$UsedCar->id}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">File:</label>
                            <input type="varchar" name="usedcar-file" placeholder="{{$UsedCar->file}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Status:</label>
                            <input type="varchar" name="usedcar-status" placeholder="{{$UsedCar->status}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Car Variant ID:</label>
                        <select type= "bigint" class="form-control" name="edit-car_variant_id" id="edit-car_variant_id" class="form-control">
                            <option placeholder="{{$UsedCar->car_variant_id}}">{{$UsedCar->car_variant_id}}</option>
                            @foreach($carvariantid as $carvariantid) 
                              <option id="edit-car_variant_id" value="{{ $carvariantid->id }}">{{ $carvariantid->id }}  </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Updated At:</label>
                            <input type="timestamp" name="usedcar-updatedat" placeholder="{{$UsedCar->updated_at}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Created At:</label>
                            <input type="timestamp" name="usedcar-createdat" placeholder="{{$UsedCar->created_at}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update usedcar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection