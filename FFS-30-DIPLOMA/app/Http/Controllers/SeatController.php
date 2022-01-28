<?php

namespace App\Http\Controllers;

use App\Models\Seat;
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
    public function store(\Illuminate\Http\Request $request)
    {
        $this->destroy($request->json()->all()[0]["hall_id"]);

        foreach ($request->json() as $value) {
            $newSeatRequest = new \Illuminate\Http\Request($value);
            $validator = Validator::make($newSeatRequest->all(), [
                'hall_id' => ['required', 'int'],
                'row_num' => ['required', 'int'],
                'seat_num' => ['required', 'int'],
                'status' => ['required', 'in:disabled,standard,vip'],
            ]);
            if ($validator->fails()) {
                return redirect('admin')
                    ->withErrors($validator)
                    ->withInput();
            }
            Seat::create($validator->validated());
        }
        // return Seat::create($request->validated());
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
    public function update(\Illuminate\Http\Request $request, $hall_id)
    {
        foreach ($request->json() as $key => $value) {
            try {
                $seat = Seat::where('hall_id','=',$hall_id)
                    ->where('row_num', '=', $value["row_num"])
                    ->where('seat_num', '=', $value["seat_num"])->firstOrFail();
                $seat->fill($request->validated());
                $seat->save();
            } catch (\Exception $exception) {
                $this->store(json_encode($value));
            }

        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy($hall_id)
    {
        if (Seat::where('hall_id','=',$hall_id)->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return  null;
    }
}