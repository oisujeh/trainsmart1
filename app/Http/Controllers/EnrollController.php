<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Participant;
use App\Models\Training;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        $enroll = Enroll::firstOrCreate(array('participant_id' => $request['participant_id'],'training_id' => $request['training_id']));
        return view('enroll.index',compact('enroll'));
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
}
