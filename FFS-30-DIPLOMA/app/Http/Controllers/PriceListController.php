<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceListRequest;
use App\Models\PriceList;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
    public function store(\Illuminate\Http\Request  $request)
    {
        $this->destroy($request->json()->all()[0]["hall_id"]);

        foreach ($request->json() as $value) {
            $newSeatRequest = new \Illuminate\Http\Request($value);
            $validator = Validator::make($newSeatRequest->all(), [
                'hall_id' => ['required', 'int'],
                'price' => ['required', 'int'],
                'status' => ['required', 'in:standard,vip'],
            ]);
            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
            }
            PriceList::create($validator->validated());
        }

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
    public function update(\Illuminate\Http\Request $request, $hall_id)
    {
        foreach ($request->json() as $key => $value) {
            try {
                $seat = PriceList::where('hall_id','=',$hall_id)
                    ->where('status', '=', $value['status'])->firstOrFail();
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