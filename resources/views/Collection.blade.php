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
    <div class="row column-bar">
        <div class="col-1">
            <form action="/action_page.php">
                <input type="checkbox" id="temp" name="temp" value="temp">
            </form>
        </div>
        <div class="col-2">Hello</div>
        <div class="col-2">Hello</div>
        <div class="col-2">Hello</div>
        <div class="col-2">Hello</div>
        <div class="col-2">Hello</div>
        <div class="col-1">
            <button>delete</button>
        </div>
    </div>


{{--  </div>  --}}
@endsection

