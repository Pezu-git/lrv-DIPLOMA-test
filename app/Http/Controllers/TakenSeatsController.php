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

        $placesArray = [];
        $totalPrice = 0;
        $standartPrice = PriceList::where('hall_id', $hall_id)->where('status', 'standart')->first()->price;
        $standartVip = PriceList::where('hall_id', $hall_id)->where('status', 'vip')->first()->price;
        for ($i = 0; $i < count($request->takenPlaces); $i++) {
            $row = (string)$request->takenPlaces[$i]['row'];
            $place = (string)$request->takenPlaces[$i]['place'];
            $status = $request->takenPlaces[$i]['type'];
            if($status === 'standart') {
                $price = $standartPrice;
            }
            if($status === 'vip') {
                $price = $standartVip;
            }
            $str = $row . '/' . $place;
            array_push($placesArray, $str);
            $totalPrice += $price;
        }
        $takenPlacesStr = join(', ', $placesArray);

        return route('payment', ['movie_title' => $request->movie, 'start_time' => $request->seance, 'hall_name' => $request->hallName, 'taken_places' => $takenPlacesStr, 'total_price' => $totalPrice, 'takenPlacesArr' => $request->takenPlaces]);
    }
}
