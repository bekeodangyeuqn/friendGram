<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function create()
    {
        return view('posts.create');
    }

    public function  index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id') ;
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->simplePaginate(3);
        //dd($posts);
        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        $data = request()->validate([
            'another' => '',
            'caption' => 'required',
            'image' => ['required','image'],
        ]);
        $file = request()->file('image');
        $imageName = $file->hashName();
        $image = Image::make($file)->fit(1000,1000);
        $resource = $image->stream()->detach();
        //$imagePath = request('image')->store('uploads','s3');
        $imagePath = Storage::disk('s3')->put(
            'uploads/' . $imageName,
            $resource
        );
        $imageUrl = "https://friendgram.s3.ap-southeast-1.amazonaws.com/uploads/" . $imageName;
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imageUrl
        ]);
        return redirect('/profile/' .auth()->user()->id);
    }

    public function show(\App\Models\Post $post)
    {
        $follows = auth()->user() ? auth()->user()->following->contains($post->user->id) : false;
        return view('posts.show',compact('post','follows'));
    }
}
