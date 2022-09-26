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
                                    <th>Photo</th>
                                    <th>Batch</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Major / Batch</th>
                                    <th>Asal</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td><img src="{{ asset('uploads/' . $mahasiswa->photo) }}" alt=""></td>
                                        <td>{{ $mahasiswa->user_mahasiswa->batch->year ?? '' }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->nim ?? '' }}</td>
                                        <td>{{ $mahasiswa->name ?? '' }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->gender ?? '' }}</td>
                                        <td>{{ $mahasiswa->email ?? '' }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->phone ?? '' }}</td>
                                        <td>{{ $mahasiswa->user_mahasiswa->major->name ?? '' }}/{{ $mahasiswa->user_mahasiswa->batch->year ?? '' }}
                                        <td>{{ $mahasiswa->user_mahasiswa->country->name ?? '' }}
                                        <td
                                            style="background-color: {{ $mahasiswa->user_mahasiswa->mahasiswa_semesters->first()->semester_status->color ?? '' }}">
                                            {{ $mahasiswa->user_mahasiswa->mahasiswa_semesters->first()->semester->year ?? '' }}
                                            -
                                            {{ $mahasiswa->user_mahasiswa->mahasiswa_semesters->first()->semester->semester ?? '' }}
                                            /
                                            {{ $mahasiswa->user_mahasiswa->mahasiswa_semesters->first()->semester_status->name ?? '' }}
                                        </td>
                                        <td name="bstable-actions">
                                            @include('pages.mahasiswa.actions')
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
