@extends('layouts.app')

@section('css')
<link href="{{ asset('css/collection.css') }}" rel="stylesheet">
@endsection

@section('content')
{{--  <div class="container">  --}}
    <div class="row">
        <div class="col-10">
            <h3 class="headline">Collection</h3>
        </div>
        <div class="col-2">
            <form id="my_form" action="{{ route('collection.compare') }}" method="POST">
                @csrf
                <input type="submit" value="Compare Selection">
            </form>
        </div>
    </div>
    @foreach ($collections as $collection)
        <div class="row collection-container">
                <div class="col-1">
                        <input type="checkbox" form="my_form" id={{ $collection->id }} name={{ $collection->id }} value={{ $collection->id }}>
                </div>
                <div class="col-2">{{ $collection->id }}</div>
                <div class="col-2">{{ $collection->id }}</div>
                <div class="col-2">{{ $collection->id }}</div>
                <div class="col-2">{{ $collection->id }}</div>
                <div class="col-2">{{ $collection->id }}</div>
                <div class="col-1">
                    <form action="{{ route('collection.destroy', ['collection' => $collection->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="X">
                    </form>
                </div>
        </div>
    @endforeach

{{--  </div>  --}}
@endsection

@section("footer-scripts")

@endsection

