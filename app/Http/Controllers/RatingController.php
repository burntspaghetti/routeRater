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

        $ratings = Rating::where('route_id', $route->id)->get();
        $totalScore = 0;
        $count = 0;
        foreach($ratings as $rat)
        {
            $totalScore = $totalScore + $rat->score;
            $count++;
        }

        $averageScore = $totalScore / $count;

        $route->rating_count = $count;
        $route->rating = $averageScore;
        $route->save();

        $request->session()->flash('success', 'Rating saved.');
        return redirect()->action('RouteController@routes');
    }
}
