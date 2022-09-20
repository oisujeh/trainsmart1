<?php

namespace App\Http\Controllers;

use App\Models\Directorate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class DirectorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $directorate = Directorate::all();
        return view ('directorate.index',compact('directorate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $directorate = Directorate::all();
        return view ('directorate.create');
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
                'name' => 'required|max:255|unique:directorates'
            ],
            [
                'unique'  => 'Directorate name already exist.',
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $directorate = Directorate::create([
            'name' => strip_tags($request->input('name'))
        ]);

        $directorate->save();
        return redirect()->route('directorate.index')->with('success', 'Directorate Added');
    }

    /**
     * Display the specified resource.
     *
     * @param Directorate $directorate
     * @return Response
     */
    public function show(Directorate $directorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Directorate $directorate
     * @return Application|Factory|View
     */
    public function edit(Directorate $directorate): View|Factory|Application
    {
        return view('directorate.edit', compact('directorate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Directorate $directorate
     * @return RedirectResponse
     */
    public function update(Request $request, Directorate $directorate): RedirectResponse
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),
            [
                'name' => 'required|unique:directorates',
            ],
            [
                'unique'  => 'Participant already exist.',
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $directorate->name = strip_tags($request->input('name'));
        $directorate->update();
        return redirect('directorate')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Directorate $directorate
     * @return RedirectResponse
     */
    public function destroy(Directorate $directorate)
    {
        /*if($directorate->trainingprograms1()->count()){
            return back()->with('error','Cannot Delete this directorates');
        }
        $directorate->delete();
        return redirect()->route('directorate.index')->with('success', 'Deleted successfully');*/
        $directorate->delete();
        return redirect()->route('directorate.index')->with('success', 'Deleted successfully');
    }
}
