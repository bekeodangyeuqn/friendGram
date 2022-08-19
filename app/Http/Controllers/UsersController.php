<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;


class UsersController extends Controller
{
    public function index() {
        $users = User::all()->sortByDesc("created_at");
        return  view('users.index',compact('users'));
    }

    public function Search(Request $request){
        $searchterm = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(User::class, ['name'])->perform($searchterm);

        return view('users.search', compact('searchResults', 'searchterm'));
    }
}
