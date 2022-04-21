@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <h3><a href = "/admin/inspection">Inspection</a> / {{$inspection->usedCar->registration}}</h3>
        </div>
    </div>
</main>
@endsection

@section('footer-scripts')


@endsection
