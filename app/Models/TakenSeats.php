<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakenSeats extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hall_id',
        'seance_id',
        'row_num',
        'seat_num',
        'taken'
    ];
}
