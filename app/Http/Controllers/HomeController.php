<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
//        dd(Auth::user()->role);

        //get all routes with ratings
        $routes = Route::all();
        
        //better to the calc after it is saved, so that the calc is only done once each time it is updated
        //create score attribute on route 
        
        //sum all ratings for the route
        //divide by count of ratings
        //= rate
        //rate =
//        dd($routes);

        return view('welcome', compact('routes'));
    }
}
