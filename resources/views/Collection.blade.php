@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
  
    <div class="row" >
        <div class="col-1"></div>
        <div class="row col-10">
            <div class="col-lg-10 col-md-9 col-sm-12" style="padding-left: 0;">
                <h3 class="headline">COLLECTION</h3>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-12" style="padding-left: 0;">
                <form id="my_form" action="{{ route('collection.compare') }}" method="POST">
                    @csrf
                    <input class="btn compare-selection-btn" id="CompareButton" type="submit" value="COMPARE SELECTION"><br>
                    {{-- <a class="btn btn-success compare-selection-btn" href="/collection/comparison">Temporary Button to comparison page</a> --}}
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    

    <div class="row" style="margin-left:0.7rem ">
        <div class="col-1"></div>
        <div class="col-10 row cards-container">
            @foreach ($collections as $collection)

                <div class="col-lg-4 col-md-6 col-sm-12 mt-5" >
                    {{-- <input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}> --}}
                    <div id="card{{ $collection->id }}" class="card m-auto">
                        <div>   
                            <div class="checkbox-container">
                                <span><input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}></span>
                                <span style="margin-left: 0.4rem;">Compare</span>
                            </div>
                            <img class="card-img" src="https://prod-carsome-my.imgix.net/B2C/dd1b1fe1-0e98-4126-aeab-2777c8e82746.jpg?q=20&w=2400&auto=format" alt="Card image cap" width="200" height="200">
                        </div>
                        <div class="card-body">
                        
                            <div class="row">
                                <div class="card-title-year-brand col-10">{{ $collection->year }} {{ $collection->brand }}</div>
                                <div class="card-title-model-variant col-10">{{ $collection->model }} {{ $collection->variant }} </div>
                                <div class="col-2"><button class="card-delete-button" data-toggle="modal" data-target="#exampleModal{{ $collection->id }}"><i class="fa fa-trash-o" style="font-size:20px;margin-left:0.2rem;"></i></button></div>
                            </div> 
                            
                            <div class="card-car-details">
                                <span>{{ $collection->fuel }} | {{ $collection->transmission }} | {{ $collection->body_type }} </span>
                            </div>
                            <div class="card-car-price">
                                <span style="font-size: 12px">min:</span>
                                <strong>RM{{ $collection->min_price }}</strong>
                                <span>       </span>
                                <span style="font-size: 12px">max:</span>
                                <strong>RM{{ $collection->max_price }}</strong>
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

@endsection

@section("footer-scripts")
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
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
