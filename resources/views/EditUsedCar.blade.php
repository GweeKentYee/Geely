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

                    <form action="{{ url('/usedcarImage/update/'.$usedCarImage->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">Used Car ID:</label>
                            <input type="integer" name="usedcarImage-id" value="{{$usedCarImage->id}}" placeholder="{{$usedCarImage->id}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for=""class="col-form-label">Used Car Image:</label>
                            <input type="file" name="usedcarImage-image" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Updated At:</label>
                            <input type="timestamp" name="usedcarImage-updatedat" placeholder="{{$usedCarImage->updated_at}}" class="form-control"readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Created At:</label>
                            <input type="timestamp" name="usedcarImage-createdat" placeholder="{{$usedCarImage->created_at}}" class="form-control"readonly>
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