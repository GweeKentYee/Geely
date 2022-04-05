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
            <col span="1" style="width: 40%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 40%;">
         </colgroup>
        <thead>
          <tr>
            <th scope="col">
              <div class="centerBlock">
                <img src="https://source.unsplash.com/random/200×200" alt="Responsive image" width="200" height="200">
                </div>
              <div class="details-title">CarA</div>
              </th>
            <th></th>
            <th scope="col">
              <div class="centerBlock">
                <img src="https://source.unsplash.com/random/200×200" alt="Responsive image" width="200" height="200">
                </div>
                <div class="details-title">CarB</div>
              </th>
          </tr>

        </thead>
        <tbody>
          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="content-title">Body</td>
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
            <td class="content-title">Wheels</td>
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
            <td class="content-title">Tire</td>
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
            <td class="content-title">Paint</td>
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
            <td class="content-title">Engine & Transmission</td>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
          </tr>

          <tr>
            <td>
                <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td class="content-title">Battery</td>
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