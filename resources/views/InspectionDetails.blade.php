@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><a href = "/admin/inspection">Inspection</a> / {{$inspection->usedCar->registration}}</h3>
    </div>
</div>
@endsection

@section('footer-scripts')


@endsection
