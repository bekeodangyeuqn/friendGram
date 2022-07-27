@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}" alt="" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h4>{{$user->username}}</h4>
                @if($user->id == Auth::id())
                @else
                    <div id='follow-button' userid="{{$user->id}}" follows="{{$follows}}"></div>
                @endif
            </div>
            @can('update',$user->profile)
                <div><a href="/p/create" class="text-decoration-none">Add new post</a></div>
            @endcan
        </div>
        @can('update',$user->profile)
                <div><a href="/profile/{{$user->id}}/edit" class="text-decoration-none">Edit profile</a></div>
        @endcan
                <div class="d-flex">
            <div class="pe-5"><strong style="margin-right: 4px">{{ $postsCount }}</strong>Posts</div>
            <div class="pe-5"><strong style="margin-right: 4px">{{ $followersCount }}</strong>
                <a href="/followers/{{$user->id}}" class="text-decoration-none">Followers</a>
            </div>
            <div class="pe-5"><strong style="margin-right: 4px">{{ $followingCount }}</strong>
                <a href="/followings/{{$user->id}}" class="text-decoration-none">Followings</a>
            </div>
        </div>
        <div class="fw-bold pt-3">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href="freeCodeCamp.org" class="text-decoration-none">{{$user->profile->url}}</a></div>
    </div>
    </div>
    <div class="row pt-4">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" alt="" class="w-100"></a>
            </div>
        @endforeach
    </div>
</div>
@endsection
