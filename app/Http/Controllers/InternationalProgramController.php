<?php

namespace App\Http\Controllers;

use App\Models\InternationalProgram;
use Illuminate\Http\Request;

class InternationalProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $internationalPrograms = InternationalProgram::all();
        return view('pages.internationalProgram.index', compact('internationalPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.internationalProgram.create');
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
        ]);

        InternationalProgram::create($data);
        session()->flash('success');
        return redirect(route('internationalProgram.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalProgram  $internationalProgram
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalProgram $internationalProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalProgram  $internationalProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(InternationalProgram $internationalProgram)
    {
        return view('pages.internationalProgram.create', compact('internationalProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalProgram  $internationalProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternationalProgram $internationalProgram)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);
        $internationalProgram->update($data);
        session()->flash('success');
        return redirect(route('internationalProgram.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalProgram  $internationalProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalProgram $internationalProgram)
    {
        $internationalProgram->delete();
        session()->flash('success');
        return redirect(route('internationalProgram.index'));
    }
}
