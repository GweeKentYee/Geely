@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit & Update Used Car
                        <a href="/admin/usedcar" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                            <form action="{{ url('/usedcar/update/'.$UsedCar->id) }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')
                              
                            <div class="form-group mb-3">
                              <label for="message-text" class="col-form-label">Minimum Price:</label>
                              <input type="integer" placeholder="{{$UsedCar->min_price}}" class="form-control" id="minimum_price" name="minimum_price">
                              @error('minimum_price')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
        
                          <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Maximum Price:</label>
                            <input type="integer" placeholder="{{$UsedCar->max_price}}" class="form-control" id="maximum_price" name="maximum_price">
                            @error('maximum_price')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
        
                          <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Registration:</label>
                            <input type="varchar" placeholder="{{$UsedCar->registration}}" class="form-control" id="registration" name="registration">
                            @error('registration')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
        
                          <div class="form-group mb-3">
                            <label for="" class="col-form-label">Data File:</label>
                            <input type="file" placeholder="{{$UsedCar->data_file}}" class="form-control" id="data_file" name="data_file">
                            @error('data_file')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
        
                          <div class="form-group mb-3">
                            <label for="" class="col-form-label">Ownership File:</label>
                            <input type="file" class="form-control" id="ownership_file" name="ownership_file">
                            @error('ownership_file')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
        
                          <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Status:</label>
                            <select type="integer" placeholder="{{$UsedCar->status}}" class="form-control" id="status" name="status">
                                <option value="">Select a Status</option>
                                <option value="1">Hidden</option>
                                <option value="2">Catalogue</option>
                                <option value="3">Whole Sale</option>
                            </select>
                                @error('status')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
        
                          <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Car ID:</label>
                            <select type= "bigint" class="form-control" name="car_id" id="car_id">
                                <option value="">Select a Car Id</option>
                                @foreach($car_id as $car_id) 
                                  <option id="add-car_id" value="{{ $car_id->id }}">{{ $car_id->id }}  </option>
                                @endforeach
                            </select>
                            @error('car_id')
                                  <div class="alert-danger">{{ $message }}</div>
                              @enderror  
                          </div>
                            <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Used Car Image</button>
                            </div>
                    
                      

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection 