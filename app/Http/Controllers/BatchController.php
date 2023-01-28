<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchSemester;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:data-mahasiswa');
    }
    public function index()
    {
        $batchs = batch::getBatches()->get();
        return view('pages.batch.index', compact('batchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.batch.create');
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
            'year' => 'required|digits:4|integer|min:1900',
            'batch.*.year' => 'required',
            'batch.*.semester' => 'required',
        ]);
        $batch = Batch::create($data);
        foreach ($request->batch as $key) {
            BatchSemester::create([
                'batch_id' => $batch->id,
                'year' => $key['year'],
                'semester' => $key['semester']
            ]);
        }
        session()->flash('success');
        return redirect(route('batch.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        return view('pages.batch.show',compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        return view('pages.batch.create', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $data = $this->validate($request, [
            'year' => 'required|digits:4|integer|min:1900',
        ]);

        $batch->update($data);
        session()->flash('success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();
        session()->flash('success');
        return back();
    }
}
