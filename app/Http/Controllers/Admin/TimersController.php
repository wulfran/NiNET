<?php

namespace App\Http\Controllers\Admin;

use App\Forms\TimerForm;
use App\Models\TimeLog;
use App\Models\Timer;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class TimersController extends Controller
{
    use FormBuilderTrait;

    private function getForm($model)
    {
        $url = $model->id ? route("admin.timers.update", $model) : route('admin.timers.create');
        $form = $this->form(TimerForm::class,[
            'url' => $url,
            'method' => 'POST',
            'model' => $model
        ]);

        return $form;
    }

    protected function buildActions($model)
    {
        $edit = '<a href="' . route('admin.timers.edit', $model) . '" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i></a>';
        $delete = '<a style="margin-left:10px;" href="' . route('admin.timers.delete', $model) . '" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>';
        return $edit . $delete;
    }

    protected function buildTable($data)
    {
        $html = '<thead><th>ID</th><th>Start</th><th>End</th><th>User</th><th>Akcja</th></thead><tbody>';
        if($data){
            foreach($data as $row){
                $actions = $this->buildActions($row);
                $html = $html . "<tr><td>$row->id</td><td>$row->start</td><td>$row->end</td><td>" . $row->user->email . "</td><td>$actions</td></tr>";
                unset($actions);
            }
        }
        $html = $html . '</tbody>';
        return $html;
    }

    public function getIndex()
    {
//        $timers = TimeLog::all();
//        $table = $this->buildTable($timers);

        $heading = 'Czasy';

        return view('admin.timelogs.list');

    }

    public function getEdit(Timer $timer)
    {
        $title = 'Edycja czasu';

        $form = $this->getForm($timer);

        return view('admin.timers.edit', compact([
            'title', 'form'
        ]));
    }

    public function postSave(Timer $timer)
    {
        //TODO::przebudować

        $timer->notes = request()->input('notes');

        $timer->save();

        return redirect(route('admin.timers.list'));

    }

    public function postDelete(Timer $timer)
    {
        $timer->delete();

        return redirect(route('admin.timers.list'));
    }

    public function toggle()
    {
        $user = auth()->user();
        if($user->timers->count() > 0){
            $now = Carbon::now();
            $timer = $user->timers->last();
            $minutes = $now->diffInMinutes($timer->start);

            return redirect()->back();
        } else {
            $timer = new Timer();
            $timer->start = Carbon::now();
            $timer->user_id = auth()->user()->id;
            $timer->save();
            return redirect()->back();
        }
    }

    public function postProcess()
    {
        $now = Carbon::now();
        $timer = auth()->user()->timers->last();
        
        TimeLog::create([
            'minutes' => $now->diffInMinutes($timer->start),
            'date' => $now,
            'notes' => request()->input('notes')
        ]);

        $timer->delete();

        return redirect()->back();
    }

    public function printTimers()
    {
        $logs = TimeLog::query()
            ->select()
            ->whereBetween('date', [
                request()->input('start'),
                request()->input('end')
            ])->get();

        if(is_null($logs) || $logs->count() == 0){
            return false;
        }

        $summary = 0;

        $pdf = PDF::loadView('documents.timers', compact('logs'))
            ->setPaper('a4', 'portrait');

        $filename = TimeLog::getFileName();

        return $pdf->stream($filename);
    }
}
