<?php

namespace App\Http\Controllers;

use App\Models\InternationalStatus;
use Illuminate\Http\Request;

class InternationalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $internationalStatuses = InternationalStatus::all();
        return view('pages.internationalStatus.index', compact('internationalStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.internationalStatus.create');
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

        InternationalStatus::create($data);
        session()->flash('success');
        return redirect(route('internationalStatus.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalStatus  $internationalStatus
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalStatus $internationalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalStatus  $internationalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(InternationalStatus $internationalStatus)
    {
        return view('pages.internationalStatus.create', compact('internationalStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalStatus  $internationalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternationalStatus $internationalStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);

        InternationalStatus::create($data);
        session()->flash('success');
        return redirect(route('internationalStatus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalStatus  $internationalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalStatus $internationalStatus)
    {
        //
    }
}
