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
    <form type="get"  action="{{url('/catalogue/search')}}" style="display: inline-block">
        <input type="query" name="query" placeholder="Search">
        <button type="submit">Search</button>
    </form>
    <button type ="popupbutton" id="popupbutton">FILTER</button>
    
    <!-- this is the popup, hidden by default -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>
    </div>

    <div>
        @if(count($car)<1)
            <div class="cata-card" style="width: 15rem; display: inline-block;">
                <div>NO MATCHES IN OUR DATABASE</div>
            </div>
        @else
            @foreach ( $car as  $cars )
                <div class="cata-card" style="width: 15rem; display: inline-block;">
                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-image" style="width: 12.5rem;justify-content:center;">   
                            <img src="{{$cars->usedCar->file}}">
                        </div>
                    </div>

                    <div class="cata-card-title">CAR MODEL : </div>
                    <div class="cata-card-subtitle">{{$cars->usedcar->carVariant->carModel->car_model}}</div>
                    <div class="cata-card-title">PRICE : </div>
                    <div class="cata-card-subtitle">RM {{$cars->min_price}} to RM {{$cars->max_price}}</div>

                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-button" style="width: 12.5rem;">
                            <div class="cata-card-button-content">ADD TO COLLECTION</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
