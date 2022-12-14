<?php

namespace App\Http\Controllers\Api;

use App\Exports\MahasiswaExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableSemesterResource;
use App\Http\Resources\UserResource;
use App\Models\Batch;
use App\Models\SemesterStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'asc')->whereHas('user_mahasiswa', function ($q) use ($request) {
            $q->where('batch_id', $request->batch);
        })->get();
        // dd($users->count());
        if ($users->count() == 0) {
            return ResponseFormatter::error('', 'Data Tidak Ditemukan');
        }
        $semesterStatuses = SemesterStatus::all();
        return ResponseFormatter::success([
            'batch_semesters' => new TableSemesterResource($users[0]),
            'users' => UserResource::collection($users),
            'mahasiswaCount' => $users->count(),
            'semesterStatuses' => $semesterStatuses,
        ]);
    }
    public function getExcel(Request $request)
    {
        return Excel::download(new MahasiswaExport($request->batch), 'users-collection.xlsx');
    }
}
