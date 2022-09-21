@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Mahasiswa</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Mahasiswa</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($mahasiswa) {{ route('mahasiswa.update', $mahasiswa->id) }} @endisset @empty($mahasiswa) {{ route('mahasiswa.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($mahasiswa)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                value="{{ isset($mahasiswa) ? $mahasiswa->name : @old('name') }}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control"
                                value="{{ isset($mahasiswa) ? $mahasiswa->email : @old('email') }}" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control"
                                value="{{ isset($mahasiswa) ? $mahasiswa->user_mahasiswa->nim : @old('nim') }}"
                                name="nim" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-control select2-show-search form-select"
                                    data-placeholder="Pilih Jenis Kelamin">
                                    <option label="Pilih Jenis Kelamin"></option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender }}"
                                            @isset($mahasiswa)
                                            {{ $gender === $mahasiswa->user_mahasiswa->gender ? 'selected' : '' }}
                                        @endisset>
                                            {{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nomor HP</label>
                                <input type="text" class="form-control"
                                    value="{{ isset($mahasiswa) ? $mahasiswa->user_mahasiswa->phone : @old('phone') }}"
                                    name="phone" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Batch</label>
                                <select name="batch_id" class="form-control select2-show-search form-select"
                                    data-placeholder="Pilih Batch">
                                    <option label="Pilih Batch"></option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            @isset($mahasiswa)
                                            {{ $batch->id === $mahasiswa->user_mahasiswa->batch_id ? 'selected' : '' }}
                                        @endisset>
                                            {{ $batch->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Fakultas</label>
                                <select name="major_id" class="form-control select2-show-search form-select"
                                    data-placeholder="Pilih Fakultas">
                                    <option label="Pilih Fakultas"></option>
                                    @foreach ($majors as $major)
                                        <option value="{{ $major->id }}"
                                            @isset($mahasiswa)
                                                {{ $major->id === $mahasiswa->user_mahasiswa->major_id ? 'selected' : '' }}
                                                @endisset>
                                            {{ $major->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Negara</label>
                                <select name="country_id" class="form-control select2-show-search form-select"
                                    data-placeholder="Pilih Negara">
                                    <option label="Pilih Negara"></option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            @isset($mahasiswa)
                                            {{ $country->id === $mahasiswa->user_mahasiswa->country_id ? 'selected' : '' }}
                                            @endisset>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
