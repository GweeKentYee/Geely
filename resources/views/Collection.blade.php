@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <h3 class="headline">COLLECTION</h3>
        </div>
        <div class="col-12">
            <form id="my_form" action="{{ route('collection.compare') }}" method="POST">
                @csrf
                <input class="btn btn-success compare-selection-btn" id="CompareButton" type="submit" value="COMPARE SELECTION"><br>
                <a class="btn btn-success compare-selection-btn" href="/collection/comparison">Temporary Button to comparison page</a>
            </form>
        </div>
    </div>
    
    <div class="row">
        @foreach ($collections as $collection)
        
            <div class="col-lg-3 col-md-6 col-sm-12 mt-5" >
                <input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}>
                <div class="card m-auto" style="width: 18rem;">
                    <img class="card-img" src="https://source.unsplash.com/random/200×200" alt="Card image cap" width="200" height="200">
                    <div class="card-body">
                      <p class="card-title">Car Model:</p>
                      <h5 class="text-center card-subtitle ">{{ $collection->model }}</h5>
                      <p class="card-title">Year:</p>
                      <h5 class="text-center card-subtitle ">{{ $collection->year }}</h5>
                      <p class="card-title">Price (RM):</p>
                      <h5 class="text-center card-subtitle ">{{ $collection->min_price }} - {{ $collection->max_price }}</h5>
                      <p class="card-title">Rating:</p>
                      <h5 class="text-center card-subtitle ">{{ $collection->id }}%</h5>
                      <button class="btn-danger btn mt-2 card-button" data-toggle="modal" data-target="#exampleModal{{ $collection->id }}" style="width: 16rem;">REMOVE</button>
                      <div class="modal fade" id="exampleModal{{ $collection->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <form action="{{ route('collection.destroy', ['collection' => $collection->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Remove collection</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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

@endsection

@section("footer-scripts")
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
        
            $(document).ready(function () {
                document.getElementById('CompareButton').disabled = true;

                $('input[type=checkbox]').on('change', function (e) {
                    if ($('input[type=checkbox]:checked').length > 2) {
                        $(this).prop('checked', false);
                        alert("Can't compare more than 2 cars");
                    }

                    if ($('input[type=checkbox]:checked').length == 2) {
                        document.getElementById('CompareButton').disabled = false;
                    }

                    if ($('input[type=checkbox]:checked').length < 2) {
                        document.getElementById('CompareButton').disabled = true;
                    }
                    
                });
            });

        </script>
@endsection