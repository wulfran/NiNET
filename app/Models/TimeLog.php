<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    const GOAL = 3000;

    protected $fillable = ['minutes', 'notes', 'date'];

    protected $dates = ['date'];

    public $timestamps = false;

    public static function getFileName()
    {
        return 'work_time_' . Carbon::now()->weekOfMonth . '_' . Carbon::now();
    }

    public static function getCurrentMonthSum()
    {
        $timeLog = TimeLog::query()
            ->select()
            ->whereBetween('date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
            ->get();
        return $timeLog->sum('minutes');
    }

    public static function getGoal()
    {
        return self::GOAL;
    }

}
