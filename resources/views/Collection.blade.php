@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
@endsection

@section('content')
{{--  <div class="container">  --}}
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
                <div class="col-2 m-auto">{{ $collection->car_model }}</div>
                <div class="col-2 m-auto">{{ $collection->year }}</div>
                <div class="col-2 m-auto">RM{{ $collection->min_price }}-RM{{ $collection->max_price }}</div>
                <div class="col-2 m-auto">{{ $collection->id }}</div>
                <div class="col-1 m-auto">
                    <form action="{{ route('collection.destroy', ['collection' => $collection->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="bg-danger text-light rounded shadow" type="submit" value="X">
                    </form>
                </div>
        </div>
    @endforeach

{{--  </div>  --}}
@endsection

@section("footer-scripts")
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

