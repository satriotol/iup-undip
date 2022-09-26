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
                    <div class="text-end">
                        <a href="{{ route('dashboard.fileExport') }}" target="_blank" class="btn btn-sm btn-success">Export
                            Excel</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0">
                            <thead style="text-align: center">
                                <tr>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Action</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Code</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Country</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Major</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Batch</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Student ID</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Name</th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;">Semester | Status
                                    </th>
                                    <th colspan="8">International Exposure</th>
                                    <th colspan="10">Additional Notes</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Category</th>
                                    <th rowspan="2">University | Country</th>
                                    <th rowspan="2">Program</th>
                                    <th rowspan="2">Duration</th>
                                    <th rowspan="2">Year</th>
                                    <th rowspan="2">Start At - End At</th>
                                    <th rowspan="2">Funding</th>
                                    <th colspan="6">Most Recent IELTS/TOEFL iBT SCORE</th>
                                    <th colspan="2">Participation</th>
                                    <th rowspan="2">Achievement</th>
                                    <th rowspan="2">Other Information</th>
                                </tr>
                                <tr>
                                    <th>Test Date</th>
                                    <th>Listening</th>
                                    <th>Reading</th>
                                    <th>Writing</th>
                                    <th>Speaking</th>
                                    <th>Overall Score</th>
                                    <th>Event 1</th>
                                    <th>Event 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><a href="{{ route('exportPdf', $user->id) }}" target="_blank"
                                                class="badge bg-danger">Export
                                                PDF</a></td>
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
                                                    <ul style="color: {{ $mahasiswa_semester->semester_status->color }}">
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
                                                        <button class="btn btn-sm btn-primary"
                                                            type="submit">Update</button>
                                                    </ul>
                                                </form>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>{{ $international_mahasiswa->international_status?->name ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>{{ $international_mahasiswa->international_category?->name ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->international_university?->name ?? '' }}
                                                        |
                                                        {{ $international_mahasiswa->international_university?->country->name ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->international_program?->name ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->duration ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->year ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->start_at ?? '' }} -
                                                        {{ $international_mahasiswa->end_at ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                                                <ul>
                                                    <li>
                                                        {{ $international_mahasiswa->international_funding?->name ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->test_date ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->listening ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->reading ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->writing ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->speaking ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->overall_score ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->event_1 ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->event_2 ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->achievement ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->user_mahasiswa->notes as $note)
                                                <ul>
                                                    <li>
                                                        {{ $note->other_information ?? '' }}
                                                    </li>
                                                </ul>
                                            @endforeach
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
