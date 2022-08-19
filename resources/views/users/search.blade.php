@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form method="get" action="{{ route('user.search') }}" class="form-inline mr-auto d-flex">
                    <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control col-sm-8"  placeholder="Search events or blog posts..." aria-label="Search">
                    <button class="btn btn-primary mx-2" type="submit">Search</button>
                </form>
                <br>
                @if(isset($searchResults))
                    @if ($searchResults-> isEmpty())
                        <h2>Sorry, no results found for the term <b>"{{ $searchterm }}"</b>.</h2>
                    @else
                        <h2>There are {{ $searchResults->count() }} results for the term <b>"{{ $searchterm }}"</b></h2>
                        <hr />
                        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                            <h2>{{ $type }}</h2>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelSearchResults as $searchResult)
                                        <tr>
                                            <td>
                                                <!-- Biến $url được cấu hình trong file model-->
                                                <a href="{{ $searchResult->url }}" class="text-decoration-none">{{ $searchResult->title }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
