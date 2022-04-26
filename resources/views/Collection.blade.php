@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<main class="py-4">
    <div class="row" >
        <div class="col-1"></div>
        <div class="row col-10">
            <div class="col-lg-10 col-md-9 col-sm-12" style="padding-left: 0;">
                <h3 class="headline">Collection</h3>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-12" style="padding-left: 0;">
                <form id="my_form" action="/collection/comparison" method="POST">
                    @csrf
                    <input class="btn compare-selection-btn" id="CompareButton" type="submit" value="COMPARE SELECTION"><br>
                    {{-- <a class="btn btn-success compare-selection-btn" href="/collection/comparison">Temporary Button to comparison page</a> --}}
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </div>


    <div class="row" style="margin-left:0.7rem">
        <div class="col-1"></div>
        <div class="col-10 row cards-container">
            @foreach ($collections as $collection)

                <div class="col-lg-4 col-md-6 col-sm-12 mt-5" >
                    {{-- <input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}> --}}
                    <div id="card{{ $collection->id }}" class="card m-auto">
                        <div>
                            <div class="checkbox-container">
                                <span><input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name="checkedbox[]" value={{ $collection->id }}></span>
                                <span style="margin-left: 0.4rem;">Compare</span>
                            </div>
                            <a href='/catalogue/usedcardetails/{{$collection->used_car_id}}'>
                                @if (!empty($collection->usedCar->usedCarImages->get(0)->image))
                                    <img class="card-img" src="{{ $collection->usedCar->usedCarImages->get(0)->image }}" alt="Card image cap" style="width:100%;height:190px">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="black" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                    </svg>
                                @endif
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card-title-year-brand col-10">{{ $collection->usedCar->car->year}}  {{ $collection->usedCar->car->carVariant->carModel->model}} </div>
                                <div class="card-title-model-variant col-10">{{ $collection->usedCar->car->carVariant->carModel->carBrand->brand}}  {{ $collection->usedCar->car->carVariant->variant}}</div>
                                <div class="col-2"><button class="card-delete-button" data-toggle="modal" data-target="#exampleModal{{ $collection->id }}"><i class="fa fa-trash-o" style="font-size:20px;margin-left:0.2rem;"></i></button></div>
                            </div>

                            <div class="card-car-details">
                                <span>{{ $collection->usedCar->car->carGeneralSpec->fuel}} | {{ $collection->usedCar->car->carGeneralSpec->transmission}} | {{ $collection->usedCar->car->carBodyType->body_type}} </span>
                            </div>
                            <div class="card-car-price">
                                <span style="font-size: 12px">min:</span>
                                <strong>RM{{ $collection->usedCar->min_price}}</strong>
                                <span>       </span>
                                <span style="font-size: 12px">max:</span>
                                <strong>RM{{ $collection->usedCar->max_price}}</strong>
                            </div>
                            <div class="modal fade" id="exampleModal{{ $collection->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('collection.destroy', ['collection' => $collection->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove collection</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to remove this collection?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col-1"></div>


    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Compare Selection</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sorry, you can't select more than 2 cars.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>
</main>
@endsection

@section("footer-scripts")
        <script>

            $(document).ready(function () {

                document.getElementById('CompareButton').disabled = true;

                $('input[type=checkbox]').on('change', function (e)
                {
                    if ($('input[type=checkbox]:checked').length > 2) {

                        $(this).prop('checked', false);
                        $('#exampleModal').modal('show')
                    }

                    if ($('input[type=checkbox]:checked').length == 2) {
                        document.getElementById('CompareButton').disabled = false;

                        document.getElementById('CompareButton').style.backgroundColor = "#09c702";
                        document.getElementById('CompareButton').style.color = "white";

                        var menus = document.getElementsByClassName("check");
                        for (var i = menus.length - 1; i >= 0; i--)
                        {

                            if (menus[i].checked == true){
                                continue;
                            }else{
                                var value = menus[i].value;
                                document.getElementById('card'+value).style.opacity ="0.5";
                            }

                        }


                    }

                    if ($('input[type=checkbox]:checked').length < 2) {
                        document.getElementById('CompareButton').disabled = true;

                        document.getElementById('CompareButton').style.backgroundColor = "#838384";
                        document.getElementById('CompareButton').style.color = "#272424";


                        var menus = document.getElementsByClassName("check");
                        for (var i = menus.length - 1; i >= 0; i--)
                        {

                                console.log(menus[i].value);
                                var value = menus[i].value;
                                document.getElementById('card'+value).style.opacity ="1";

                        }
                    }

                    if($(this).is(":checked")){
                        $(this).parent().parent().parent().parent().addClass("card-checked");
                    }else{
                        $(this).parent().parent().parent().parent().removeClass("card-checked");
                    }



                });
            });

        </script>
@endsection
