@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{!! $route->name !!}</h1>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <a href="{!! action('RouteController@downloadRoute', [$route->id]) !!}" class="btn btn-primary">Download Image</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('color', 'Color: ') !!}
            {!! Form::input('text', 'color', $route->color, array('class' => 'form-control', 'disabled')) !!}
        </div>
        <div class="col-md-2">
            {!! Form::label('rating', 'Average Rating: ') !!}
            {!! Form::input('text', 'rating', $route->rating, array('class' => 'form-control', 'disabled')) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            {!! Form::label('rating_count', 'Rating Count: ') !!}
            {!! Form::input('text', 'rating_count', $route->rating_count, array('class' => 'form-control', 'disabled')) !!}
        </div>
        <div class="col-md-2">
            {!! Form::label('created_by', 'Created By: ') !!}
            {!! Form::input('text', 'created_by', $creator->name, array('class' => 'form-control', 'disabled')) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open([ 'action' => 'RatingController@rateRoute', 'class' => '', 'style' => '']) !!}
                    <div class="row">
                        @if(is_null($rating))
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
    <div class="row">
    </div>
</div>
@endsection
