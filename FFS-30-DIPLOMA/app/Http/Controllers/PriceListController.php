<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceListRequest;
use App\Models\PriceList;
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
    public function store($result)
    {
        $hall_id = $result[0]['hall_id'];
        PriceList::where('hall_id', $hall_id)->delete();
        foreach ($result as $key => $value) 
        {
            PriceList::create([
                'hall_id' => $value["hall_id"],
                'status' => $value["status"],
                'price' => $value["price"]
            ]);                    
        }
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $hall_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $hall_id)
    {
        $data = PriceList::where('hall_id','=',$hall_id)->get();
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
    public function update($result)
    {
        $params = (array)json_decode($result, true);
        foreach($params as $key => $value ) {
            $seat = PriceList::where('hall_id', $value['hall_id'])
            ->where('status', '=', $value['status'])->first();
            if($seat === null) {
                return $this->store($params); 
            }
            $seat->price = $value["price"];
            $seat->save();
        }
        return redirect('/admin');


        // $seatSdt = PriceList::where('hall_id', $hall_id)
        // ->where('status', 'standart' )->firstOrFail();
        // $seatVip = PriceList::where('hall_id', $hall_id)
        // ->where('status', 'vip' )->firstOrFail();
        // $seatSdt->update(['price' => $st_price]);
        // $seatVip->update(['price' => $vip_price]);
        // return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $hall_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $hall_id)
    {
        if (PriceList::where('hall_id','=',$hall_id)->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return  null;
    }
}