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
            <button>Compare Selection</button>
        </div>
    </div>
    @foreach ($collections as $collection)
        <div class="row collection-container">
                <div class="col-1">
                    <form action="/action_page.php">
                        <input type="checkbox" id="temp" name="temp" value="temp">
                    </form>
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
    {{-- <div>
        @foreach ($collections as $collection)
            <div>{{ $collection->catalogue_id }}</div>
        @endforeach
    </div> --}}


{{--  </div>  --}}
@endsection

