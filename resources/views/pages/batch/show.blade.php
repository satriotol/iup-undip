@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Batch</h1>
        <div class="text-end">
            <a class="btn btn-warning" href="{{ url()->previous() }}">Kembali</a>
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
    </div>
@endsection
