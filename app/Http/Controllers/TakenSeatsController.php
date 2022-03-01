<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TakenSeats;
use App\Models\PriceList;
use App\Models\MovieSchedule;
use Illuminate\Support\Arr;
use App\Models\Hall;

class TakenSeatsController extends Controller
{
    public function index()
    {
        return TakenSeats::all();
    }

    public function update(Request $request)
    {

        $hall_id = Hall::where('name', $request->hallName)->first()->id;
        $seance_id = MovieSchedule::where('hall_id', $hall_id)->where('start_time', $request->seance)->first()->id;

        $placesArray = [];
        $totalPrice = 0;
        for ($i = 0; $i < count($request->takenPlaces); $i++) {
            $row = (string)$request->takenPlaces[$i]['row'];
            $place = (string)$request->takenPlaces[$i]['place'];

            $status = $request->takenPlaces[$i]['type'];
            $price = PriceList::where('hall_id', $hall_id)->where('status', $status)->first()->price;
            $str = $row . '/' . $place;
            array_push($placesArray, $str);
            $totalPrice += $price;
        }
        $takenPlacesStr = join(', ', $placesArray);

        foreach ($request->takenPlaces as $key) {
            $seat = TakenSeats::where('hall_id', $hall_id)->where('seance_id', $seance_id)->where('row_num', $key["row"] - 1)
                ->where('seat_num', $key["place"] - 1)->first();
            $seat->taken = 1;
            $seat->save();
        }

        return route('payment', ['movie_title' => $request->movie, 'start_time' => $request->seance, 'hall_name' => $request->hallName, 'taken_places' => $takenPlacesStr, 'total_price' => $totalPrice]);
    }
}
