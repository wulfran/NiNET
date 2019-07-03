<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    protected $fillable = ['minutes', 'notes', 'date'];

    protected $dates = ['date'];

    public $timestamps = false;

    public static function getFileName()
    {
        return 'work_time_' . Carbon::now()->weekOfMonth . '_' . Carbon::now();
    }
}
