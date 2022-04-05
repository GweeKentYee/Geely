@extends('layouts.app')

@section('css')
<link href="{{ asset('css/catalogue.css') }}" rel="stylesheet">
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

    
    <div>
        @if(count($usedcar)<1)
            <div class="cata-card" style="width: 15rem; display: inline-block;">
                <div>NO MATCHES IN OUR DATABASE</div>
            </div>
        @else
            @foreach ( $usedcar as  $usedcars )
                {{-- Replace line with specific used car details --}}
                <a href='/catalogue/usedcardetails'> 
                <div class="cata-card" style="width: 15rem; display: inline-block;">
                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-image" style="width: 12.5rem;height: 12.5rem;justify-content:center;">   
                            {{-- <img src="{{$usedcars->usedCarImages->get(0)->image}}"> --}}
                            <img src="https://source.unsplash.com/random/200×200" alt="" width="200" height="200" >
                        </div>
                    </div>
                    <div class="cata-card-title">CAR MODEL : </div>
                    <div class="cata-card-subtitle">{{$usedcars->car->carModel->model}}</div>
                    <div class="cata-card-title">PRICE : </div>
                    <div class="cata-card-subtitle">RM {{$usedcars->min_price}} to RM {{$usedcars->max_price}}</div>

                    <div style="display:flex; justify-content: center; margin:5px;">
                        {{-- <div class="cata-card-button" style="width: 12.5rem;">
                            <div class="cata-card-button-content">ADD TO COLLECTION</div>
                        </div> --}}
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
                            <button class="btn-success cata-card-button-content" type="button" disabled>Added To Collection</button>         
                                
                        @else
                            <form action="{{ route('collection.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="usedcar_id" value={{ $usedcars->id }} />
                                <button class="cata-card-button cata-card-button-content" type="submit">Add To Collection</button>  
                            </form>                     
                        @endif
                            
                            
                    </div>
                </div>
            @endforeach
        @endif
        {{$usedcar->links()}}
    </div>
    
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