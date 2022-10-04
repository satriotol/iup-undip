<?php

namespace App\Http\Controllers;

use App\Models\BatchSemesterUserMahasiswa;
use Illuminate\Http\Request;

class BatchSemesterUserMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_mahasiswa_id)
    {
        // return $request->all();
        foreach ($request->all() as $r) {
            BatchSemesterUserMahasiswa::updateOrCreate(
                [
                    'user_mahasiswa_id' => $user_mahasiswa_id,
                    'batch_semester_id' => $r['id'],
                ],
                [
                    'semester_status_id' => $r['semester_status_id'],
                ],
            );
        }
    }
    public function updateStatus(Request $request, $batch_semester_user_mahasiswa)
    {
        $data = BatchSemesterUserMahasiswa::where('id', $batch_semester_user_mahasiswa)->first();
        $data->update([
            'semester_status_id' => $request->semester_status_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BatchSemesterUserMahasiswa  $batchSemesterUserMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(BatchSemesterUserMahasiswa $batchSemesterUserMahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BatchSemesterUserMahasiswa  $batchSemesterUserMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(BatchSemesterUserMahasiswa $batchSemesterUserMahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BatchSemesterUserMahasiswa  $batchSemesterUserMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BatchSemesterUserMahasiswa $batchSemesterUserMahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BatchSemesterUserMahasiswa  $batchSemesterUserMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatchSemesterUserMahasiswa $batchSemesterUserMahasiswa)
    {
        //
    }
}
