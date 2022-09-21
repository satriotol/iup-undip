@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Status Semester</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Status Semester</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($semesterStatus) {{ route('semesterStatus.update', $semesterStatus->id) }} @endisset @empty($semesterStatus) {{ route('semesterStatus.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($semesterStatus)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama Status</label>
                            <input type="text" class="form-control"
                                value="{{ isset($semesterStatus) ? $semesterStatus->name : @old('name') }}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" class="form-control"
                                value="{{ isset($semesterStatus) ? $semesterStatus->color : @old('color') }}" name="color" required>
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
