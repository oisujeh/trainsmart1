<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('trainings.index',compact('training'));
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
        try{
            $training = Training::firstOrCreate(
                [
                    'training_title_id' => strip_tags($request->input('training_title_id')),
                    'directorate_id' => strip_tags($request->input('directorate_id')),
                    'location'   => strip_tags($request->input('location')),
                    'venue'   => strip_tags($request->input('venue')),
                    'method'   => strip_tags($request->input('method')),
                    'start_date' => strip_tags($request->input('start_date')),
                    'end_date' => strip_tags($request->input('end_date')),
                ]
                ,[
                    'training_title_id' => strip_tags($request->input('training_title_id')),
                    'directorate_id' => strip_tags($request->input('directorate_id')),
                    'location'   => strip_tags($request->input('location')),
                    'venue'   => strip_tags($request->input('venue')),
                    'method'   => strip_tags($request->input('method')),
                    'start_date' => strip_tags($request->input('start_date')),
                    'end_date' => strip_tags($request->input('end_date')),
                ]
            );
            $training->save();
        }catch (\Exception $e){
            return back()->withErrors('This training has already been added. Contact your administrator');
        }



        return redirect('trainings')->with('success','Created');
    }

    /**
     * Display the specified resource.
     *
     * @param Training $training
     * @return Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Training $training
     * @return Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Training $training
     * @return Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Training $training
     * @return Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
