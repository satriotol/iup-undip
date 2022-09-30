@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Batch</h1>
        <div class="text-end">
            <a class="btn btn-warning" href="{{ route('batch.index') }}">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Batch</h3>

                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($batch) {{ route('batch.update', $batch->id) }} @endisset @empty($batch) {{ route('batch.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($batch)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" class="form-control"
                                value="{{ isset($batch) ? $batch->year : @old('year') }}" name="year" required>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Semester Batch Table</h3>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('batchSemester.create', $batch->id) }}" class="btn btn-sm btn-primary"
                            type="button">Create</a>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0"id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batch->batch_semesters as $batch_semester)
                                    <tr>
                                        <td>{{ $batch_semester->year }}</td>
                                        <td>{{ $batch_semester->semester }}</td>
                                        <td name="bstable-actions">
                                            <div class="btn-list">
                                                <form action="{{ route('batchSemester.destroy', $batch_semester->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('batchSemester.edit', [$batch_semester->id, $batch->id]) }}">
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
