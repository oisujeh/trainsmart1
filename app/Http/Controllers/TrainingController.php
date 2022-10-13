<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $training = Training::all();
        return view('training.index',compact('training'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $directorate = DB::table('directorates')->get();
        return view('trainings.create', compact('directorate'));
    }

    public function submain($id)
    {
        echo json_encode(DB::table('training_titles')->where('directorate_id',$id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'training_title_id' => 'required',
                'directorate_id' => 'required',
                'location' => 'required',
                'venue' => 'required',
                'method' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',

            ],
            [
                'end_date.after' => 'End Date cannot be before start date',
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $training = Training::create(
            [
                'training_title_id' => strip_tags($request->input('training_title_id')),
                'directorate_id' => strip_tags($request->input('directorate_id')),
                'location'   => strip_tags($request->input('location')),
                'venue'   => strip_tags($request->input('venue')),
                'method'   => strip_tags($request->input('method')),
                'start_date' => strip_tags($request->input('start_date')),
                'end_date' => strip_tags($request->input('end_date')),
            ]
        );

        if(Training::where('training_title_id','=',$training->training_title_id)
            ->where('directorate_id','=',$training->directorate_id)
            ->where('location','=',$training->location)
            ->where('start_date','=',$training->start_date)
            ->where('end_date','=',$training->end_date)
            ->exists()){

            return back()->withErrors('This training has already been added. Contact your administrator');
        }

        $training->save();

        return redirect('trainings')->with('success','Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
