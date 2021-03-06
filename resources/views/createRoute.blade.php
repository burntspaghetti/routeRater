@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(Auth::check())
                    <div class="panel-heading">Create Route</div>

                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open([ 'action' => 'RouteController@storeRoute', 'class' => 'clearfix', 'style' => 'padding:1em 3em;', 'files' => true]) !!}

                                <!--Name Form Input-->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name: ') !!}
                                    {!! Form::input('text', 'name', null, array('class' => 'form-control')) !!}
                                    {!! $errors->first('name', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                                </div>

                            <div class="form-group">
                                <a href="{!! action('RouteController@downloadWall') !!}">Click here to download a stock photo of the wall.</a>
                                <br>
                                {!! Form::label('image', 'Route Image: ') !!}
                                {!! Form::file('image') !!}
                                {!! $errors->first('image', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                            </div>
                            <!--rating dropdown-->
                            <div class="form-group">
                                {!! Form::label('color', 'Color:') !!}
                                {!! Form::select('color', array('' => null,
                                                                'Blue' => 'Blue',
                                                                'Green' => 'Green',
                                                                'Red' => 'Red',
                                                                'White' => 'White',
                                                                'Black' => 'Black',
                                                                ), null, array('class' => 'form-control btn btn-default')) !!}
                                {!! $errors->first('color', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                            </div>
                            <!--comments Form Input-->
                            <div class="form-group">
                                {!! Form::label('comments', 'Comments: ') !!}
                                {!! Form::textarea('comments', null, array('class' => 'form-control btn btn-default')   ) !!}
                                {!! $errors->first('comments', '<p class="text-danger" style="padding:1em;">:message</p>') !!}
                            </div>
                            <button class="btn btn-success" type="submit">Submit</button>
                            <a href="{!! action('RouteController@routes') !!}" class="btn btn-danger">Cancel</a>

                            {!! Form::close() !!}

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
