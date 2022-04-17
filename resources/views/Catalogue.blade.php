@extends('layouts.app')

@section('css')
<link href="{{ asset('css/catalogue.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="headline"><u>Catalogue</u></h3>
        </div>
    </div>
</div>
<div Class = "container">
    <form type="get"  action="{{url('/catalogue/search')}}" style="display: inline-block">
        <input type="query" name="query" placeholder="SEARCH">
        <button type="submit">Search</button>
    </form>
    <button type ="popupbutton" id="popupbutton">ADVANCED SEARCH</button>
    
    <!-- this is the popup, hidden by default -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <div>
                <form type="get"  action="{{url('/catalogue/advanced')}}" style="display: inline-block">
                    <input type="query" name="model" placeholder="Model">
                    <input type="query" name="year" placeholder="Year">
                    <input type="query" name="minPrice" placeholder="Minimum Price">
                    <input type="query" name="maxPrice" placeholder="Maximum Price">
                    <button type="submit">SEARCH</button>
                </form>
            </div>
        </div>
    </div>
</div>

    
    <div>
        @if(count($usedcar)<1)
            <div class="cata-card" style="width: 15rem; display: inline-block;">
                <div>NO MATCHES IN OUR DATABASE</div>
            </div>
        @else
            
            <div class="row" style="margin-left:0.7rem ">
                <div class="col-1"></div>
                <div class="col-10 row cards-container">

                    @foreach ( $usedcar as  $usedcars )               
                        <div class="col-lg-4 col-md-6 col-sm-12 mt-5" >
                            
                            <div class="card cat-card m-auto">
                                <div>   
                                    <img class="card-img" src="https://prod-carsome-my.imgix.net/B2C/dd1b1fe1-0e98-4126-aeab-2777c8e82746.jpg?q=20&w=2400&auto=format" alt="Card image cap" width="200" height="200">
                                </div>
                                <div class="card-body">
                                
                                    <div class="row">
                                        <div class="card-title-year-brand col-10">{{$usedcars->car->year}} {{$usedcars->car->carModel->carBrand->brand}}</div>
                                        <div class="card-title-model-variant col-10">{{$usedcars->car->carModel->model}} {{$usedcars->car->carVariant->variant}} </div>
                                        <div class="col-2">
                                            @php    
                                                $exist_in_collection = false;
                                                $used_car_id =  $usedcars->id ;
                                                $collection_id_remove = 0;

                                                foreach($collections as $collection){
                                                    if( $collection->used_car_id == $used_car_id){
                                                        $exist_in_collection = true;
                                                        $collection_id_remove = $collection->id;
                                                    }
                                                }
                                            @endphp

                                            @if ($exist_in_collection)
                                             <button disabled class="card-add-collection-btn"><i class="bi bi-star-fill" style="font-size:20px;margin-left:0.2rem;"></i></button>    
                                                
                                            @else
                                                <form action="{{ route('collection.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="usedcar_id" value={{ $usedcars->id }} />
                                                    <button type="submit" class="card-add-collection-btn"><i class="bi bi-star" style="font-size:20px;margin-left:0.2rem;"></i></button>  
                                                </form>                     
                                            @endif

                                        </div>
                                    </div> 
                                    
                                    <div class="card-car-details">
                                        <span>{{$usedcars->car->carGeneralSpec->fuel}} | {{$usedcars->car->carGeneralSpec->transmission}} | {{$usedcars->car->carBodyType->body_type}} </span>
                                    </div>
                                    <div class="card-car-price">
                                        <span style="font-size: 12px">min:</span>
                                        <strong>RM{{ $usedcars->min_price }}</strong>
                                        <span>       </span>
                                        <span style="font-size: 12px">max:</span>
                                        <strong>RM{{ $usedcars->max_price }}</strong>
                                    </div>
                                   
                                </div>
                              </div>
                        </div>

                    @endforeach

                </div>
                <div class="col-1"></div>
            </div>

        @endif
        {{$usedcar->links()}}
    </div>
    

@endsection


@section('footer-scripts')
<script>
    window.onload = function(){ 
        var popup = document.getElementById("popup");
        var btn = document.getElementById("popupbutton");
        var close = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            popup.style.display = "block";
        }

        close.onclick = function() {
            popup.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == popup) {
            popup.style.display = "none";
            }
        }
    };
</script>