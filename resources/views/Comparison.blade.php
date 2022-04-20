@extends('layouts.app')

@section('css')
<link href="{{ asset('css/comparison.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h2 class="headline"><u>Car Details</u></h2>
        </div>
    </div>
    <table class="table table-borderless" style="width: 100%">
        <colgroup>
            <col span="1" style="width: 35%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 35%;">
         </colgroup>
        <thead>
          <tr>
            <th scope="col">
              <div class="centerBlock">
                <img src="https://source.unsplash.com/random/200×200" alt="Responsive image" width="200" height="200"><br>
                </div>
              <div class="details-title">
                <div class="card-header">
                  {{$usedcar1->car->carModel->model}}
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">{{$usedcar1->car->year}}</li>
                  <li class="list-group-item">RM {{$usedcar1->min_price}} to RM {{$usedcar1->max_price}}</li>
                  <li class="list-group-item">{{$Data1[0][19]}}: {{$Data1[1][19]}}</li>
                </ul>
              </div>
              </th>
            <th></th>
            <th scope="col">
              <div class="centerBlock">
                <img src="https://source.unsplash.com/random/200×200" alt="Responsive image" width="200" height="200"><br>
                </div>
                <div class="details-title">
                    <div class="card-header">
                      {{$usedcar1->car->carModel->model}}
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">{{$usedcar2->car->year}}</li>
                      <li class="list-group-item">RM {{$usedcar2->min_price}} to RM {{$usedcar2->max_price}}</li>
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
                      <div class="progress-bar bg-success" role="progressbar" style="width: {{$Data1[1][$j]}}" aria-valuenow="{{$Data1[1][$j]}}" aria-valuemin="0" aria-valuemax="100">{{$Data1[1][$j]}}</div>
                      </div>
                  </td>
                  <td class="content-title">{{$Data1[0][$j]}}</td>
                  <td>
                      <div class="progress" style="height:20px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$Data2[1][$j]}}" aria-valuenow="{{$Data2[1][$j]}}" aria-valuemin="0" aria-valuemax="100">{{$Data2[1][$j]}}</div>
                      </div>
                  </td>
                </tr>
              @endif
            @endfor
        </tbody>
      </table>

    
</div>
@endsection