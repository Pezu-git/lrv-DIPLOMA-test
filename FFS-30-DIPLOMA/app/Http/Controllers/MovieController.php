<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Models\MovieSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        Movie::create($request->validated());
        // return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Movie::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request;
        $movie_id = Movie::where('title', $request->title)->first()->id;
        Movie::where('id', $movie_id)->first()->delete();
        MovieSchedule::where('movie_id', $movie_id)->delete();
        // return $movie_id;
        // return redirect('/admin');
        // if ($movie->delete()) {
        //     return response(null, Response::HTTP_NO_CONTENT);
        // }
        // return null;
    }
}
