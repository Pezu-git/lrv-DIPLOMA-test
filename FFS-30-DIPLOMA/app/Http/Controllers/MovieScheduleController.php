<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieScheduleRequest;
use App\Models\MovieSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MovieScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return MovieSchedule::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MovieScheduleRequest  $request
     * @return Response
     */
    public function store(MovieScheduleRequest $request)
    {
        return MovieSchedule::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $hall_id
     * @return Response
     */
    public function show(int $hall_id)
    {
        $movie_id = $_GET['movie_id'] ?? null;
        if ($movie_id) {
            $data = MovieSchedule::where('hall_id', '=', $hall_id)->where('movie_id', '=', $movie_id)->get();
        } else {
            $data = MovieSchedule::with('movie')->where('hall_id', '=', $hall_id)->whereHas('movie')->get();
        }

        if (!count($data)) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovieSchedule  $movieSchedule
     * @return Response
     */
    public function destroy(MovieSchedule $movieSchedule)
    {
        if ($movieSchedule->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}