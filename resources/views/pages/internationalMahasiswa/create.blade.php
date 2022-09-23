@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title" International>Mahasiswa</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form International Mahasiswa</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($internationalMahasiswa) {{ route('internationalMahasiswa.update', [$user_mahasiswa_id, $internationalMahasiswa->id]) }} @endisset @empty($internationalMahasiswa) {{ route('internationalMahasiswa.store', $user_mahasiswa_id) }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($internationalMahasiswa)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Status</label>
                            <select name="international_status_id" class="form-control select2-show-search form-select"
                                required data-placeholder="Pilih Status">
                                <option label="Pilih Status"></option>
                                @foreach ($internationalStatuses as $internationalStatus)
                                    <option value="{{ $internationalStatus->id }}"
                                        @isset($internationalMahasiswa)
                                            {{ $internationalStatus->id === $internationalMahasiswa->international_status_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $internationalStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="international_category_id" class="form-control select2-show-search form-select"
                                required data-placeholder="Pilih Kategori">
                                <option label="Pilih Kategori"></option>
                                @foreach ($internationalCategories as $internationalCategory)
                                    <option value="{{ $internationalCategory->id }}"
                                        @isset($internationalMahasiswa)
                                            {{ $internationalCategory->id === $internationalMahasiswa->international_category_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $internationalCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Universitas Tujuan</label>
                            <select name="international_university_id" class="form-control select2-show-search form-select"
                                required data-placeholder="Pilih Universitas">
                                <option label="Pilih Universitas"></option>
                                @foreach ($internationalUniversities as $internationalUniversity)
                                    <option value="{{ $internationalUniversity->id }}"
                                        @isset($internationalMahasiswa)
                                            {{ $internationalUniversity->id === $internationalMahasiswa->international_university_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $internationalUniversity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Program</label>
                            <select name="international_program_id" class="form-control select2-show-search form-select"
                                required data-placeholder="Pilih Program">
                                <option label="Pilih Program"></option>
                                @foreach ($internationalPrograms as $internationalProgram)
                                    <option value="{{ $internationalProgram->id }}"
                                        @isset($internationalMahasiswa)
                                            {{ $internationalProgram->id === $internationalMahasiswa->international_program_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $internationalProgram->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sumber Dana</label>
                            <select name="international_funding_id" class="form-control select2-show-search form-select"
                                required data-placeholder="Pilih Sumber Dana">
                                <option label="Pilih Sumber Dana"></option>
                                @foreach ($internationalFundings as $internationalFunding)
                                    <option value="{{ $internationalFunding->id }}"
                                        @isset($internationalMahasiswa)
                                            {{ $internationalFunding->id === $internationalMahasiswa->international_funding_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $internationalFunding->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Durasi</label>
                            <input type="text" class="form-control"
                                value="{{ isset($internationalMahasiswa) ? $internationalMahasiswa->duration : @old('duration') }}"
                                name="duration" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" class="form-control"
                                value="{{ isset($internationalMahasiswa) ? $internationalMahasiswa->year : @old('year') }}"
                                name="year" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" class="form-control"
                                value="{{ isset($internationalMahasiswa) ? $internationalMahasiswa->start_at : @old('start_at') }}"
                                name="start_at" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" class="form-control"
                                value="{{ isset($internationalMahasiswa) ? $internationalMahasiswa->end_at : @old('end_at') }}"
                                name="end_at" required>
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
