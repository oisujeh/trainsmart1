<?php

namespace App\Http\Controllers;

use App\Models\Directorate;
use App\Models\Institution;
use App\Models\Participant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Exceptions\Exception;

class ParticipantController extends Controller
{

    public function index(Request $request): Factory|View|Application
    {
        /*auth()->user()->assignRole('owner');*/

        /*$role = Role::create(['name'=>'admin']);*/
        /*Permission::create(['name'=>'can view']);*/
        /*$role = Role::findById(1);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);*/
        return view('participants.index');
    }

    /**
     * @throws \Exception
     */
    public function fetch(Request $request): void
    {
        $ola = Participant::count();
        $col_order = ['name','email','sex','phone'];
        $total_data = $ola;
        $limit = $request->input(key:'length');
        $start = $request->input(key:'start');
        $order = $col_order[$request->input(key:'order.0.column')];
        $dir = $request->input(key:'order.0.dir');

        if(empty($request->input(key:'search.value'))){
            $post = Participant::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $total_filtered = $ola;
        }else{
            $search = $request->input(key:'search.value');
            $post = Participant::where('name','like',"%{$search}")
                ->orwhere('email','like',"%{$search}")
                ->orwhere('sex','like',"%{$search}")
                ->orwhere('phone','like',"%{$search}")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $total_filtered = Participant::where('name','like',"%{$search}")
                ->orwhere('email','like',"%{$search}")
                ->orwhere('sex','like',"%{$search}")
                ->orwhere('phone','like',"%{$search}")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->count();
        }

        $data = array();
        if($post){
            foreach ($post as $row){
                $show = route('participants.show',$row->id);
                $edit = route('participants.edit',$row->id);
                $nest['id'] = $row->id;
                $nest['name'] = $row->name;
                $nest['email'] = $row->email;
                $nest['sex'] = $row->sex;
                $nest['phone'] = $row->phone;
                $nest['facility_name'] = $row->institution->facility_name;
                $nest['Action'] = "<div class='flex justify-end items-center md:py-1 px-1'>
                                  <td class='pt-1 py-1 px-1'>
                                  <a href='$show' class='button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                        <i class='uil uil-eye'></i>
                                     </a>
                                  <a href='$edit' class='button bg-brightGreenLight hover:bg-green-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                        <i class='uil uil-edit'></i>
                                     </a>
                                    </td></div>";
                $data[] = $nest;
            }
        }
        $json = array(
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($total_data),
            'recordsFiltered' => intval($total_filtered),
            'data' => $data
        );
        echo json_encode($json);
    }


    public function create(): View|Factory|Application
    {
        $institutions = Institution::all();
        $directorates = Directorate::all();
        return view('participants.create',compact('institutions','directorates'));
    }

    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:participants',
               /* 'phone' => 'required|numeric|digits:11|starts_with:0|unique:participants',*/
                'phone' => ['required','unique:participants','regex:/^((\+234)|0)[789]\d{9}$/'],
                'sex' =>    'required',
                'institution_id' => 'required',
                'directorate_id' => 'required',
                'designation'   => 'required',
            ],
            [
                'unique'  => 'Participant already exist.',
                /*'digits' => 'Phone number more than 11 digits',*/
                'regex' => 'The phone number is not valid',
            ]
        );

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $participant = Participant::create(
            [
                'name' => strip_tags($request->input('name')),
                'email' => $request->input('email'),
                'phone' => strip_tags($request->input('phone')),
                'sex' =>    strip_tags($request->input('sex')),
                'institution_id' => strip_tags($request->input('institution_id')),
                'directorate_id' => strip_tags($request->input('directorate_id')),
                'category' => strip_tags($request->input('category')),
                'designation'   => strip_tags($request->input('designation')),
                'photo_consent'   => strip_tags($request->input('photo_consent')),
                /*'category' => strip_tags($request->input('category')),*/
            ]
        );
        $participant->save();
        return redirect('participants')->with('success', 'Successfully added');
    }

    public function show($id): Factory|View|Application
    {
        $participant = DB::table('participants')
            ->join('institutions', 'participants.institution_id', '=', 'institutions.id')
            ->select(array('participants.name as name','participants.sex as sex','participants.email as email',
                'participants.designation as designation', 'institutions.facility_name as facility_name'))
            ->where('participants.id', $id);

        $participantTitles = DB::table('participants')
            ->join('enroll_trainings', 'enroll_trainings.participant_id', '=', 'participants.id')
            ->join('trainings', 'enroll_trainings.training_id', '=', 'trainings.id')
            ->join('training_titles', 'trainings.training_title_id', '=', 'training_titles.id')
            ->where('participant_id', $id)
            ->select('training_titles.title','trainings.start_date')
            ->get();

        // Get the first participant from the collection
        $participant = $participant->first();

        //dd($participant);
        return view('participants.show', compact('participant', 'participantTitles'));
    }

    public function edit($id): Factory|View|Application
    {
        $participant = Participant::find($id);
        $selectedInstitution = Institution::first()->insitution_id;
        $institutions = Institution::all();
        return view('participants.edit', compact('participant', 'institutions','selectedInstitution'));
    }


    public function update(Request $request, Participant $participant): Redirector|Application|RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:participants',
                'phone' => ['required','unique:participants','regex:/^((\+234)|0)[789]\d{9}$/'],
                'sex' =>    'required',
                'institution_id' => 'required',
                'directorate_id' => 'required',
                'designation'   => 'required',
            ],
            [
                'unique'  => 'Participant already exist.',
                'regex' => 'The phone number is not valid',
            ]
        );

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $participant->name = strip_tags($request->input('name'));
        $participant->email = $request->input('email');
        $participant->phone = strip_tags($request->input('phone'));
        $participant->sex =    strip_tags($request->input('sex'));
        $participant->institution_id = strip_tags($request->input('institution_id'));
        $participant->directorate_id = strip_tags($request->input('directorate_id'));
        $participant->designation   = strip_tags($request->input('designation'));
        $participant->photo_consent  = strip_tags($request->input('photo_consent'));
        /*$participant->name = strip_tags($request->input('category')),*/

        $participant->update();

        return redirect('participants')->with('success', 'Successfully updated');
    }

    public function destroy(Participant $participant): RedirectResponse
    {
        /*if($participant->enroll()->count()){
            return back()->with('error', 'Cannot delete this person, because he/she has records');
        }*/
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Record deleted successfully');
    }

    public function getInstitutions(Request $request): JsonResponse
    {
        $search = $request->search;
        if($search == ''){
            $institutions = Institution::orderby('facility_name', 'asc')->select('id','facility_name')->limit(10)->get();
        }else{
            $institutions = Institution::orderby('facility_name', 'asc')->select('id','facility_name')
                ->where('facility_name','like', '%'.$search.'%')->limit(10)->get();
        }
        $response = array();
        foreach($institutions as $inst){
            $response[] = array(
                "id"=>$inst->id,
                "text"=>$inst->facility_name
            );
        }
        return response()->json($response);
    }
}
