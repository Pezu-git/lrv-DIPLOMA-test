<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class ClientTicketPageController extends Controller
{
    public function index()
    {
        $hall_name = $_GET['hall_name'];
        $movie_title = $_GET['movie_title'];
        $start_time = $_GET['start_time'];
        $places = $_GET['places'];
        $QRtext = "Фильм: " . $movie_title . PHP_EOL . "Зал: "  . $hall_name . PHP_EOL . "Ряд/Место: " . $places . PHP_EOL . PHP_EOL . "Начало сеанса: " . $start_time . PHP_EOL . "Билет действителен строго на свой сеанс";
        $qr = QrCode::encoding('UTF-8')->size(200)->generate($QRtext);

        return view('client.ticket', [
            'hall_name' => $hall_name,
            'movie_title' => $movie_title,
            'start_time' => $start_time,
            'places' => $places,
            'qr' => $qr,
        ]);
    }
}
