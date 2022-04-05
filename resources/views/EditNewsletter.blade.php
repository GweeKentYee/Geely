@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3><a href = "/admin/newsletter">Manage Newsletter</a></h3>
            <form action="/admin/newsletter/editfunction/{{ $newsletter->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if (Session::has('field_empty'))
                <br>
                    <div class="alert alert-danger">
                        <p>{{ Session::get('field_empty') }}</p>
                    </div>
                @endif
                <div class="modal-body">
                    <br>
                    <h4>Image:  <a href="/admin/newsletter/view/{{ $newsletter->id }}">{{ $newsletter->image }}</a></h4>
                    <br>
                    <label>ID</label>
                    <input type="text" name="brand_id" class="form-control" value="{{ $newsletter->id }}" readonly>
                    <br>
                    <label>Link:</label>
                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="{{$newsletter->link}}">
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label>Sequence:</label>
                    <input type="number" name="sequence" class="form-control @error('sequence') is-invalid @enderror" value="{{ old('sequence') }}" min = "0" max = "" placeholder="{{$newsletter->sequence}}">
                    @error('sequence')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="/admin/newsletter">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
    </div>
</div>
@endsection

@section('footer-scripts')


@endsection
