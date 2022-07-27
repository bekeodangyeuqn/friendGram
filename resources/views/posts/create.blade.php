@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
    <div class="row">
        <div class="col-8 offset-2">
            <div class="row fw-bold fs-3">Add new post</div>
            <div class="row mb-3">
                <label for="caption" class="col-md-4 col-form-label">Post caption</label>


                <input id="caption" type="text"
                class="form-control @error('caption') is-invalid @enderror"
                name="caption" value="{{ old('caption') }}"
                autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="row mb-3">
                <label for="image" class="col-md-4 col-form-label">Post image</label>
                <input type="file" name="image" class="form-control-file" id="image">
                @error('image')
                    <strong>{{ $message }}</strong>
                @enderror

            </div>
            <div class="row pt-3">
                <button class="btn btn-primary">Post</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
