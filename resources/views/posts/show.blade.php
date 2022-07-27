@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <img class="col-sm-7" src="/storage/{{$post->image}}" alt="" style="max-height: 100vh">
        <div class="col-sm-5">
            <div class="d-flex align-items-center">
                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100 me-2" style="max-width: 40px" alt="">
                <div><a href="\profile\{{$post->user->id}}" class="fw-bold text-decoration-none text-black">{{$post->user->username}}</a></div>
                <div class="bg-black rounded-circle" style="max-width: 2px"></div>
                @if($post->user->id == Auth::id())
                @else
                    <div id='follow-button' userid="{{$post->user->id}}" follows="{{$follows}}"></div>
                @endif
            </div>
            <hr>
            <div>{{$post->caption}}</div>
            <hr>
            <h5>Comments</h5>

            @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
            <form method="post" action="\c">
                @csrf
                <div class="p-3" style="background-color: orange">
                    <div class="form-group mb-2">
                        <textarea class="form-control" name="body"></textarea>
                        <input type="hidden" name=post_id value="{{$post->id}}"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add comment">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
