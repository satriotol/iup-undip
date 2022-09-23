@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Country</th>
                                    <th>Major</th>
                                    <th>Batch</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Semester | Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_mahasiswa->country->code }}</td>
                                        <td>{{ $user->user_mahasiswa->country->name }}</td>
                                        <td>{{ $user->user_mahasiswa->major->name }}</td>
                                        <td>{{ $user->user_mahasiswa->batch->year }}</td>
                                        <td>{{ $user->user_mahasiswa->nim }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->mahasiswa_semesters as $mahasiswa_semester)
                                                <form
                                                    action="{{ route('mahasiswaSemester.update', $mahasiswa_semester->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <ul>
                                                        {{ $mahasiswa_semester->semester->year }} -
                                                        {{ $mahasiswa_semester->semester->semester }}
                                                        |
                                                        <select name="semester_status_id">
                                                            @foreach ($semesterStatuses as $semesterStatus)
                                                                <option value="{{ $semesterStatus->id }}"
                                                                    {{ $semesterStatus->id === $mahasiswa_semester->semester_status_id ? 'selected' : '' }}>
                                                                    {{ $semesterStatus->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button class="btn btn-sm btn-success"
                                                            type="submit">Update</button>
                                                    </ul>
                                                </form>
                                            @endforeach
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
