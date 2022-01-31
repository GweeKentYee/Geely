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
            <div class="card" style="width: 15rem; display: inline-block;">
                <div style="display:flex; justify-content: center; margin:5px;">
                    <div class="card-image" style="width: 12.5rem;justify-content:center;">   
                        <img src="{{$cars->usedcar->file}}" alt={{$cars->usedcar->carmodel->car_model}}>
                    </div>
                </div>

                <div class="card-title">CAR MODEL : </div>
                <div class="card-subtitle">{{$cars->usedcar->carmodel->car_model}}</div>
                <div class="card-title">PRICE : </div>
                <div class="card-subtitle">RM {{$cars->min_price}} to RM {{$cars->max_price}}</div>

                <div style="display:flex; justify-content: center; margin:5px;">
                    <div class="card-button" style="width: 12.5rem;">
                        <div class="card-button-content">ADD TO COLLECTION</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
