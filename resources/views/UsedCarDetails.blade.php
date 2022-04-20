@extends('layouts.app')

@section('css')
<link href="{{ asset('css/usedcardetails.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="py-4">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h3><u></u></h3>
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                    <h2 class="headline"><u>Car Details</u></h2>
                    <div class="row">
                      <div class="col">
                        <div class="centerBlock">
                        <img src="https://source.unsplash.com/random/200×200" alt="Responsive image" width="200" height="200">
                        </div>
                      </div>
                      <div class="col">
                        <div class="details-title">Model:</div>
                        <div class="details-content">--Geely</div><br>
                        <div class="details-title">Year:</div>
                        <div class="details-content">--2021</div><br>
                      </div>
                      <div class="col">
                        <div class="details-title">Price:</div>
                        <div class="details-content">--12345 pricing</div><br>
                        <div class="details-title">Rating:</div>
                        <div class="details-content">--90%</div><br>
                      </div>
                    </div>
                      <div class="row">
                        <div class= "col">
                        </div>
                        <div class="col-8">
                      
                          {{-- <button class="cata-card-button cata-card-button-content" >ADD TO COLLECTION </button> --}}
                          <button class="cata-card-button cata-card-button-content" type="submit">Add To Collection</button> 
                          <br><br>
                        </div>
                    </div>

                    <div class="row">
                      <h2 class="headline"><u>Inspection Details</u></h2></div>
                    
                    <div class="row">
                        <div class="col">
                          <div class="centerBlock">
                          <img src="https://source.unsplash.com/random/200×200"  alt="Responsive image" width="200" height="200">
                          </div>
                          <br><br>
                          <div class="row details-title"> {{-- row 1 --}}
                            {{-- create a inner column to print progress bar and header --}}
                            <div class="col">
                              Chasis
                            </div>
                            <div class="col">
                              <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                              </div>
                            </div>
                          </div> 

                          <div class="row details-title"> {{-- row 2 --}}
                            <div class="col">
                              Wheels
                            </div>
                            <div class="col">
                              <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5%</div>
                              </div>
                            </div>
                          </div> 

                          <div class="row details-title"> {{-- row 3 --}}
                            <div class="col">Battery
                            </div>
                            <div class="col">
                              <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                              </div>
                            </div>
                          </div> 

                          <div class="row details-title"> {{-- row 4 --}}
                            <div class="col">Air Conditioning System
                            </div>
                            <div class="col">
                              <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                              </div>
                            </div>
                          </div> 
                          
                        </div>
                        <div class="col">
                          <div class="centerBlock">
                            <img src="https://source.unsplash.com/random/200×200"  alt="Responsive image" width="200" height="200">
                            </div>
                            <br><br>

                            <div class="row details-title"> {{-- row 1 --}}
                              {{-- create a inner column to print progress bar and header --}}
                              <div class="col">
                                Paints
                              </div>
                              <div class="col">
                                <div class="progress" style="height: 20px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                              </div>
                            </div> 
    
                            <div class="row details-title"> {{-- row 2 --}}
                              <div class="col">
                                Door
                              </div>
                              <div class="col">
                                <div class="progress" style="height: 20px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5%</div>
                                </div>
                              </div>
                            </div> 
    
                            <div class="row details-title"> {{-- row 3 --}}
                              <div class="col">
                                etc
                              </div>
                              <div class="col">
                                <div class="progress" style="height: 20px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                </div>
                              </div>
                            </div> 
    
                            <div class="row details-title"> {{-- row 4 --}}
                              <div class="col">
                                etc
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
  </div>
</main>
@endsection
