<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingsController extends Controller
{
    public function index(User $user){
        $mainUser = $user;
        $followings = $user->following->all();
        return view('followings.index', compact('followings','mainUser'));
    }
}
