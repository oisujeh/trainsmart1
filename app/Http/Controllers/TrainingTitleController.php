<?php

namespace App\Http\Controllers;

use App\Models\Directorate;
use App\Models\TrainingTitle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class TrainingTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $trainingTitle = TrainingTitle::with('training')->get();
        return view('titles.index', compact('trainingTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $directorates = Directorate::all();
        return view('titles.create')->with('directorates', $directorates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|unique:training_titles',
                'directorate_id' => 'required',
            ],
            [
                'unique'  => 'This title already exist, do not create another by changing the title.',
            ]
        );

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $title = TrainingTitle::create(
            [
                'title' => strip_tags($request->input('title')),
                'directorate_id' => strip_tags($request->input('directorate_id')),
            ]
        );

        $title->save();

        return redirect('titles')->with('success','Training Title Added');

    }

    /**
     * Display the specified resource.
     *
     * @param TrainingTitle $trainingTitle
     * @return void
     */
    public function show(TrainingTitle $trainingTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $directorates = Directorate::all();
        $trainingTitle = TrainingTitle::find($id);
        return view('titles.edit')->with('trainingTitle', $trainingTitle)->with('directorates', $directorates);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): Redirector|RedirectResponse|Application
    {
        $this->validate($request,[
            'title' => 'required|max:100',
            'directorate'=> 'required'
        ]);
        $obj = TrainingTitle::find($id);
        $obj->title = $request->title;
        $obj->directorate_id = $request->directorate;
        $obj->save();
        return redirect('titles')->with('success','Training Title Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($id): Redirector|RedirectResponse|Application
    {
        $trainingTitle = TrainingTitle::find($id);

        // Check if the record exists
        if (!$trainingTitle) {
            return back()->withErrors(['error' => 'Training Title not found']);
        }

        // Check if the title has related training instances
        if ($trainingTitle->training()->count()) {
            return back()->withErrors(['error' => 'Cannot Delete this contact your Admin']);
        }

        // Delete the title
        $trainingTitle->delete();

        return redirect('titles')->with('success', 'Training Title Deleted');
    }

}
