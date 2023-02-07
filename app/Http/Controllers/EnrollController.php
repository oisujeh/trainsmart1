<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Participant;
use App\Models\Training;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $list = DB::table('enroll_trainings')
            ->join('trainings','enroll_trainings.training_id','=','trainings.id')
            ->join('participants','enroll_trainings.participant_id','=','participants.id')
            ->join('directorates','trainings.directorate_id','=','directorates.id')
            ->join('training_titles','trainings.training_title_id','=','training_titles.id')
            ->select('enroll_trainings.id as id', 'participants.name as name','trainings.location as location',
                'trainings.venue as venue','directorates.name as directorate','training_titles.title as training',
                'trainings.start_date as start_date','trainings.end_date as end_date')
            ->get();

        return view ('enroll.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $trainings = Training::latest()->get();
        return view ('enroll.create',compact('trainings'));
    }

    public function search(Request $request){
        $participants = Participant::where('name','LIKE','%'.$request->input('term','').'%')
            ->get(['id','name as name']);
        return ['results' => $participants];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        foreach($request->input('participant_id') as $participant_id){
            $saveInfo = new Enroll();
            $saveInfo->participant_id = $participant_id;
            $saveInfo->training_id = $request->input('training_id');
            if(Enroll::where('participant_id','=',$saveInfo->participant_id)->where('training_id','=',$saveInfo->training_id)->exists()){
                return back()->withErrors('A participant from this is already added to this training.');
            }
            $saveInfo->save();
        }
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Enroll $cr
     * @return Response
     */
    public function show(enroll $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Enroll $cr
     * @return Response
     */
    public function edit(Enroll $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Enroll $cr
     * @return Response
     */
    public function update(Request $request, Enroll $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Enroll $cr
     * @return Response
     */
    public function destroy(enroll $cr)
    {
        //
    }

    public function getEmployees(Request $request): JsonResponse
    {
        $search = $request->search;
        if($search == ''){
            $participants = Participant::orderBy('name','asc')->select('id','name')->limit(10)->get();
        }else{
            $participants = Participant::orderBy('name','asc')->select('id','name')->where('name','like','%' .$search . '%')->limit(10)->get();
        }
        $response = array();
        foreach($participants as $participant){
            $response[] = array(
                "id" => $participant->id,
                "text" => $participant->name
            );
        }
        return response()->json($response);
    }
}
