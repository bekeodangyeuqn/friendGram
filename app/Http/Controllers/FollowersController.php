<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function index(Profile $profile){
        $mainUser = $profile->user;
        $followers = $profile->followers->all();
        return view('followers.index', compact('followers', 'mainUser'));
    }
}
