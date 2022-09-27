<?php

namespace App\Http\Controllers;

use App\Models\InternationalCategory;
use Illuminate\Http\Request;

class InternationalCategoryController extends Controller
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
        $internationalCategories = InternationalCategory::all();
        return view('pages.internationalCategory.index', compact('internationalCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.internationalCategory.create');
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

        InternationalCategory::create($data);
        session()->flash('success');
        return redirect(route('internationalCategory.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternationalCategory  $internationalCategory
     * @return \Illuminate\Http\Response
     */
    public function show(InternationalCategory $internationalCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternationalCategory  $internationalCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(InternationalCategory $internationalCategory)
    {
        return view('pages.internationalCategory.create', compact('internationalCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternationalCategory  $internationalCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternationalCategory $internationalCategory)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);
        $internationalCategory->update($data);
        session()->flash('success');
        return redirect(route('internationalCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternationalCategory  $internationalCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternationalCategory $internationalCategory)
    {
        $internationalCategory->delete();
        session()->flash('success');
        return back();
    }
}
