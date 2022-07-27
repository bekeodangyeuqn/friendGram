@foreach($comments as $comment)
    <div class="display-comment"
         @if($comment->parent_id != null )
            style="margin-left: 40px; background-color: #58eb09; margin-top: 10px; padding: 10px"
         @else
             style="background-color: orange; border-radius: 4px; box-shadow: 5px 6px 6px 2px #e9ecef; padding: 10px; margin-bottom: 30px;"
        @endif>
        <div class="d-flex align-items-center">
                <img src="{{ $comment->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
            <div class="ms-1">
                <a href="\profile\{{$comment->user->id}}" class="fw-bold text-decoration-none text-black align-items-center">
                    {{$comment->user->name}}
                </a>
            </div>
        </div>
        <p>{{$comment->body}}</p>
        <form method="post" action="\c">
            @csrf
            <div class="d-flex align-items-center">
                <div class="me-2 align-items-center">
                    <img src="{{ auth()->user()->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                </div>
                <div class="form-group">
                    <input type="text" name=body class="form-control"/>
                    <input type="hidden" name=post_id value="{{$post_id}}"/>
                    <input type="hidden" name=parent_id value="{{$comment->id}}"/>
                </div>
                <div class="form-group ms-2">
                    <input type="submit" class="btn btn-primary" value="Reply">
                </div>
            </div>
        </form>
        @include("posts.commentsDisplay", ["comments" => $comment->replies])
    </div>
@endforeach
