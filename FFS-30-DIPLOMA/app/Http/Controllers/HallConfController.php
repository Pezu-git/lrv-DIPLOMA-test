<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateHallConfRequest;
use App\Models\HallConf;
use App\Http\Requests\HallConfRequest;
use Illuminate\Http\Response;

class HallConfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HallConf::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HallConfRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HallConfRequest $request)
    {
        
        $hall_id = HallConf::insertGetId($request->validated());
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HallConf  $hallConf
     * @return \Illuminate\Http\Response
     */
    public function show(int $hall_id)
    {
        return HallConf::findOrFail($hall_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateHallConfRequest  $request
     * @param  \App\Models\HallConf  $hallConf
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHallConfRequest $request, HallConf $hallConf)
    {
        $hallConf->fill($request->validated());
        return $hallConf->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HallConf  $hallConf
     * @return \Illuminate\Http\Response
     */
    public function destroy(HallConf $hallConf)
    {
        if ($hallConf->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}