<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceListRequest;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Mockery\Undefined;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PriceList::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $hall_id = $request->result[0]['hall_id'];
        PriceList::where('hall_id', $hall_id)->delete();
        foreach ($request->result as $key) {
            PriceList::create([
                'hall_id' => $key["hall_id"],
                'status' => $key["status"],
                'price' => $key["price"]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $hall_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = PriceList::where('hall_id', '=', $request->hall_id)->get();
        if (!count($data)) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PriceListRequest  $request
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->result as $key) {
            $seat = PriceList::where('hall_id', $key['hall_id'])
                ->where('status', '=', $key['status'])->first();
            if ($seat === null) {
                return $this->store($request);
            }
            $seat->price = $key["price"];
            $seat->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $hall_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $hall_id)
    {
        if (PriceList::where('hall_id', '=', $hall_id)->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return  null;
    }
}
