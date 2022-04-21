@extends('layouts.app')

@section('css')
<link href="{{ asset('css/comparison.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h2 class="headline">Car Details</h2>
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
              {{-- {{$usedcar1->usedCarImages->get(0)->image}} --}}
              <img class="card-img" src="https://prod-carsome-my.imgix.net/B2C/dd1b1fe1-0e98-4126-aeab-2777c8e82746.jpg?q=20&w=2400&auto=format" alt="Card image cap" width="200" height="200"><br>
              
              <div class="details-title">
                <div class="card-header">
                  Model: {{$usedcar1->car->carModel->model}}
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Year: {{$usedcar1->car->year}}</li>
                  <li class="list-group-item">Price: RM {{$usedcar1->min_price}} to RM {{$usedcar1->max_price}}</li>
                  <li class="list-group-item">{{$Data1[0][19]}}: {{$Data1[1][19]}}</li>
                </ul>
              </div>
              </th>
            <th></th>
            <th scope="col">
              {{-- https://prod-carsome-my.imgix.net/B2C/dd1b1fe1-0e98-4126-aeab-2777c8e82746.jpg?q=20&w=2400&auto=format --}}
              {{-- {{$usedcar2->usedCarImages->get(0)->image} --}}
              <img class="card-img" src=" https://prod-carsome-my.imgix.net/B2C/dd1b1fe1-0e98-4126-aeab-2777c8e82746.jpg?q=20&w=2400&auto=format " alt="Card image cap" width="200" height="200"><br>
               
                <div class="details-title">
                    <div class="card-header">
                      Model: {{$usedcar1->car->carModel->model}}
                    </div>
                    <ul class="list-group list-group-flush">
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