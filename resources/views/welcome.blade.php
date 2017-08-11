@extends('layouts.app')
@section('content')
    <style>
        .dataTables_filter {
            width: 50%;
            float: right;
            text-align: right;
        }
    </style>
<div class="">
    <div class="">
        @if(Auth::check())
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Routes</h2>
                        <p>Below you will find a list of all the routes. Click on the route name to view the route image and details.</p>

                        <table id="example" class="table table-striped table-bordered datatables-example dataTable" cellspacing="0" width="100%" id="DataTables_Table_0" role="grid" aria-describedby="applications" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 132px;">Name</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Color: activate to sort column descending" style="width: 132px;">Color</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Average Rating: activate to sort column descending" style="width: 132px;">Average Rating</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rating Count: activate to sort column descending" style="width: 132px;">Rating Count</th>
                                @if(Auth::user()->role == 'admin')
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Approve/Remove: activate to sort column descending" style="width: 132px;">Approve/Remove</th>
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
                                        <td>{!! $route->rating_count !!}</td>
                                    </tr>
                                @elseif(Auth::user()->role == 'admin')
                                    <tr>
                                        <td>
                                            <a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>
                                        </td>
                                        <td>{!! $route->color !!}</td>
                                        <td>{!! $route->rating !!}</td>
                                        <td>{!! $route->rating_count !!}</td>
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
            </div>
        @endif
    </div>
</div>

{{--<script type="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script type="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>--}}


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                paging: false
            });
        } );
    </script>
@endsection
