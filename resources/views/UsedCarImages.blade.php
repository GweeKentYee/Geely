@extends('layouts.app')

@section('content')
<main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span style="font-size: 20px"><a href="/admin/usedcar">Used Car</a> / Images / {{ $usedCar->registration }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-offset-3">
                            <div class="newbtn">
                                <h4>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#newusedcar"><i class="bi bi-plus-lg"></i> Add Used Car Image</button>
                                </h4>
                            </div>
                           
                            <form id="delsel" action="{{ url('/usedCarImage/delete/selected') }}"
                                method="get">
                                <div class="delbtn">
                                    <h4>
                                        <button type="submit" class="btn btn-danger">Delete Selected</button>
                                    </h4>
                                </div>
                        </div>
                        <br>
                        <br>
                        <div class="row justify-content-center">
                        @forelse( $usedCarImage as  $usedCarImages )
                            <div class="col-xl-3 col-lg-5 col-md-6 col-xs-12 gallery">
                                <div class="card cat-card m-auto ">
                                    <div>
                                        <label class="checkbox">
                                            <input form="delsel" type="checkbox" name="selected[]"
                                                value="{{ $usedCarImages->id }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <img src="{{ asset('storage/image/used_car/'.$usedCar->registration.'/'.$usedCarImages->image) }}"
                                        class="card-img-top" alt="Broken" />
                                </div>
                            </div>
                        @empty
                            <h3 style="text-align: center">There are no uploads</h3>
                        @endforelse
                        </div>

                    </div>

                </div>
                    {{ $usedCarImage->links() }}
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
                                <input type="bigint" class="form-control" value="{{ $usedCar->id }}"
                                    name="add-usedcarid" id="add-usedcarid" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label class="col-form-label">Used Car Image:</label>
                                <input type="file" name="Used_Car_Image[]" class="inputfile" id="Used_Car_Image" data-multiple-caption="{count} files selected" multiple>
                                <label for="Used_Car_Image">Choose a file</label>
                                @error('Used_Car_Image')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" id="submit" class="btn btn-primary submit">Add</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<main class="py-4">
@endsection
@section('footer-scripts')
@if($errors->count() > 0)
    <script>
        $(function () {
            $('#newusedcar').modal('show');
        });

    </script>
@endif
<script>
var inputs = document.querySelectorAll( '.inputfile' );

Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;
       
	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( ' \ ').pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});
</script>
@endsection
