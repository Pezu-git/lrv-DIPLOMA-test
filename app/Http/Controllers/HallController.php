<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
use App\Models\HallConf;
use App\Models\Seat;
use App\Models\PriceList;
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
        if (Auth::user()->is_admin !== '1') {
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
        $hall_id = Hall::where('name', $request->name)->first()->id;
        return ['hall_id' => $hall_id, 'hall_name' => $request->name];
        // return redirect()->route('hall_conf', ['hall_id' => $hall_id, 'hall_name' => $request->name]);
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

    public function destroy(Request $request)
    {
        Hall::find($request->hall_id)->delete();
        HallConf::find($request->hall_id)->delete();
        Seat::where('hall_id', $request->hall_id)->delete();
        PriceList::where('hall_id', $request->hall_id)->delete();
    }

    /**
     * Set hall active status
     *
     * @param  int  $id
     * @param  bool  $is_active
     * @return \Illuminate\Http\Response
     */
    public function setActive(Request $request)
    {
        $hall = Hall::findOrFail($request->id);
        if ($hall->is_active == true) {
            $hall->is_active = false;
            $hall->save();
            return ['Открыть продажу билетов', 'Зал готов к открытию:'];
        } else {
            $hall->is_active = true;
            $hall->save();
            return ['Закрыть продажу билетов', 'Продажа билетов открыта'];
        };
    }
}
