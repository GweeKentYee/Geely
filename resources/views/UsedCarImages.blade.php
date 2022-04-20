@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3> <a  href="/admin/usedcar">UsedCar/</a>
                <u>UsedCarImages</u></h3>
            <div class="col-md-offset-3">
                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif
            <div style = "text-align:left" class = "register-btn">
            <button class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#newusedcar">New UsedCar Image</button>
            </div>
            <form action="{{url('/usedCarImage/delete/selected')}}" method="get">
            <div style = "text-align:right" class = "register-btn">
            <button type ="submit" class ="btn btn-danger">Delete Selected</button>
            </div>
            <div class="container mt-2">
                <div class="row">
            @forelse ( $usedCarImage as  $usedCarImages )
            <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                <input type="checkbox" name="selected[]" value="{{ $usedCarImages->id }}">
                <div class ="card-m-auto">
                    <img src="{{asset('storage/image/used_car/'.$usedCar->registration.'/'.$usedCarImages->image)}}" class="card-img-top" alt="Broken" height="300" width="100"/>
                    <div class="card-body">
                        <form style="padding-left:3%" >
                            <a href = "/usedcarImage/delete/{{$usedCarImages->id}}" class= "btn btn-danger btn-sm delete" style="width:9cm">Delete</a>
                        </form>
                    </div>
                </div>
            </div>
                @empty
                <h1 class="text-danger">There is no uploads</h1>
                @endforelse
                
                <div class="d-flex justify-content-center">
                    {{ $usedCarImage->links() }}
                    </div>
            </div>
        
    </div>
            </form>
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
                            <input type= "bigint" class="form-control" value="{{$usedCar->id}}" name="add-usedcarid" id="add-usedcarid" readonly>
                          </div>
                          <div class="form-group mb-3">
                            <label for="" class="col-form-label">Used Car Image:</label>
                            <input type="file" class="form-control-image" id="Used_Car_Image" name="Used_Car_Image[]" multiple>
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
