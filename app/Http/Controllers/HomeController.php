<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goal = TimeLog::getGoal();
        $minutes = TimeLog::getCurrentMonthSum();
        $currentProfit = number_format(($minutes/60)*41, 2);

        $now = Carbon::now();
        $endOfMonth = Carbon::now()->endOfMonth();

        $todo = $goal - $minutes;

        $daily = number_format($todo/($now->diffInDays($endOfMonth)),2);

        return view('home', compact([
            'goal', 'minutes', 'currentProfit', 'todo', 'daily'
        ]));
    }
}
