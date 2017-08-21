<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use App\Route;
use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Intervention\Image\Response;

class RouteController extends Controller
{
    public function routes($color=null)
    {

        if(is_null($color))
        {
            $routes = Route::all();
        }
        else
        {
            $routes = Route::where('color', $color)->get();
        }

        foreach($routes as $route)
        {
            $creator = User::find($route->user_id);
            $currentUserScore = Rating::where('user_id', Auth::user()->id)->where('route_id', $route->id)->first();
//            dd($currentUserScore);

            if(!is_null($creator))
            {
                $route->creator = $creator->name;
            }
            else
            {
                $route->creator = $creator->name;
            }

            if(!is_null($currentUserScore))
            {
                $route->currentUserRating = $currentUserScore->score;
            }
            else
            {
                $route->currentUserRating = null;
            }
        }

//        dd($routes);

        return view('welcome', compact('routes', 'color'));
    }
    
    
    public function createRoute()
    {
        return view('createRoute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoute(RouteRequest $request)
    {
        $route = new \App\Route();
        $route->name = $request->name;
        $route->comments = $request->comments;
        $route->color = $request->color;
        $route->user_id = $request->user()->id;
        $route->approved = 'No';
        $route->save();
        $path = public_path() . "/routes/" . $route->id . ".jpg";

        Image::make($request->image)->orientate()->encode('jpg')->save($path, 50);
        $route->image_path = $path;
        $route->save();

        $request->session()->flash('success', 'Route saved.');
        return redirect()->action('RouteController@routes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function route($id)
    {
        $route = \App\Route::find($id);
        $creator = User::find($route->user_id);
        $rating = Rating::where('user_id', Auth::user()->id)->where('route_id', $id)->first();

        return view('route', compact('route', 'creator', 'rating'));
    }

    public function approve($id)
    {
        $route = \App\Route::find($id);
        $route->approved = 'Yes';
        $route->save();
        return redirect()->action('RouteController@routes');
    }

    public function remove($id)
    {
        $route = \App\Route::find($id);
        $route->approved = 'No';
        $route->save();
        return redirect()->action('RouteController@routes');
    }

    public function downloadWall()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/example.jpg";

        $headers = array(
            'Content-Type', 'image/jpeg',
        );

        return response()->download($file, 'wall.jpg', $headers);
    }

    public function downloadRoute($id)
    {
        $route = \App\Route::find($id);
        //PDF file is stored under project/public/download/info.pdf
        $file= $route->image_path;

        $headers = array(
            'Content-Type', 'image/jpeg',
        );

        return response()->download($file, $route->name . '.jpg', $headers);
    }
}
