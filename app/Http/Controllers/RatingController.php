<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rateRoute(Requests\RatingRequest $request)
    {
        if($request->has('insert'))
        {
            $rating = new Rating();
            $rating->score = $request->score;
            $rating->user_id = $request->user()->id;
            $rating->route_id = $request->route_id;
        }
        elseif($request->has('update'))
        {
            $rating = Rating::find($request->rating_id);
            $rating->score = $request->score;
        }

        $rating->save();

        $route = Route::find($request->route_id);

        $ratings = Rating::where('route_id', $route->id);
        $totalScore = 0;
        $count = 0;
        foreach($ratings as $rat)
        {
            $totalScore = $totalScore + $rat->score;
            $count++;
        }

        $averageScore = $totalScore / $count;

        $route->
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
