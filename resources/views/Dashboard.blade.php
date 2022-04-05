@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                @if($Dash->count()>0)
                    <div class="carousel-inner">
                        @for ($i=0;$i<$Dash->count();$i++)
                            @if ($i==0)
                                    <a class="carousel-item active" href="{{$Dash->get($i)->title}}" target="_blank">
                                        <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="First slide">
                                    </a>
                                @else
                                    <a class="carousel-item" href="{{$Dash->get($i)->title}}" target="_blank">
                                        <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="Second slide">
                                    </a>
                            @endif
                        @endfor
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <h1>
                Cars of the day
            </h1>
        </div>

        <div class="col-md-8" style="display:flex; justify-content: center;">
            @php($i=0)
            @foreach ($usedcar as  $usedcars)
                @php($i++)
                <a href="/catalogue" class="cata-card" style="width: 15rem; display: inline-block;">
                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-image" style="width: 12.5rem;height: 12.5rem;justify-content:center;">
                            <img src="{{$usedcars->usedCarImages}}">
                        </div>
                    </div>
                    <div class="cata-card-title">CAR MODEL : </div>
                    <div class="cata-card-subtitle">{{$usedcars->car->carModel->model}}</div>
                    <div class="cata-card-title">PRICE : </div>
                    <div class="cata-card-subtitle">RM {{$usedcars->min_price}} to RM {{$usedcars->max_price}}</div>
                </a>
                @if ($i ==3)
                    @break
                @endif

            @endforeach
        </div>

        <div class="col-md-8">
            <h1>
                About our system
            </h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla commodo, massa laoreet dictum lacinia, enim nunc imperdiet diam, id cursus dolor metus et tortor. Maecenas varius augue in enim sodales, eu rhoncus orci pretium. Praesent eros ex, faucibus ullamcorper tincidunt a, varius vitae lorem. Nam et velit eget augue faucibus pharetra ac sit amet sem. Praesent lectus urna, varius a erat ac, semper finibus dolor. Nullam rhoncus orci a porta interdum. Etiam pretium non urna ut ultricies. Vestibulum volutpat arcu et arcu auctor, non dapibus ipsum hendrerit. Vivamus placerat tincidunt turpis, sed semper massa hendrerit at. Phasellus pretium est vitae enim volutpat, vitae finibus tellus laoreet. Morbi nisl enim, pellentesque quis luctus eu, tempus vitae velit. Vestibulum non augue at tellus iaculis vehicula sit amet vitae ipsum. Duis sit amet rhoncus dui. Suspendisse eu eros eget nunc hendrerit aliquam a vel ante.
            </p>
        </div>
    </div>
</div>
@endsection


