<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchSemester;
use Illuminate\Http\Request;

class BatchSemesterController extends Controller
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
    public function create(Batch $batch)
    {
        return view('pages.batchSemester.create', compact('batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $batch)
    {
        $data = $this->validate($request, [
            'batch.*.year' => 'required',
            'batch.*.semester' => 'required',
        ]);
        foreach ($request->batch as $key) {
            BatchSemester::create([
                'batch_id' => $batch,
                'year' => $key['year'],
                'semester' => $key['semester']
            ]);
        }
        session()->flash('success');
        return redirect(route('batch.show', $batch));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BatchSemester  $batchSemester
     * @return \Illuminate\Http\Response
     */
    public function show(BatchSemester $batchSemester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BatchSemester  $batchSemester
     * @return \Illuminate\Http\Response
     */
    public function edit(BatchSemester $batchSemester, Batch $batch)
    {
        return view('pages.batchSemester.create', compact('batchSemester', 'batch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BatchSemester  $batchSemester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BatchSemester $batchSemester, $batch)
    {
        $data = $this->validate($request, [
            'year' => 'required',
            'semester' => 'required',
        ]);
        $batchSemester->update($data);
        session()->flash('success');
        return redirect(route('batch.show', $batch));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BatchSemester  $batchSemester
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatchSemester $batchSemester)
    {
        $batchSemester->delete();
        session()->flash('success');
        return back();
    }
}
