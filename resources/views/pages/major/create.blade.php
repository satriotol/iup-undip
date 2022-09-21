@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Major</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Major</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($major) {{ route('major.update', $major->id) }} @endisset @empty($major) {{ route('major.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($major)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                value="{{ isset($major) ? $major->name : @old('name') }}" name="name" required>
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
