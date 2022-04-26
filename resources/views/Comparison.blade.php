@extends('layouts.app')

@section('css')
<link href="{{ asset('css/comparison.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h3 class="headline">Comparison</h3>
        </div>
    </div>
    <div class="card">
      <div class="card-body">
    <table class="table table-borderless" style="width: 100%">
        <colgroup>
            <col span="1" style="width: 35%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 35%;">
         </colgroup>
        <thead>
          <tr>
            <th scope="col">

              @if (!empty($usedcar1->usedCarImages->get(0)->image))
                <img class="card-img" src="/{{$usedcar1->usedCarImages->get(0)->image}}" alt="Card image cap" width="100%" height="170px">
              @else
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="black" class="bi bi-images" viewBox="0 0 16 16">
                  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                </svg>
              @endif

              <div class="details-title">
                <div class="card-header">
                  Brand: {{$usedcar1->car->carVariant->carModel->carBrand->brand}}
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Model: {{$usedcar1->car->carVariant->carModel->model}}</li>
                  <li class="list-group-item">Year: {{$usedcar1->car->year}}</li>
                  <li class="list-group-item">Price: RM {{$usedcar1->min_price}} to RM {{$usedcar1->max_price}}</li>
                  <li class="list-group-item">{{$Data1[0][19]}}: {{$Data1[1][19]}}</li>
                </ul>
              </div>
              </th>
            <th></th>
            <th scope="col">

              @if (!empty($usedcar2->usedCarImages->get(0)->image))
                <img class="card-img" src="/{{$usedcar2->usedCarImages->get(0)->image}}" alt="Card image cap" width="100%" height="170px">
              @else
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="black" class="bi bi-images" viewBox="0 0 16 16">
                  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                </svg>
              @endif

                <div class="details-title">
                    <div class="card-header">
                      Brand: {{$usedcar2->car->carVariant->carModel->carBrand->brand}}
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Model: {{$usedcar2->car->carVariant->carModel->model}}</li>
                      <li class="list-group-item">Year: {{$usedcar2->car->year}}</li>
                      <li class="list-group-item">Price: RM {{$usedcar2->min_price}} to RM {{$usedcar2->max_price}}</li>
                      <li class="list-group-item">{{$Data2[0][19]}}: {{$Data2[1][19]}}</li>
                    </ul>
                  </div>
                  <br>
                </div>
              </th>
          </tr>
        </thead>

        <tbody>
          @for($j = 0; $j <=18 ;$j++)
              @if($Data1[0][$j] == $Data2[0][$j])
                <tr>
                  <td>
                      <div class="progress" style="height:20px">
                      <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$Data1[1][$j]}}; font-size: large" aria-valuenow="{{$Data1[1][$j]}}" aria-valuemin="0" aria-valuemax="100">{{$Data1[1][$j]}}</div>
                      </div>
                  </td>
                  <td class="content-title">
                    <span class="badge bg-primary rounded-pill" style="margin-left:10px">{{$j+1}}</span>
                    {{$Data1[0][$j]}}</td>
                  <td>
                      <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$Data2[1][$j]}}; font-size: large" aria-valuenow="{{$Data2[1][$j]}}" aria-valuemin="0" aria-valuemax="100">{{$Data2[1][$j]}}</div>
                      </div>
                  </td>
                </tr>
              @endif
            @endfor
        </tbody>
      </table>

    </div>
  </div>


</div>
@endsection
