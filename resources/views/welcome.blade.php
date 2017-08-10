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
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
