<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class ClientPaymentPageController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        $hall_name = $_GET['hall_name'];
        $hall = $halls->where('name', $hall_name)->first();
        $movie_title = $_GET['movie_title'];
        $start_time = $_GET['start_time'];
        $places = $_GET['taken_places'];
        $price = $_GET['total_price'];

        return view('client.payment', [
            'hall_name' => $hall_name,
            'hall' => $hall,
            'movie_title' => $movie_title,
            'start_time' => $start_time,
            'places' => $places,
            'price' => $price,
        ]);
    }
}
