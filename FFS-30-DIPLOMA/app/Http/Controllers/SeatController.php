<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Hall;
use App\Models\HallConf;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Seat::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($result)
    {
        $hall_id = $result[0]['hall_id'];
        Seat::where('hall_id', $hall_id)->delete();

        foreach ($result as $key => $value) {
            Seat::create([
                'hall_id' => $value["hall_id"],
                'row_num' => $value["row_num"],
                'seat_num' => $value["seat_num"],
                'status' => $value["status"],
                'taken' => false
            ]);
        }
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $hall_id,
     * @return \Illuminate\Http\Response
     */
    public function show(int $hall_id)
    {
        return Seat::where('hall_id', '=', $hall_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hallConf['rows'] !== 0 && $request->hallConf['rows'] !== 0) {
            $hall = HallConf::where('id', $request->result[0]["hall_id"])->first();
            $hall->rows = $request->hallConf['rows'];
            $hall->cols = $request->hallConf['cols'];
            $hall->save();
        }
        foreach ($request->result as $key => $value) {
            $seat = Seat::where('hall_id', $value["hall_id"])
                ->where('row_num', $value["row_num"])
                ->where('seat_num', $value["seat_num"])->first();
            if ($seat === null) {
                return $this->store($request->result);
            } else {
                $seat->status = $value["status"];
                $seat->save();
            }
        }
        return $request->hallConf;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Seat::where('hall_id', $id)->delete()) {
            return redirect()->route('admin');
        }
        return  null;
    }
}
