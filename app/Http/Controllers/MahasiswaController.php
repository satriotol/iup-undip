<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Country;
use App\Models\MahasiswaSemester;
use App\Models\Major;
use App\Models\Semester;
use App\Models\SemesterStatus;
use App\Models\User;
use App\Models\UserMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Spatie\Permission\Models\Role;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::all();
        $semesterStatuses = SemesterStatus::all();
        $mahasiswas = User::has('user_mahasiswa')->paginate(5);
        return view('pages.mahasiswa.index', compact('mahasiswas', 'semesters', 'semesterStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = User::GENDER;
        $batches = Batch::orderBy('year')->get();
        $majors = Major::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('pages.mahasiswa.create', compact('batches', 'majors', 'countries', 'genders'));
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
            'email' => 'required|unique:users,email',
            'batch_id' => 'required',
            'major_id' => 'required',
            'country_id' => 'required',
            'nim' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'password' => 'nullable',
        ]);
        $data['password'] = Hash::make($data['nim']);
        $user = User::create($data);
        $data['user_id'] = $user->id;
        $role = Role::where('name', 'MAHASISWA')->first()->id;
        $user->assignRole($role);
        UserMahasiswa::create($data);
        session()->flash('success');
        return redirect(route('mahasiswa.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $mahasiswa)
    {
        $genders = User::GENDER;
        $batches = Batch::orderBy('year')->get();
        $majors = Major::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('pages.mahasiswa.create', compact('mahasiswa', 'genders', 'batches', 'majors', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $mahasiswa)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $mahasiswa->id,
            'batch_id' => 'required',
            'major_id' => 'required',
            'country_id' => 'required',
            'nim' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ]);
        $mahasiswa->update($data);
        $mahasiswa->user_mahasiswa->update($data);
        session()->flash('success');
        return redirect(route('mahasiswa.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();
        $mahasiswa->user_mahasiswa()->delete();
        session()->flash('success');
        return back();
    }
    public function assignSemester(Request $request, $userMahasiswa)
    {
        $data = $this->validate($request, [
            'user_mahasiswa_id' => 'nullable',
            'semester_id' => 'required',
            'semester_status_id' => 'required',
        ]);
        $data['user_mahasiswa_id'] = $userMahasiswa;
        MahasiswaSemester::create($data);
        session()->flash('success');
        return back();
    }
    public function destroySemester(MahasiswaSemester $mahasiswaSemester)
    {
        $mahasiswaSemester->delete();
        session()->flash('success');
        return back();
    }
}
