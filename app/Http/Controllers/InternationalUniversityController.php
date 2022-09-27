<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\InternationalUniversity;
use Illuminate\Http\Request;

class InternationalUniversityController extends Controller
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
        
        $internationalUniversities = InternationalUniversity::all();
        return view('pages.internationalUniversity.index', compact('internationalUniversities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('pages.internationalUniversity.create', compact('countries'));
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
            'country_id' => 'required',
        ]);

        InternationalUniversity::create($data);
        session()->flash('success');
        return redirect(route('internationalUniversity.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalUniversity  $internationalUniversity
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalUniversity $internationalUniversity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalUniversity  $internationalUniversity
     * @return \Illuminate\Http\Response
     */
    public function edit(InternationalUniversity $internationalUniversity)
    {
        $countries = Country::all();
        return view('pages.internationalUniversity.create', compact('countries', 'internationalUniversity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalUniversity  $internationalUniversity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternationalUniversity $internationalUniversity)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required',
        ]);

        $internationalUniversity->update($data);
        session()->flash('success');
        return redirect(route('internationalUniversity.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalUniversity  $internationalUniversity
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalUniversity $internationalUniversity)
    {
        $internationalUniversity->delete();
        session()->flash('success');
        return back();
    }
}
