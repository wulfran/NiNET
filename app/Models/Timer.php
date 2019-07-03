<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start', 'end', 'user_id', 'notes'
    ];

    protected $casts = [
        'start' => 'date:hh:mm',
        'end' => 'date:hh:mm'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }


}
