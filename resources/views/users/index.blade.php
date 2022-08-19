@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="get" action="{{ route('user.search') }}" class="form-inline mr-auto d-flex">
            <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control col-sm-8"  placeholder="Search users name..." aria-label="Search">
            <button class="btn btn-primary mx-2" type="submit">Search</button>
        </form>
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
                @foreach($users as $user)
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
