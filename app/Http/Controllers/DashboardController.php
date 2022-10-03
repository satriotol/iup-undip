<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Batch;
use App\Models\Country;
use App\Models\Major;
use App\Models\SemesterStatus;
use App\Models\User;
use App\Models\UserMahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $semesterStatuses = SemesterStatus::all();
        $users = User::has('user_mahasiswa')->whereHas('user_mahasiswa', function ($q) use ($request) {
            $q->where('batch_id', $request->batch);
        })->get();
        $genders = User::GENDER;
        $batches = Batch::all();
        $majors = Major::all();
        $countries = Country::all();
        $request->flash();
        return view('dashboard', compact('users', 'semesterStatuses', 'genders', 'batches', 'majors', 'countries'));
    }
    public function fileExport()
    {
        return Excel::download(new MahasiswaExport, 'users-collection.xlsx');
    }
    public function exportPdf(User $user)
    {
        $pdf = Pdf::loadView('pdf.mahasiswa', compact('user'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
    public function storeUser(Request $request)
    {
        $data = $this->validate($request, [
            'batch_id' => 'required',
            'major_id' => 'required',
            'country_id' => 'required',
            'nim' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'photo' => 'required|image'
        ]);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $file = $file->storeAs('file', $file_name, 'public_uploads');
            $data['photo'] = $file;
        };
        $user = User::where('id', Auth::user()->id)->first();
        $data['user_id'] = $user->id;
        $user_mahasiswa = UserMahasiswa::create($data);
        $user_mahasiswa->user->update(
            [
                'photo' => $data['photo']
            ]
        );
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $role = Role::where('name', 'MAHASISWA_WAITING')->first()->id;
        $user->assignRole($role);
        session()->flash('success');
        return back();
    }
}
