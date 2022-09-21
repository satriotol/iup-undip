@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Semester</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Semester</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($semester) {{ route('semester.update', $semester->id) }} @endisset @empty($semester) {{ route('semester.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($semester)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" class="form-control"
                                value="{{ isset($semester) ? $semester->year : @old('year') }}" required name="year">
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="text" class="form-control"
                                value="{{ isset($semester) ? $semester->semester : @old('semester') }}" name="semester" required>
                        </div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ url()->previous() }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
