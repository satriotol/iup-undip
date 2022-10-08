@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
    </div>
    <div class="row">
        @role('SUPERADMIN')
            <div class="col-xl-12" id="app">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard</h3>
                    </div>
                    <div class="card-body">
                        {{-- <form action=""> --}}
                        <label for="">Batch</label>
                        <select name="batch" class="form-control" v-model='batch'>
                            <option value="">Pilih Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}" @selected(@old('batch') == $batch->id)>{{ $batch->year }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-end">
                            <button class="btn btn-info" @click='getData()'>Cari</button>
                        </div>
                        {{-- </form> --}}
                        <div class="text-center" v-if="loading">
                            <div class="spinner-border text-primary me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" v-if='users.length && !loading'>
                    <div class="card-header">
                        <h3 class="card-title">Tabel</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="card bg-primary img-card box-primary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font">@{{ mahasiswaCount }}</h2>
                                            <p class="text-white mb-0">Total Mahasiswa</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('tableDashboard')
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('MAHASISWA_REGISTER')
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        @include('partials.errors')
                        <form action="{{ route('dashboard.storeUser') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text" class="form-control" value="{{ @old('nim') }}" name="nim" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Jenis Kelamin</label>
                                    <select name="gender" class="form-control select2-show-search form-select" required
                                        data-placeholder="Pilih Jenis Kelamin">
                                        <option label="Pilih Jenis Kelamin"></option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender }}">
                                                {{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control" value="{{ @old('phone') }}" name="phone"
                                        required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Batch</label>
                                    <select name="batch_id" class="form-control select2-show-search form-select" required
                                        data-placeholder="Pilih Batch">
                                        <option label="Pilih Batch"></option>
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">
                                                {{ $batch->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Major</label>
                                    <select name="major_id" class="form-control select2-show-search form-select" required
                                        data-placeholder="Pilih Major">
                                        <option label="Pilih Major"></option>
                                        @foreach ($majors as $major)
                                            <option value="{{ $major->id }}">
                                                {{ $major->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Negara</label>
                                    <select name="country_id" class="form-control select2-show-search form-select" required
                                        data-placeholder="Pilih Negara">
                                        <option label="Pilih Negara"></option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Foto</label>
                                <input type="file" name="photo" accept="image/*" class="form-control" required>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endrole
        @role('MAHASISWA_WAITING')
            <h5>Akun Anda Sedang Kami Cek Silahkan Tunggu Dulu</h5>
        @endrole
        @role('MAHASISWA')
            @include('dashboardMahasiswa')
        @endrole
    </div>
@endsection
@push('custom-scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/downloadjs/1.4.8/download.min.js"
        integrity="sha512-WiGQZv8WpmQVRUFXZywo7pHIO0G/o3RyiAJZj8YXNN4AV7ReR1RYWVmZJ6y3H06blPcjJmG/sBpOVZjTSFFlzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    batch: '',
                    batch_semesters: [],
                    users: [],
                    mahasiswaCount: "",
                    loading: false,
                }
            },
            methods: {
                getData() {
                    this.loading = true;
                    axios.get('/api/dashboard', {
                            params: {
                                batch: this.batch
                            }
                        })
                        .then((res) => {
                            this.batch_semesters = res.data.data.batch_semesters;
                            this.users = res.data.data.users;
                            this.semesterStatuses = res.data.data.semesterStatuses;
                            this.mahasiswaCount = res.data.data.mahasiswaCount;
                        }).catch((error) => {
                            console.log(error.message);
                            this.users = [];
                            this.batch_semesters = [];
                            notif({
                                msg: error.response.data.meta.message,
                                type: "error"
                            });
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                getDataDinamis() {
                    axios.get('/api/dashboard', {
                            params: {
                                batch: this.batch
                            }
                        })
                        .then((res) => {
                            this.batch_semesters = res.data.data.batch_semesters;
                            this.users = res.data.data.users;
                            this.semesterStatuses = res.data.data.semesterStatuses;
                            this.mahasiswaCount = res.data.data.mahasiswaCount;
                        });
                },
                getExcel() {
                    axios.get('/api/dashboard/getExcel', {
                            params: {
                                batch: this.batch,
                            },
                            responseType: 'blob',
                        })
                        .then((response) => {
                            const content = response.headers['content-type'];
                            download(response.data, 'data-mahasiswa-' + this.batch, content)
                        });
                },
                updateStatus(batchSemesterUserMahasiswa) {
                    const url = '/postBatchSemesterUserMahasiswa/status/' + batchSemesterUserMahasiswa[0];
                    axios.post(url, {
                            semester_status_id: batchSemesterUserMahasiswa[1],
                        })
                        .then((response) => {
                            notif({
                                msg: "<b>Success:</b> Well done Details Submitted Successfully",
                                type: "success"
                            });
                            this.getDataDinamis();
                        });
                },
            },
        }).mount('#app')
    </script>
@endpush
