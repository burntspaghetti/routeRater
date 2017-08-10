<?php

namespace App\Http\Controllers;

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


        dd('done');


//        if(!file_exists($file))
//        {
//       // create temporary folder to store unmerged pdfs
//          $tmp = mkdir($file, 0777, true);
//        }
//
//
        
        //convert to png
        //move file
        //save name, comments, path
        //return to home page

        //return $file->move($this->unconvertedPDFsDir, $this->CWID . "_" . $uploadNum . "." . $format);


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
