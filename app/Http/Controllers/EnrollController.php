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
        $alreadyEnrolledParticipants = [];

        $list = DB::table('enroll_trainings')
            ->join('trainings','enroll_trainings.training_id','=','trainings.id')
            ->join('participants','enroll_trainings.participant_id','=','participants.id')
            ->join('directorates','trainings.directorate_id','=','directorates.id')
            ->join('training_titles','trainings.training_title_id','=','training_titles.id')
            ->select('enroll_trainings.id as id', 'participants.name as name','trainings.location as location',
                'trainings.venue as venue','directorates.name as directorate','training_titles.title as training',
                'trainings.start_date as start_date','trainings.end_date as end_date')
            ->get();

        return view ('enroll.index',compact('list','alreadyEnrolledParticipants'));
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
     * @return Application
     */
    public function store(Request $request)
    {
        $alreadyEnrolledParticipants = [];
        $list = DB::table('enroll_trainings')
            ->join('trainings','enroll_trainings.training_id','=','trainings.id')
            ->join('participants','enroll_trainings.participant_id','=','participants.id')
            ->join('directorates','trainings.directorate_id','=','directorates.id')
            ->join('training_titles','trainings.training_title_id','=','training_titles.id')
            ->select('enroll_trainings.id as id', 'participants.name as name','trainings.location as location',
                'trainings.venue as venue','directorates.name as directorate','training_titles.title as training',
                'trainings.start_date as start_date','trainings.end_date as end_date')
            ->get();

        foreach ($request->input('participant_id') as $participant_id) {
            $saveInfo = new Enroll();
            $saveInfo->participant_id = $participant_id;
            $saveInfo->training_id = $request->input('training_id');

            if (Enroll::where('participant_id', $saveInfo->participant_id)
                ->where('training_id', $saveInfo->training_id)
                ->exists()) {
                $participant = Participant::find($participant_id); // Assuming there's a Participant model

                if ($participant) {
                    $alreadyEnrolledParticipants[] = $participant;
                }

                continue; // Skip saving the enrollment
            }

            $saveInfo->save();
        }

        return view('enroll.index', ['alreadyEnrolledParticipants' => $alreadyEnrolledParticipants, 'list' => $list]);
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

    public function fetch(Request $request)
    {
        $query = DB::table('enroll_trainings')
            ->join('trainings', 'enroll_trainings.training_id', '=', 'trainings.id')
            ->join('participants', 'enroll_trainings.participant_id', '=', 'participants.id')
            ->join('directorates', 'trainings.directorate_id', '=', 'directorates.id')
            ->join('training_titles', 'trainings.training_title_id', '=', 'training_titles.id')
            ->select(
                'enroll_trainings.id as id',
                'participants.name as name',
                'trainings.location as location',
                'trainings.venue as venue',
                'directorates.name as directorate',
                'training_titles.title as training',
                'trainings.start_date as start_date',
                'trainings.end_date as end_date'
            );

        $total_data = $query->count();
        $col_order = ['name', 'location', 'directorate', 'training', 'start_date', 'end_date'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $col_order[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('participants.name', 'like', "%{$search}%")
                ->orWhere('trainings.location', 'like', "%{$search}%")
                ->orWhere('directorates.name', 'like', "%{$search}%")
                ->orWhere('training_titles.title', 'like', "%{$search}%")
                ->orWhere('trainings.start_date', 'like', "%{$search}%")
                ->orWhere('trainings.end_date', 'like', "%{$search}%");
        }

        $total_filtered = $query->count();
        $post = $query->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = [];
        foreach ($post as $row) {
            $show = route('participants.show', $row->id);
            $edit = route('participants.edit', $row->id);
            $nest['id'] = $row->id;
            $nest['name'] = $row->name;
            $nest['location'] = $row->location;
           /* $nest['venue'] = $row->venue;*/
            $nest['directorate'] = $row->directorate;
            $nest['training'] = $row->training;
            $nest['start_date'] = $row->start_date;
            $nest['end_date'] = $row->end_date;
            $nest['Action'] = "<div class='flex justify-end items-center md:py-1 px-1'>
                            <td class='pt-1 py-1 px-1'>
                                <a href='$show' class='button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                    <i class='uil uil-eye'></i>
                                </a>
                                <a href='$edit' class='button bg-brightGreenLight hover:bg-green-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                    <i class='uil uil-edit'></i>
                                </a>
                            </td>
                        </div>";
            $data[] = $nest;
        }

        $json = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($total_data),
            'recordsFiltered' => intval($total_filtered),
            'data' => $data
        ];

        echo json_encode($json);
    }

}
