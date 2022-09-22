@extends('layout.main')
@push('style')
    <style>
        .text-helper {
            font-size: 1rem;
        }
    </style>
@endpush
@section('content')
    <div class="page-header">
        <h1 class="page-title">Mahasiswa</h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mahasiswa Table</h3>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary" type="button">Create</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Fakultas / Batch</th>
                                    <th>Asal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $mahasiswa->user_mahasiswa->nim }}</td>
                                        <td>{{ $mahasiswa->name }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->gender }}</td>
                                        <td>{{ $mahasiswa->email }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->phone }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->major->name }}/{{ $mahasiswa->user_mahasiswa->batch->year }}
                                        <td>{{ $mahasiswa->user_mahasiswa->country->name }}
                                        </td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
                                                <button class="btn btn-sm btn-secondary bg-secondary-gradient"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#extralargemodal">Semester</button>
                                                <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Semester {{ $mahasiswa->name }}
                                                                </h5>
                                                                <button class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">

                                                                    <form
                                                                        action="{{ route('mahasiswa.assignSemester', $mahasiswa->user_mahasiswa->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label class="text-helper">Semester</label><br>
                                                                            <select name="semester_id"
                                                                                class="form-control select2-show-search form-select"
                                                                                data-placeholder="Pilih Semester">
                                                                                <option label="Pilih Semester"></option>
                                                                                @foreach ($semesters as $semester)
                                                                                    <option value="{{ $semester->id }}">
                                                                                        {{ $semester->year }} |
                                                                                        {{ $semester->semester }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-helper">Status
                                                                                Semester</label><br>
                                                                            <select name="semester_status_id"
                                                                                class="form-control select2-show-search form-select"
                                                                                data-placeholder="Pilih Status Semester">
                                                                                <option label="Pilih Status Semester">
                                                                                </option>
                                                                                @foreach ($semesterStatuses as $semesterStatus)
                                                                                    <option
                                                                                        value="{{ $semesterStatus->id }}">
                                                                                        {{ $semesterStatus->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <button
                                                                                class="btn btn-sm btn-success" type="submit">Submit</button>
                                                                        </div>
                                                                    </form>

                                                                    <div class="table-responsive mt-2">
                                                                        <table
                                                                            class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Semester</th>
                                                                                    <th>Status</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($mahasiswa->user_mahasiswa->mahasiswa_semesters as $mahasiswa_semester)
                                                                                    <tr>
                                                                                        <td class="text-helper">
                                                                                            {{ $mahasiswa_semester->semester->year }}
                                                                                            |
                                                                                            {{ $mahasiswa_semester->semester->semester }}
                                                                                        </td>
                                                                                        <td class="text-helper">
                                                                                            {{ $mahasiswa_semester->semester_status->name }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <form
                                                                                                action="{{ route('mahasiswa.destroySemester', $mahasiswa_semester->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-sm btn-danger"
                                                                                                    onclick="return confirm('Are you sure?')">
                                                                                                    <span
                                                                                                        class="fe fe-trash-2">
                                                                                                    </span>
                                                                                                </button>
                                                                                            </form>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" type="submit">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('mahasiswa.edit', $mahasiswa->id) }}">
                                                        <span class="fe fe-edit"> </span>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        <span class="fe fe-trash-2"> </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $mahasiswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
