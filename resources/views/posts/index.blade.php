@extends('layouts.app')

@section('content')
    @if ($posts->count() != 0)
        <div class="container">
        @foreach($posts as $post)
            <div class="pt-3 pb-5 mb-5 col-6 offset-3" style="background-color: pink;">
                <div class="row pt-2 pb-4">
                    <div class="col offset-2">
                        <p>
                        <span class="font-weight-bold">
                            <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle w-100 me-2" style="max-width: 40px" alt="">
                            <a href="\profile\{{$post->user->id}}" class="fw-bold text-decoration-none text-black">{{$post->user->username}}</a>
                        </span>
                        <div>{{$post->caption}}</div>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <a href="/p/{{ $post->id }}" class="col-6 offset-3">
                        <img src="/storage/{{$post->image}}" alt="" class="w-100">
                    </a>
                </div>
            </div>

        @endforeach
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{  $posts->links()  }}
                </div>
            </div>
        </div>
    @else
        <div class="container d-flex justify-content-center">
            <h3>Let's follow someone to explore something new.</h3>
        </div>
    @endif
@endsection
