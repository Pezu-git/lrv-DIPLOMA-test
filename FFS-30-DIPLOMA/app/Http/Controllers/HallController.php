<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\ModalToggle;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();
        if(Auth::user()->is_admin !== '1') {
            return redirect('/index');
        }
        
        return view('admin.admin', ['halls' => $halls]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HallRequest $request)
    {
         Hall::create($request->validated());
         return redirect()->route('admin');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Hall::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HallRequest  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(HallRequest $request, Hall $hall)
    {
        $hall->fill($request->validated());
        return $hall->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        if ($hall->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }

    public function hallDelete(int $id)
    {
        Hall::find($id)->delete();
        return redirect()->route('admin');
    }

  

    /**
     * Set hall active status
     *
     * @param  int  $id
     * @param  bool  $is_active
     * @return \Illuminate\Http\Response
     */
    public function setActive(int  $id, bool  $is_active)
    {
        $hall = Hall::findOrFail($id);
        $hall->is_active = $is_active;
        return $hall->save();
    }
}