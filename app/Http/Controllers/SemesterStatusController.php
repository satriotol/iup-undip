<?php

namespace App\Http\Controllers;

use App\Models\SemesterStatus;
use Illuminate\Http\Request;

class SemesterStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesterStatuses = SemesterStatus::all();
        return view('pages.semesterStatus.index', compact('semesterStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.semesterStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);

        SemesterStatus::create($data);
        session()->flash('success');
        return redirect(route('semesterStatus.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SemesterStatus  $semesterStatus
     * @return \Illuminate\Http\Response
     */
    public function show(SemesterStatus $semesterStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SemesterStatus  $semesterStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(SemesterStatus $semesterStatus)
    {
        return view('pages.semesterStatus.create', compact('semesterStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SemesterStatus  $semesterStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SemesterStatus $semesterStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);
        $semesterStatus->update($data);
        session()->flash('success');
        return redirect(route('semesterStatus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SemesterStatus  $semesterStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(SemesterStatus $semesterStatus)
    {
        $semesterStatus->delete();
        session()->flash('success');
        return back();
    }
}
