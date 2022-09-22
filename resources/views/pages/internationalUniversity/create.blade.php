@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Universitas</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Universitas</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($internationalUniversity) {{ route('internationalUniversity.update', $internationalUniversity->id) }} @endisset @empty($internationalUniversity) {{ route('internationalUniversity.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($internationalUniversity)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                value="{{ isset($internationalUniversity) ? $internationalUniversity->name : @old('name') }}"
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Negara</label>
                            <select name="country_id" class="form-control select2-show-search form-select"
                                data-placeholder="Pilih Negara">
                                <option label="Pilih Negara"></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @isset($internationalUniversity)
                                    {{ $country->id === $internationalUniversity->country_id ? 'selected' : '' }}
                                    @endisset>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
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
@push('custom-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
