@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit & Update carmodel
                        <a href="/admin/carmodel" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('carmodel/update/'.$carmodel->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">ID:</label>
                            <input type="integer" name="carmodel-ID" placeholder="{{$carmodel->id}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Car Model:</label>
                            <input type="text" name="carmodel-carmodel" placeholder="{{$carmodel->car_model}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Updated At:</label>
                            <input type="timestamp" name="carmodel-updatedAt" placeholder="{{$carmodel->updated_at}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Creatd At:</label>
                            <input type="timestamp" name="carmodel-createdAt" placeholder="{{$carmodel->created_at}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update carmodel</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection