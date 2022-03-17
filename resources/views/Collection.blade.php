@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
@endsection

@section('content')
    
    <div class="row">
        <div class="col-9">
            <h3 class="headline">COLLECTION</h3>
        </div>
        <div class="col-3">
            <form id="my_form" action="{{ route('collection.compare') }}" method="POST">
                @csrf
                <input class="compare-selection-btn" type="submit" value="COMPARE SELECTION">
            </form>
        </div>
    </div>
    <div class="row title-bar">
        <div class="col-1">       
        </div>
        <div class="col-2 title-bar-column title-bar-image-column">IMAGE</div>
        <div class="col-2 title-bar-column">CAR MODEL</div>
        <div class="col-2 title-bar-column">YEAR</div>
        <div class="col-2 title-bar-column">PRICE</div>
        <div class="col-2 title-bar-column title-bar-rating-column">RATING</div>
        <div class="col-1">
        </div>
    </div>
    @foreach ($collections as $collection)
        <div class="row collection-container">
                <div class="col-1 m-auto">
                        <input class="check" type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}>
                </div>
                <div class="col-2 m-auto"><img class="car-image shadow-lg" src="https://source.unsplash.com/random/150×150" alt="" width="150" height="150"></div>
                <div class="col-2 m-auto">{{ $collection->model }}</div>
                <div class="col-2 m-auto">{{ $collection->year }}</div>
                <div class="col-2 m-auto">RM{{ $collection->min_price }}-RM{{ $collection->max_price }}</div>
                <div class="col-2 m-auto">{{ $collection->id }}</div>
                <div class="col-1 m-auto">
                    <button type="button" class="btn btn-danger shadow" data-toggle="modal" data-target="#exampleModal{{ $collection->id }}">
                        X
                    </button>
                    {{--  Pop up form when delete button is clicked  --}}
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
        <div class="row collection-container">
            <div class="col-1"></div>
            <div class="col-10"><hr></div>
            <div class="col-1"> </div>
        </div>
     
    @endforeach

@endsection

@section("footer-scripts")
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
        
            $(document).ready(function () {
                $('input[type=checkbox]').on('change', function (e) {
                    if ($('input[type=checkbox]:checked').length > 2) {
                        $(this).prop('checked', false);
                        alert("Can't compare more than 2 cars");
                    }
                });
            });

        </script>
@endsection

