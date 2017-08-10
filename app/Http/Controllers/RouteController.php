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
        $route->rating = $request->rating;
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
        $rating = Rating::where('user_id', $route->user_id)->first();
        
        return view('route', compact('route', 'creator', 'rating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
