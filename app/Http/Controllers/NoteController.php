<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\UserMahasiswa;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_mahasiswa_id)
    {
        $note = Note::where('user_mahasiswa_id', $user_mahasiswa_id)->get();
        return response()->json($note);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'test_date' => 'nullable',
            'listening' => 'nullable',
            'reading' => 'nullable',
            'writing' => 'nullable',
            'speaking' => 'nullable',
            'overall_score' => 'nullable',
            'event_1' => 'nullable',
            'event_2' => 'nullable',
            'achievement' => 'nullable',
            'other_information' => 'nullable'
        ]);
        $data['user_mahasiswa_id'] = $user_mahasiswa_id;
        Note::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit($user_mahasiswa_id, Note $note)
    {
        return view('pages.note.create', compact('user_mahasiswa_id', 'note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_mahasiswa_id, Note $note)
    {
        $userId = UserMahasiswa::find($user_mahasiswa_id)->first();
        $data = $this->validate($request, [
            'test_date' => 'nullable',
            'listening' => 'nullable',
            'reading' => 'nullable',
            'writing' => 'nullable',
            'speaking' => 'nullable',
            'overall_score' => 'nullable',
            'event_1' => 'nullable',
            'event_2' => 'nullable',
            'achievement' => 'nullable',
            'other_information' => 'nullable'
        ]);
        $note->update($data);
        session()->flash('success');
        return redirect(route('mahasiswa.show', $userId->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
    }
}
