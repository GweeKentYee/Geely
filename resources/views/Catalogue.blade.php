@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3><u>Catalogue</u></h3>
        </div>
    </div>
</div>
<div Class = "container">
    <div>
        @foreach ( $car as  $cars )
            <div class="card" style="width: 18rem; display: inline-block;">
                <div class="card-title">{{$cars->usedcar->carmodel->car_model}}</div>
                <div class="card-body">
                    <div>{{$cars->min_price}}</div>
                    <div>{{$cars->max_price}}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
