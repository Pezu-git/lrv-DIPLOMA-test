<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallConf extends Model
{
    use HasFactory;
    public $timestamps = false;

    // protected $fillable = [
    //     'rows', 'cols'
    // ];
    protected $casts = [
        'rows' => 'int', 
        'cols' => 'int',
    ];
    
}