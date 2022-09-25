<?php

namespace App\Http\Controllers;

use App\Models\InternationalCategory;
use App\Models\InternationalFunding;
use App\Models\InternationalMahasiswa;
use App\Models\InternationalProgram;
use App\Models\InternationalStatus;
use App\Models\InternationalUniversity;
use Illuminate\Http\Request;

class InternationalMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_mahasiswa_id)
    {
        $internationalMahasiswas = InternationalMahasiswa::where('user_mahasiswa_id', $user_mahasiswa_id)->get();
        return response()->json($internationalMahasiswas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_mahasiswa_id)
    {
        $internationalStatuses = InternationalStatus::all();
        $internationalCategories = InternationalCategory::all();
        $internationalUniversities = InternationalUniversity::all();
        $internationalPrograms = InternationalProgram::all();
        $internationalFundings = InternationalFunding::all();
        return view('pages.internationalMahasiswa.create', compact('user_mahasiswa_id', 'internationalStatuses', 'internationalCategories', 'internationalUniversities', 'internationalPrograms', 'internationalFundings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_mahasiswa_id)
    {
        $data = $this->validate($request, [
            'international_status_id' => 'required',
            'international_category_id' => 'required',
            'international_university_id' => 'required',
            'international_program_id' => 'required',
            'international_funding_id' => 'required',
            'duration' => 'required',
            'year' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);
        $data['user_mahasiswa_id'] = $user_mahasiswa_id;
        InternationalMahasiswa::create($data);
        session()->flash('success');
        return redirect(route('mahasiswa.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalMahasiswa  $internationalMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalMahasiswa $internationalMahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalMahasiswa  $internationalMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($user_mahasiswa_id, InternationalMahasiswa $internationalMahasiswa)
    {
        $internationalStatuses = InternationalStatus::all();
        $internationalCategories = InternationalCategory::all();
        $internationalUniversities = InternationalUniversity::all();
        $internationalPrograms = InternationalProgram::all();
        $internationalFundings = InternationalFunding::all();
        return view('pages.internationalMahasiswa.create', compact('user_mahasiswa_id', 'internationalMahasiswa', 'internationalStatuses', 'internationalCategories', 'internationalUniversities', 'internationalPrograms', 'internationalFundings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalMahasiswa  $internationalMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_mahasiswa_id, InternationalMahasiswa $internationalMahasiswa)
    {
        $data = $this->validate($request, [
            'international_status_id' => 'required',
            'international_category_id' => 'required',
            'international_university_id' => 'required',
            'international_program_id' => 'required',
            'international_funding_id' => 'required',
            'duration' => 'required',
            'year' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);
        $data['user_mahasiswa_id'] = $user_mahasiswa_id;
        $internationalMahasiswa->update($data);
        session()->flash('success');
        return redirect(route('mahasiswa.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalMahasiswa  $internationalMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalMahasiswa $internationalMahasiswa)
    {
        $internationalMahasiswa->delete();
        return response()->json($internationalMahasiswa);
    }
}
