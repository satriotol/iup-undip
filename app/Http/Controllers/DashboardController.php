<?php

namespace App\Http\Controllers;

use App\Models\SemesterStatus;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $semesterStatuses = SemesterStatus::all();
        $users = User::has('user_mahasiswa')->get();
        return view('dashboard', compact('users', 'semesterStatuses'));
    }
}
