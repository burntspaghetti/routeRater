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
                                            {{--<a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>--}}
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{!! $route->id !!}">
                                                Launch demo modal
                                            </button>
                                            {{--create modal here--}}
                                                    <!-- Modal -->
                                            <div class="modal fade" id="{!! $route->id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                        <td>{!! $route->color !!}</td>
                                        <td>{!! $route->rating !!}</td>
                                        <td>{!! $route->rating_count !!}</td>
                                    </tr>
                                @elseif(Auth::user()->role == 'admin')
                                    <tr>
                                        <td>
                                            {{--<a href="{!! action('RouteController@route', [$route->id]) !!}">{!! $route->name !!}</a>--}}
                                                    <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{!! $route->id !!}">
                                                {!! $route->name !!}
                                            </button>
                                            {{--create modal here--}}
                                                    <!-- Modal -->
                                            <div class="modal fade" id="{!! $route->id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">{!! $route->name !!}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <a href="{!! action('RouteController@downloadRoute', [$route->id]) !!}" class="btn btn-primary">Download Image</a>
                                                            <hr />
                                                            <h4>Color:</h4>
                                                            <span class="badge">{!! $route->color !!}</span>
                                                            <h4>Average Rating:</h4>
                                                            @if(is_null($route->rating))
                                                                <p>Not yet rated</p>
                                                            @else
                                                                <span class="badge">{!! $route->rating !!}</span>
                                                            @endif
                                                            <h4>Rating Count:</h4>
                                                            @if(is_null($route->rating_count))
                                                                <p>Not yet rated</p>
                                                            @else
                                                                <span class="badge">{!! $route->rating_count !!}</span>
                                                            @endif
                                                            <h4>Creator:</h4>
                                                            <span class="badge">{!! $route->creator !!}</span>
                                                            <br>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-body">
                                                                            {!! Form::open([ 'action' => 'RatingController@rateRoute', 'class' => '', 'style' => '']) !!}
                                                                            <div class="row">
                                                                                @if(is_null($route->currentUserScore))
                                                                                    <div class="col-md-12">
                                                                                        {!! Form::label('score', 'Your Rating:') !!}
                                                                                        {!! Form::select('score', array('' => null,
                                                                                                                        '1' => '1',
                                                                                                                        '2' => '2',
                                                                                                                        '3' => '3',
                                                                                                                        '4' => '4',
                                                                                                                        '5' => '5',
                                                                                                                        ), null, array('class' => 'form-control btn btn-default')) !!}
                                                                                        {!! $errors->first('score', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                                                                                    </div>
                                                                                    {!! Form::hidden('insert', true) !!}
                                                                                @else
                                                                                    <div class="col-md-12">
                                                                                        {!! Form::label('score', 'Your Rating:') !!}
                                                                                        {!! Form::select('score', array('' => null,
                                                                                                                        '1' => '1',
                                                                                                                        '2' => '2',
                                                                                                                        '3' => '3',
                                                                                                                        '4' => '4',
                                                                                                                        '5' => '5',
                                                                                                                        ), $rating->score, array('class' => 'form-control btn btn-default')) !!}
                                                                                        {!! $errors->first('score', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                                                                                    </div>
                                                                                    {!! Form::hidden('update', true) !!}
                                                                                    {!! Form::hidden('rating_id', $rating->id) !!}
                                                                                @endif
                                                                                {!! Form::hidden('route_id', $route->id) !!}
                                                                            </div>
                                                                            <br>

                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <button class="btn btn-success" type="submit">Submit Score</button>
                                                                                </div>
                                                                            </div>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--<div class="modal-footer">--}}
                                                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                                            {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                </div>
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
