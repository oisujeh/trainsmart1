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
use Illuminate\Validation\ValidationException;

class TrainingTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
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
     * @throws ValidationException
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $this->validate($request,[
            'title' => 'required|max:100',
            'directorate'=> 'required'
        ]);
        $obj = new TrainingTitle();
        $obj->title = $request->title;
        $obj->directorate_id = $request->directorate;
        $obj->save();
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
        if($trainingTitle->training()->count()){
            return back()->with('error','Cannot Delete this contact your Admin');
        }
        $trainingTitle->delete();
        return redirect('titles')->with('success','Training Title Deleted');
    }
}
