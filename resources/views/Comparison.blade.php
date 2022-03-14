@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 style="font-family:GEELY; color:rgb(21, 136, 172)"><b>{{ __('CAR DETAILS') }}</b></h2>
        </div>
    </div>
    <table class="table table-borderless" style="width: 100%">
        <colgroup>
            <col span="1" style="width: 40%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 40%;">
         </colgroup>
        <thead>
          <tr>
            <th scope="col"><img src="" class="rounded mx-auto d-block" alt="carA"></th>
            <th></th>
            <th scope="col"><img src="" class="rounded mx-auto d-block" alt="carB"></th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="text-center" ><h4 style="font-family:Times New Roman; color:black; "><b>{{ __('Body') }}</b></h4></td>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            
          </tr>
          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="text-center"><h4 style="font-family:Times New Roman; color:black"><b>{{ __('Wheels') }}</b></h4></td>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
          </tr>
          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="text-center"><h4 style="font-family:Times New Roman; color:black"><b>{{ __('Tire') }}</b></h4></td>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
          </tr>
          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="text-center"><h4 style="font-family:Times New Roman; color:black"><b>{{ __('Paints') }}</b></h4></td>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
          </tr>
        </tbody>
      </table>
    
</div>
@endsection