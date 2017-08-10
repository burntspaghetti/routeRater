<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Intervention\Image\Facades\Image;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $path = storage_path() . "/routes/" . $route->id . ".jpg";

        Image::make($request->image)->orientate()->encode('jpg')->save($path);


        return redirect()->action('HomeController@home');
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
        $rating = Rating::where('user_id', $route->user_id)->where('route_id', $id)->first();

        return view('route', compact('route', 'creator', 'rating'));
    }

    public function approve($id)
    {
        $route = \App\Route::find($id);
        $route->approved = 'Yes';
        $route->save();
        return redirect()->action('HomeController@home');
    }

    public function remove($id)
    {
        $route = \App\Route::find($id);
        $route->approved = 'No';
        $route->save();
        return redirect()->action('HomeController@home');
    }
}
