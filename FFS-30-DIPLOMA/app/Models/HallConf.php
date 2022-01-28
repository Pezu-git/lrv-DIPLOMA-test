<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallConf extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'hall_id';
    public $incrementing = false;

    protected $fillable = [
        'hall_id', 'rows', 'cols'
    ];
}