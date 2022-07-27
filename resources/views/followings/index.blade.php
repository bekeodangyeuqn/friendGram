@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center fw-bold">{{ $mainUser->name }}'s followings</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
            </tr>
            </thead>
            <tbody>
            @foreach($followings as $profile)
                <tr>
                    <th scope="row">{{ $profile->user_id }}</th>
                    <td>
                        <a href="\profile\{{$profile->user_id}}" class="fw-bold text-decoration-none text-black">{{ App\Models\User::find($profile->user_id)->name }}</a>
                    </td>
                    <td>{{ App\Models\User::find($profile->user_id)->email }}</td>
                    <td>{{ App\Models\User::find($profile->user_id)->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
