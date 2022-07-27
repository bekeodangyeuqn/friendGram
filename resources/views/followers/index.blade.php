@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center fw-bold">{{ $mainUser->name }}'s followers</h3>
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
            @foreach($followers as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <a href="\profile\{{$user->id}}" class="fw-bold text-decoration-none text-black">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
