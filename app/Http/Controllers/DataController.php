<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(): Factory|View|Application
    {
        $participants = DB::table('enroll_trainings')->distinct()->select('participant_id')->get();
        $trainings = DB::table('trainings')->get();

        $future_trainings = DB::table('trainings as t')
            ->select('p.name as directorate','tt.title as training','t.start_date as start_date',
                't.end_date as end_date','t.location as location','t.method as method')
            ->join('directorates as p', 't.directorate_id','=','p.id')
            ->join('training_titles as tt','t.training_title_id','=','tt.id')
            ->where('t.start_date','>',Carbon::now())->get();

        return view('/dashboard', compact('participants','trainings','future_trainings'));
        //dd($future_trainings);
    }
}
