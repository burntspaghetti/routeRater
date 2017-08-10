@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6">
        @if(Auth::check())
            <div class="container">
                <div class="row">
                    <h2>Routes</h2>
                    <p>Below you will find a list of all the routes. Click on the route name to view the route image and details.</p>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Rating</th>
                            @if(Auth::user()->role == 'admin')
                                <th>Approve/Remove</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($routes as $route)
                            @if(Auth::user()->role == 'user' && strtolower($route->approved) != 'no')
                                <tr>
                                    <td>
                                        <a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>
                                    </td>
                                    <td>{!! $route->color !!}</td>
                                    <td>{!! $route->rating !!}</td>
                                </tr>
                            @elseif(Auth::user()->role == 'admin')
                                <tr>
                                    <td>
                                        <a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>
                                    </td>
                                    <td>{!! $route->color !!}</td>
                                    <td>{!! $route->rating !!}</td>
                                    <td>
                                        @if($route->approved === 'Yes')
                                            <a href="{!! action('RouteController@remove', [$route->id]) !!}" class="btn btn-danger">Remove</a>
                                        @elseif($route->approved === 'No')
                                            <a href="{!! action('RouteController@approve', [$route->id]) !!}" class="btn btn-success">Approve</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

{{--<script type="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script type="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>--}}


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
