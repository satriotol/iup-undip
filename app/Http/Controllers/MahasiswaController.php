<?php

namespace App\Http\Controllers;

use App\Http\Resources\BatchSemesterCollection;
use App\Http\Resources\BatchSemesterResource;
use App\Models\Batch;
use App\Models\BatchSemester;
use App\Models\BatchSemesterUserMahasiswa;
use App\Models\Country;
use App\Models\InternationalCategory;
use App\Models\InternationalFunding;
use App\Models\InternationalProgram;
use App\Models\InternationalStatus;
use App\Models\InternationalUniversity;
use App\Models\MahasiswaSemester;
use App\Models\Major;
use App\Models\Semester;
use App\Models\SemesterStatus;
use App\Models\User;
use App\Models\UserMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'photo' => 'nullable',

        ]);
        $data['password'] = Hash::make($data['nim']);
        $user = User::create($data);
        $data['user_id'] = $user->id;
        $role = Role::where('name', 'MAHASISWA')->first()->id;
        $user->assignRole($role);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $file = $file->storeAs('file', $file_name, 'public_uploads');
            $data['photo'] = $file;
        };
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
    public function show(User $mahasiswa)
    {
        $genders = User::GENDER;
        $batches = Batch::orderBy('year')->get();
        $majors = Major::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $semesters = Semester::all();
        $semesterStatuses = SemesterStatus::all();
        //international
        $internationalStatuses = InternationalStatus::all();
        $internationalCategories = InternationalCategory::all();
        $internationalUniversities = InternationalUniversity::all();
        $internationalFundings = InternationalFunding::all();
        $internationalPrograms = InternationalProgram::all();
        return view('pages.mahasiswa.detail', compact(
            'mahasiswa',
            'genders',
            'batches',
            'majors',
            'countries',
            'semesters',
            'semesterStatuses',
            'internationalStatuses',
            'internationalCategories',
            'internationalUniversities',
            'internationalFundings',
            'internationalPrograms',
        ));
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
            'photo' => 'nullable',
        ]);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $file = $file->storeAs('file', $file_name, 'public_uploads');
            $data['photo'] = $file;
        };
        $old_batch = $mahasiswa->user_mahasiswa->batch_id;
        $mahasiswa->update($data);
        $mahasiswa->user_mahasiswa->update($data);
        if ($old_batch != $data['batch_id']) {
            $mahasiswa->user_mahasiswa->batch_semester_user_mahasiswas()->delete();
            $batchSemesters = BatchSemester::where('batch_id', $mahasiswa->user_mahasiswa->batch_id)->get();
            foreach ($batchSemesters as $batchSemester) {
                BatchSemesterUserMahasiswa::updateOrCreate(
                    [
                        'user_mahasiswa_id' => $mahasiswa->user_mahasiswa->id,
                        'batch_semester_id' => $batchSemester->id,
                    ],
                );
            }
        }
        DB::table('model_has_roles')->where('model_id', $mahasiswa->id)->delete();
        $role = Role::where('name', 'MAHASISWA')->first()->id;
        $mahasiswa->assignRole($role);
        session()->flash('success');
        return back();
    }
    public function updatePassword(Request $request, User $mahasiswa)
    {
        $data = $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        $mahasiswa->update($data);
        session()->flash('success');
        return back();
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
        if ($mahasiswa->user_mahasiswa) {
            $mahasiswa->user_mahasiswa->delete();
        }
        session()->flash('success');
        return back();
    }
    public function getData($userMahasiswa)
    {
        $mahasiswaSemesters = MahasiswaSemester::where('user_mahasiswa_id', $userMahasiswa)->orderBy('semester_id')->get();
        return response()->json($mahasiswaSemesters);
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
        return response()->json('Sukses');
    }
    public function destroySemester(MahasiswaSemester $mahasiswaSemester)
    {
        $mahasiswaSemester->delete();
        session()->flash('success');
        return response()->json('Sukses');
    }
    public function getBatchSemester(User $user)
    {
        return BatchSemesterResource::collection($user->user_mahasiswa->batch->batch_semesters);
    }
}
