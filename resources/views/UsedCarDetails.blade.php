@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3><u></u></h3>
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <h2 style="font-family:GEELY; color:rgb(21, 136, 172)"><b>{{ __('CAR DETAILS') }}</b></h2></div>
                  <div class="row">
                    <div class="col">
                      <img src="" class="rounded mx-auto d-block" alt="...">
                    </div>
                    <div class="col">
                      <h3 style="font-family:Geely; color:black"><b>{{ __('MODEL:') }}</b></h3>
                      --Geely<br>
                      <h3 style="font-family:Geely; color:black"><b>{{ __('YEAR:') }}</b></h3>
                      --2021<br>
                    </div>
                    <div class="col">
                      <h3 style="font-family:Geely; color:black"><b>{{ __('PRICE:') }}</b></h3>
                      --12345 pricing<br>
                      <h3 style="font-family:Geely; color:black"><b>{{ __('RATING:') }}</b></h3>
                      --90%<br>
                      <br>
                    </div>
                  </div>
                    <div class="row">
                      <div class= "col">
                      </div>
                      <div class="col-8">
                         <button type="button" class="btn btn-primary float-left" style="width: 70%" >ADD TO COLLECTION </button>
                         <br><br>
                      </div>
                  </div>

                  <div class="row">
                    <h2 style="font-family:GEELY; color:rgb(21, 136, 172)"><b>{{ __('INSPECTION DETAILS') }}</b></h2></div>
                  
                  <div class="row">
                      <div class="col">
                        Image 1
                        <img src="" class="img-fluid" alt="Responsive image">
                        <br>
                        <div class="row"> {{-- row 1 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('CHASIS') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 2 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('WHEELS') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 3 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('BATTERY') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 4 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('AIR CONDITIONING SYSTEM') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                          </div>
                        </div> 
                        
                      </div>
                      <div class="col">
                        <img src="..." class="text-center" alt="..."> Image2
                        <br>
                        <div class="row"> {{-- row 1 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('PAINTS') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 2 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('DOOR') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 3 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('ETC') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                            </div>
                          </div>
                        </div> 
                        <div class="row"> {{-- row 4 --}}
                          {{-- create a inner column to print progress bar and header --}}
                          <div class="col"><h4 style="font-family:Geely; color:black"><b>{{ __('ETC') }}</b></h4>
                          </div>
                          <div class="col">
                            <div class="progress" style="height: 20px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                          </div>
                      </div>
                  </div>



              </div>
        </div>
    </div>
</div>
@endsection
