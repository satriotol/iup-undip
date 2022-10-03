<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableSemesterResource;
use App\Http\Resources\UserResource;
use App\Models\Batch;
use App\Models\SemesterStatus;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::has('user_mahasiswa')->whereHas('user_mahasiswa', function ($q) use ($request) {
            $q->where('batch_id', $request->batch);
        })->get();
        return ResponseFormatter::success([
            'batch_semesters' => new TableSemesterResource($users[0]),
            'users' => UserResource::collection($users)
        ]);
    }
}
