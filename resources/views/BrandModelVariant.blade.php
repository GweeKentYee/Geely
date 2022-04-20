@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <h3><u>Brand/Model/Variant</u></h3>
        </div>
        <br>
        <br>
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#carbrand" class="nav-link active" data-bs-toggle="tab">Brand</a>
                </li>
                <li class="nav-item">
                    <a href="#carmodel" class="nav-link" data-bs-toggle="tab">Model</a>
                </li>
                <li class="nav-item">
                    <a href="#carvariant" class="nav-link" data-bs-toggle="tab">Variant</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="carbrand">
                    <p>test1</p>
                </div>
                <div class="tab-pane fade" id="carmodel">
                    <p>test2</p>
                </div>
                <div class="tab-pane fade" id="carvariant">
                    <p>test3</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection