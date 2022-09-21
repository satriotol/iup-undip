@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Status Semester</h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Status Semester Table</h3>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('semesterStatus.create') }}" class="btn btn-sm btn-primary" type="button">Create</a>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0"id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Warna</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesterStatuses as $semesterStatus)
                                    <tr>
                                        <td>{{ $semesterStatus->name }}</td>
                                        <td>{{ $semesterStatus->color }}</td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
                                                <form action="{{ route('semesterStatus.destroy', $semesterStatus->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('semesterStatus.edit', $semesterStatus->id) }}">
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
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script>
        $(function(e) {
            "use strict";
            $('#responsive-datatable').DataTable({
                language: {
                    searchPlaceholder: 'Search...',
                    scrollX: "100%",
                    sSearch: '',
                }
            });
        });
    </script>
@endpush
