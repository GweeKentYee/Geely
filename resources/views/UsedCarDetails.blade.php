@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3><u>Used Car Details</u></h3>
            <div class="col-md-9">
                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            <div style = "text-align:left" class = "register-btn">
            <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newusedcar">New UsedCar Image</button>
            <a class = "btn btn-danger float-end" href="/admin/usedcar">Back</a>
            </div>
            @foreach ( $usedcarCombined as  $usedcarCombineds )
                <div class="cata-card" style="width: 15rem;height:15rem; display: inline-block;">
                    <div style="display:inline-grid; justify-content: center; margin:20px;">
                        <div class="cata-card-image" style="width: 12.5rem;height: 12.5rem;justify-content:center;">  
                            <img src="{{asset('uploads/usedcarImage/'.$usedcarCombineds->image)}}" height="200cm" width="200cm" alt="image" />
                        </div>
                    </div>
                    <div class="cata-card-title">ID : </div>
                    <div class="cata-card-subtitle">{{$usedcarCombineds->id}}</div>
                    <div class="cata-card-title">Registration : </div>
                    <div class="cata-card-subtitle">{{$usedcarCombineds->registration}}</div>
                    <div class="cata-card-title">Price : </div>
                    <div class="cata-card-subtitle">RM {{$usedcarCombineds->min_price}} to RM {{$usedcarCombineds->max_price}}</div>
                    <div class="cata-card-title">Data File : </div>
                    <div class="cata-card-subtitle">{{$usedcarCombineds->data_file}}</div>
                    <div class="cata-card-title">Ownership File : </div>
                    <div class="cata-card-subtitle">{{$usedcarCombineds->ownership_file}}</div>


                    <div style="display:flex; justify-content: left; margin:5px;">
                        <div class = "btn btn-success btn-sm edit" style="width: 12.5rem;">
                            <a href = "/usedcarImage/edit/{{$usedcarCombineds->id}}" class = "btn btn-success btn-sm edit">Edit</a>
                        </div>
                        <div method = 'get'class= "btn btn-danger btn-sm delete" style="width: 12.5rem;">
                            <a href = "/usedcarImage/delete/{{$usedcarCombineds->id}}" class= "btn btn-danger btn-sm delete">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach

    </div>
    
</div>
        </div>
        <div class="modal fade" id="newusedcar" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">
    
                <div class="modal-content">
    
                    <div class="modal-header">
    
                        <h5 class="modal-title">New Used Car Image</h5>
    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
                    </div>
    
                    <form action="/admin/usedcarImage/store" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        
                        <div class="form-group mb-3">
                            <label for="message-text" class="col-form-label">Used Car ID:</label>
                            <input type= "bigint" class="form-control" value="{{$usedcarCombineds->used_car_id}}" name="add-usedcarid" id="add-usedcarid" readonly>
                          </div>
                          <div class="form-group mb-3">
                            <label for="" class="col-form-label">Used Car Image:</label>
                            <input type="file" class="form-control" id="Used_Car_Image" name="Used_Car_Image">
                            @error('Used_Car_Image')
                             <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                      </div>
                      <div class="modal-footer">
    
                        <button type="submit" id="submit" class="btn btn-primary submit">Submit</button>
    
                      </div>
                    </form >
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
@if($errors->count() > 0)
<script>
$(function() {
    $('#newusedcar').modal('show');
});
</script>
@endif
@endsection
