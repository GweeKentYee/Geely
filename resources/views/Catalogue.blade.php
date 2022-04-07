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
        <div class="input-group rounded">
            <input type="search" name="query" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class="bi bi-search"></i>
            </span>
          </div>
    </form>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#advancedSearch">Primary</button>
      
      <!-- Modal -->
      <div class="modal fade" id="advancedSearch" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advanced Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/catalogue/advanced')}}">
                        <label>Model :</label>
                        <input type="text" name="model" class="form-control" placeholder="Model">
                        <label>Year :</label>
                        <select name="year" class ="form-select" placeholder="Year">
                            <option value="" disabled selected>Year</option>
                            @for ($year=1920; $year<= now()->year; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        <label>Minimum Price :</label>
                        <input type="text" name="minPrice" class="form-control" placeholder="Minimum Price">
                        <label>Maximum Price :</label>
                        <input type="text" name="maxPrice" class="form-control" placeholder="Maximum Price">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-outline-primary" value = "Search"></button>
                        </div>
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
            @foreach ( $usedcar as  $usedcars )
                {{-- Replace line with specific used car details --}}
                <a href='/catalogue/usedcardetails'> 
                <div class="cata-card" style="width: 15rem; display: inline-block;">
                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-image" style="width: 12.5rem;height: 12.5rem;justify-content:center;">   
                            <img src="{{$usedcars->usedCarImages->get(0)->image}}" alt="" width="200" height="200">
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