@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Program</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Program</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($internationalProgram) {{ route('internationalProgram.update', $internationalProgram->id) }} @endisset @empty($internationalProgram) {{ route('internationalProgram.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($internationalProgram)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                value="{{ isset($internationalProgram) ? $internationalProgram->name : @old('name') }}"
                                name="name" required>
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
