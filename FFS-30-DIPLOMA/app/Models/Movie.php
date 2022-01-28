<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title', 'duration'
    ];

    public function seances()
    {
        return $this->hasMany(\App\Models\MovieSchedule::class);
    }
}