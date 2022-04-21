@extends('layouts.app')

@section('css')
<link href="{{ asset('css/catalogue.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<main class="py-4">
    {{-- display the headline of the page --}}
    <div class="row">
        <div class="col-1"></div>
        <div class="row col-10">
            <div class="col-lg-10 col-md-9 col-sm-12" style="padding-left: 0;">
                <h3 class="headline">CATALOGUE</h3>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

    {{-- content of the page --}}
    <div Class = "container">
        {{-- search bar --}}
        <div class="container">
            <div class="d-flex justify-content-center">
                <form type="get"  action="{{url('/catalogue/search')}}" class="col-lg-6">
                    <div class="input-group rounded">
                        <input type="search" id="search" name="query" class="typeahead form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" autocomplete="off" />
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
                <div class="col-md-2 mx-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#advancedSearch" style="white-space: nowrap; overflow: hidden;">Advanced Search</button>
                </div>
            </div>
        </div>


        <!-- Modal for advanced search -->
        <div class="modal fade" id="advancedSearch" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advanced Search</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/catalogue/advanced')}}">
                            <label>Brand :</label>
                            <select id="brand" name="brand" class ="form-select" placeholder="Brand">
                                <option value="" disabled selected hidden>Brand</option>
                                <option value="" >ALL</option>
                                @foreach($carbrand as $carbrands)
                                    <option value="{{ $carbrands->id }}">{{ $carbrands->brand }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>Model :</label>
                            <select id = "model"  name = "model" class = "form-select" placeholder="Model">
                                <option value="" disabled selected hidden>Model</option>
                                @foreach($carmodel as $carmodels)
                                    <option value="{{ $carmodels->id }}">{{ $carmodels->model }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>Variant :</label>
                            <select id = "variant" name = "variant" class = "form-select" placeholder="Variant" disabled>
                                <option value="" disabled selected hidden>Variant</option>
                            </select>
                            <br>
                            <label>Body Type :</label>
                            <select id = "bodyType" name = "bodyType" class = "form-select" placeholder="Body Type">
                                <option value="" disabled selected hidden>Body Type</option>
                                @foreach($carbodytype as $carbodytypes)
                                    <option value="{{ $carbodytypes->id }}">{{ $carbodytypes->body_type }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>Fuel - Transmission :</label>
                            <select id = "generalSpec" name = "generalSpec" class = "form-select" placeholder="Fuel - Transmission">
                                <option value="" disabled selected hidden>Fuel - Transmission</option>
                                @foreach($generalspec as $generalspecs)
                                    <option value="{{ $generalspecs->id }}">{{ $generalspecs->fuel}} {{$generalspecs->transmission}}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>Year :</label>
                            <select name="year" class ="form-select" placeholder="Year">
                                <option value="" hidden disabled selected>Year</option>
                                @for ($year=1920; $year<= now()->year; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            <br>
                            <label>Minimum Price :</label>
                            <input type="number" name="minPrice" class="form-control" placeholder="Minimum Price" autocomplete="off" min="0"  step="10000">
                            <br>
                            <label>Maximum Price :</label>
                            <input type="number" name="maxPrice" class="form-control" placeholder="Maximum Price" autocomplete="off" step="10000">
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div>
        {{-- displays a "NO MATCHES IN OUR DATABASE" if there are no cars to display --}}
        @if(count($usedcar)<1)
            <br>
            <br>
            <div class="d-flex justify-content-center my-10">
                <h4>NO MATCHES IN OUR DATABASE</h4>
            </div>
        @else

            <div class="row" style="margin-left:0.7rem ">
                <div class="col-1"></div>
                    <div class="col-10 row cards-container">
                        @foreach ( $usedcar as  $usedcars )
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-5" >
                                <div class="card cat-card m-auto">
                                    <div>
                                        <a href='/catalogue/usedcardetails/{{$usedcars->id}}'>
                                            <img class="card-img" src="{{$usedcars->usedCarImages->get(0)->image}}" alt="Card image cap" width="100%" height="170px">
                                        </a>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="card-title-year-brand col-10">{{$usedcars->year}} {{$usedcars->brand}}</div>
                                            <div class="card-title-model-variant col-10">{{$usedcars->model}} {{$usedcars->variant}} </div>
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
                                            <span>{{$usedcars->fuel}} | {{$usedcars->transmission}} | {{$usedcars->body_type}} </span>
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
</main>
@endsection


@section('footer-scripts')

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#brand').on('change', function(e) {
            var CarBrand_id = e.target.value;
            const variantdropbox = document.getElementById('variant');
            variantdropbox.disabled =true;
            variantdropbox.value="";

            $.ajax({
                url: "{{ route('modelOption') }}",
                type: "POST",
                data: {
                    CarBrand_id: CarBrand_id
                },
                success: function(data) {
                    $('#model').empty();
                    $('#model').append('<option value="" disabled selected hidden>Model</option>');
                    if(data.CarModels.length==0){
                        $('#model').append('<option value="" disabled>No Models Available</option>');
                    }
                    $.each(data.CarModels, function(index, CarModels) {
                        $('#model').append('<option value="'+CarModels.id+'">'+CarModels.model+'</option>');
                    })
                }
            })
        });

        $('#model').on('change', function(e) {
            var CarModel_id = e.target.value;
            const variantdropbox = document.getElementById('variant');

            if(CarModel_id!=""){
                variantdropbox.disabled =false;
                $.ajax({
                    url: "{{ route('variantOption') }}",
                    type: "POST",
                    data: {
                        CarModel_id: CarModel_id
                    },
                    success: function(data) {
                        $('#variant').empty();
                        $('#variant').append('<option value="" disabled selected hidden>Variant</option>');

                        if(data.CarVariants.length==0){
                            $('#variant').append('<option value="" disabled>No Variants Available</option>');
                        }
                        $.each(data.CarVariants, function(index, CarVariants) {
                            $('#variant').append('<option value="'+CarVariants.id+'">'+CarVariants.variant+'</option>');
                        })
                    }
                })
            }
        });

        var route = "{{ url('autocompleteSearch') }}";
        $('#search').typeahead(
        {
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    console.log(data);
                    return process(data);
                });
            }
        }
        );
    });
</script>

@endsection
