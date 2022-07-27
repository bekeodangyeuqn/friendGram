<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {   $user = User::findorfail($user);
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;
        $postsCount = Cache::remember('posts.count.' . $user->id, now()->addSecond(30), function() use($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember('followers.count.' . $user->id, now()->addSecond(30), function() use($user){
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember('following.count' . $user->id, now()->addSecond(30), function() use($user){
            return $user->following->count();
        });
        //dd($follows);
        return view('profiles.index',compact('user','follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(\App\Models\User $user){
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public  function update(\App\Models\User $user){
        $data = request()->validate([
           'title' => '',
           'description' => '',
           'url' => '',
           'image' => '',
        ]);
        if (request('image')){
            $imagePath = request('image')->store('profile','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }
        $user->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect("/profile/{$user->id}");
    }
}
