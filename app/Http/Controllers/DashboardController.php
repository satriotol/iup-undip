<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\SemesterStatus;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    public function index()
    {
        $semesterStatuses = SemesterStatus::all();
        $users = User::has('user_mahasiswa')->get();
        return view('dashboard', compact('users', 'semesterStatuses'));
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
}
