<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\HallConf;
use App\Models\MovieSchedule;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $halls = Hall::all();
        $movies = Movie::all();
        $hallConf = HallConf::all();
        View::share('movies', $movies);
        View::share('hallCon', $hallConf);
    }
}
