<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Hall;
use App\Models\HallConf;
use Illuminate\Http\Response;
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
    public function store($hall_id)
    {
        Seat::where('hall_id', $hall_id)->delete();

        $hall_row = HallConf::where('id', $hall_id)->first()->rows;
        $hall_col = HallConf::where('id', $hall_id)->first()->cols;

        for($i = 0; $i < $hall_row; $i++) {
            for($j = 0; $j < $hall_col; $j++) {
                 Seat::create([
                'hall_id' => $hall_id,
                'row_num' => $i,
                'seat_num' => $j,
                'status' => 'standart'
             ]);   
            }
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
        return Seat::where('hall_id','=',$hall_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($result)
    {
        foreach ((array)json_decode($result, true) as $key => $value) 
        {
                $seat = Seat::where('hall_id', $value["hall_id"])
                ->where('row_num', $value["row_num"])
                ->where('seat_num', $value["seat_num"])->first();
                if($seat === null) {
                    $this->store($value["hall_id"]);    
                } else {
                    $seat->status = $value["status"];
                    $seat->save(); 
                }
                          
        }
        return redirect('/admin');
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