@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(Auth::check())
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{!! action('RouteController@createRoute') !!}" class="btn btn-primary">Create Route</a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <h2>Basic Table</h2>
                                <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Rating</th>
                                        <th>Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($routes as $route)
                                        {{--TODO: make admin account and restrict this based on if it's been approved yet--}}
                                        <tr>
                                            <td>
                                                <a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>
                                            </td>
                                            <td>{!! $route->rating !!}</td>
                                            <td>{!! $route->score !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
