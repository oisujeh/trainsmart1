<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function counting(): Factory|View|Application
    {
        $participants = DB::table('enroll_trainings')->distinct()->select('participant_id')->get();

        return view('/dashboard',compact('participants'));
    }
}
