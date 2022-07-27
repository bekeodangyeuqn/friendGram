<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        $users = User::all()->sortByDesc("created_at");
        return  view('users.index',compact('users'));
    }
}
