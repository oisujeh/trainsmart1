<?php

namespace App\Http\Controllers;

use App\Models\TrainingTitle;
use Illuminate\Http\Request;

class SubController extends Controller
{
    public function index(){
        $titles = TrainingTitle::whereHas('directorate',function($query){
            $query->whereId(request()->input('directorate_id', 0));
        })->pluck('name','id');

        return response()->json($titles);
    }

}
