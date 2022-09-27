<?php

namespace App\Http\Controllers;

use App\Models\InternationalFunding;
use App\Models\InternationalProgram;
use Illuminate\Http\Request;

class InternationalFundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:data-international');
    }
    public function index()
    {
        $internationalFundings = InternationalFunding::all();
        return view('pages.internationalFunding.index', compact('internationalFundings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.internationalFunding.create');
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

        InternationalFunding::create($data);
        session()->flash('success');
        return redirect(route('internationalFunding.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalFunding  $internationalFunding
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalFunding $internationalFunding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalFunding  $internationalFunding
     * @return \Illuminate\Http\Response
     */
    public function edit(InternationalFunding $internationalFunding)
    {
        return view('pages.internationalFunding.create', compact('internationalFunding'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalFunding  $internationalFunding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternationalFunding $internationalFunding)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $internationalFunding->update($data);
        session()->flash('success');
        return redirect(route('internationalFunding.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalFunding  $internationalFunding
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalFunding $internationalFunding)
    {
        $internationalFunding->delete();
        session()->flash('success');
        return back();
    }
}
