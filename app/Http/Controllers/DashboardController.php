<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Batch;
use App\Models\BatchSemester;
use App\Models\BatchSemesterUserMahasiswa;
use App\Models\Country;
use App\Models\InternationalCategory;
use App\Models\InternationalFunding;
use App\Models\InternationalProgram;
use App\Models\InternationalStatus;
use App\Models\Major;
use App\Models\SemesterStatus;
use App\Models\User;
use App\Models\UserMahasiswa;
use App\Notifications\MahasiswaRegisterNotification;
use App\Notifications\SendPushNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Notification::send(null, new SendPushNotification('$title', '$message', 'Auth::user()->fcm_token'));
        $semesterStatuses = SemesterStatus::all();
        $users = User::has('user_mahasiswa')->whereHas('user_mahasiswa', function ($q) use ($request) {
            $q->where('batch_id', $request->batch);
        })->get();
        activity()->log('Open Dashboard');
        $genders = User::GENDER;
        $batches = batch::getBatches()->get();
        $majors = Major::all();
        $countries = Country::all();
        $request->flash();
        $mahasiswa = Auth::user();
        $internationalStatuses = InternationalStatus::all();
        $internationalCategories = InternationalCategory::all();
        $internationalUniversities = InternationalCategory::all();
        $internationalFundings = InternationalFunding::all();
        $internationalPrograms = InternationalProgram::all();
        return view('dashboard', compact(
            'users',
            'semesterStatuses',
            'genders',
            'batches',
            'majors',
            'countries',
            'mahasiswa',
            'internationalStatuses',
            'internationalCategories',
            'internationalUniversities',
            'internationalFundings',
            'internationalPrograms',
        ));
    }
    public function fileExport(Request $request)
    {
        return Excel::download(new MahasiswaExport($request->batch), 'users-collection.xlsx');
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
        DB::beginTransaction();
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $data['user_id'] = $user->id;
            $user_mahasiswa = UserMahasiswa::create($data);
            $user_mahasiswa->user->update(
                [
                    'photo' => $data['photo']
                ]
            );
            $batchSemesters = BatchSemester::where('batch_id', $user_mahasiswa->batch_id)->get();
            foreach ($batchSemesters as $batchSemester) {
                BatchSemesterUserMahasiswa::create([
                    'user_mahasiswa_id' => $user_mahasiswa->id,
                    'batch_semester_id' => $batchSemester->id,
                ]);
            }
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $role = Role::where('name', 'MAHASISWA_WAITING')->first()->id;
            $user->assignRole($role);
            $admins = User::whereDoesntHave('user_mahasiswa')->get();
            Notification::send($admins, new MahasiswaRegisterNotification($user));
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            return $e;
            DB::rollback();
        }

        session()->flash('success');
        return back();
    }
    public function updateToken(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }
    public function notification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('success', 'Notification Sent Successfully!!');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }
}
