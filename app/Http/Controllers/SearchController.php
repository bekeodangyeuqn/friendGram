<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function searchByUserName(Request $request){
       $users = User::where('name', 'ilike', '%' . $request->value . '%')->get();
       return response()->json($users);
   }

    public function searchByPostCaption(Request $request){
        $posts = Post::where('caption', 'ilike', '%' . $request->value . '%')->get();
        return response()->json($posts);
    }
}
