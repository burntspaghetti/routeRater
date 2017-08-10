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
                                <h1>Name: {!! $route->name !!}</h1>
                                <h2>Color: {!! $route->color !!}</h2>
                                @if(is_null($route->rating))
                                    <h3>Rating: Not yet rated</h3>
                                @else
                                    <h3>Rating: {!! $route->rating !!}</h3>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{!! action('RouteController@downloadRoute', [$route->id]) !!}">Click here to download a photo of the route</a>
                            </div>
                        </div>
                        {!! Form::open([ 'action' => 'RatingController@rateRoute', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) !!}
                            @if(is_null($rating))
                                <div class="form-group">
                                    {!! Form::label('score', 'Score:') !!}
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
                                <div class="form-group">
                                    {!! Form::label('score', 'Score:') !!}
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
                            <button class="btn btn-success" type="submit">Submit Score</button>

                        {!! Form::close() !!}
                    </div>
                    <div class="row">

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
