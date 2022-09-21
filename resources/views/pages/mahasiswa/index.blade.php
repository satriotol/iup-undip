@extends('layout.main')
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
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $mahasiswa->user_mahasiswa->nim }}</td>
                                        <td>{{ $mahasiswa->name }}</td>
                                        <td>{{ $mahasiswa->email }}</td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
