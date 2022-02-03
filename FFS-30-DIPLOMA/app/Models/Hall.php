<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function seances()
    {
        return $this->hasMany(\App\Models\MovieSchedule::class);
    }

}