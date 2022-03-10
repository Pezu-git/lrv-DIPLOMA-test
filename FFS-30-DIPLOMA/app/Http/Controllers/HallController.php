<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
use App\Models\HallConf;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\PriceList;
use App\Models\MovieSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


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
        return view('admin.admin', [
            'seats' => $this->seats(), 'hallSeances' => $this->hallSeances(), 'hallIsActive' => $this->activeHall()
        ]);
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


    public function hallSeances()
    {
        $halls = Hall::all();
        // $arr = [];

        for ($i = 0; $i < $halls->count(); $i++) {
            for ($j = 0; $j < $halls[$i]->seances->count(); $j++) {
                $arr[$halls[$i]->id][$j] = [];
                try {
                    $d = (int)(Movie::where('id', $halls[$i]->seances[$j]->movie_id)->first()->duration) / 2;
                    $st = (int)($halls[$i]->seances[$j]->start_time) * 30;
                    $mn = Movie::where('id', $halls[$i]->seances[$j]->movie_id)->first()->title;
                    array_push($arr[$halls[$i]->id][$j], $d);
                    array_push($arr[$halls[$i]->id][$j], $st);
                    array_push($arr[$halls[$i]->id][$j], $mn);
                } catch (\Exception $e) {
                    array_push($arr, null);
                }
            }
        }
        return $arr;
    }

    public function seats()
    {
        $hc = HallConf::all();
        // $arr = [];
        foreach ($hc as $key => $value) {
            $hall = Hall::where('id', $value->id)->first();
            for ($i = 0; $i < $value->rows; $i++) {
                for ($j = 0; $j < $value->cols; $j++) {
                    $arr[$value->id][$i][$j] = [];
                    try {
                        $s = $hall->seats->where('row_num', $i)->where('seat_num', $j)->first()->status;
                        array_push($arr[$value->id][$i][$j], $s);
                    } catch (\Exception $e) {
                        array_push($arr[$value->id][$i][$j], 'standart');
                    }
                }
            }
        }
        return $arr;
    }

    public function activeHall()
    {
        $halls = Hall::all();

        foreach ($halls as $key => $value) {
            $arr[$value->id] = [];
            if (MovieSchedule::where('hall_id', $value->id)->first()) {

<<<<<<< HEAD
        $a[$request->hallName] = [];
        $s = Hall::where('name', $request->hallName)->first()->seances;
        foreach ($s as $key => $value) {
            Movie::where('id', $value->movie_id)->first()->start_time;
            $m = Movie::where('id', $value->movie_id)->first();
            $m['start_time'] = $value->start_time;
            array_push($a[$request->hallName], $m);
            // array_push($a[$request->hallName], $value->start_time);
=======
                array_push($arr[$value->id], 'is_active');
            } else {
                array_push($arr[$value->id], null);
            }
>>>>>>> 6e0f52b2e5814e979f9e05e59309b2083c11926d
        }
        return $arr;
    }
}
