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
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="First slide">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="Second slide">
                                    </div>
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
    </div>
</div>
@endsection


