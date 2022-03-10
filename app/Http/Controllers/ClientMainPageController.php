<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientMainPageController extends Controller
{
    public function index()
    {
        return view('client.index', ['hallsSchedules' => $this->movieShedule(), 'weekDayRus' => $this->getWeekDayRus()]);
    }

    public function movieShedule() {
        $movies = Movie::all();
        $halls = Hall::all();
        $arr = [];
        for($i = 0; $i < $movies->count(); $i++) {
            for($j = 0; $j < count($halls); $j++) {
                $arr[$i][$j] = [];
                // if($halls[$j]->is_active ) {
                //     $hallId = $halls[$j]->seances->where('movie_id', $movies[$i]->id)->first()->hall_id;
                //     $hallName = Hall::where('id', $hallId)->first()->name;
                //     array_push($arr[$i][$j], $hallName);
                // } else {
                //     array_push($arr[$i][$j], null);
                // }
                try {
                    $hallId = $halls[$j]->seances->where('movie_id', $movies[$i]->id)->first()->hall_id;
                    $hallName = Hall::where('id', $hallId)->first()->name;
                    $isActive = Hall::where('id', $hallId)->first()->is_active;
                    if($isActive ) {
                        array_push($arr[$i][$j], $hallName);
                    } else {
                        array_push($arr[$i][$j], null);
                    }
                }  catch(\Exception $e) {
                    array_push($arr[$i][$j], null);
                }    
            }
        }
        return $arr;
    }

    public function getWeekDayRus(){
        $chose = 'page-nav__day_today page-nav__day_chosen ';
        $add = 0;
        $days = array(
        'Вс', 'Пн', 'Вт', 'Ср',
        'Чт', 'Пт', 'Сб'
        );
        
        $date = Carbon::now();
        $arr = [];
        

        for($i = 0; $i < 7; $i++) {
            $arr[$i] = [];
            $add = $i;

            $date->addDays($add);
            $myDayWeek = $date->format('w');
            $weekEnd = (($myDayWeek == 0) || ($myDayWeek == 6)) ? 'page-nav__day_weekend' : '';
            $timeStamp = $date->getTimeStamp();
        
            $result = array('day' => $date->format('j'),
            'dayWeek' => $days[$myDayWeek],
            'weekEnd' => $weekEnd,
            'timeStamp' => $timeStamp);
            array_push($arr[$i], $result);
            
        }
        return $arr;
    }     
}