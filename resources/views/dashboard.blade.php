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
                        <div v-if='users.length && !loading'>
                            <div class="text-end mt-2">
                                <button @click='getExcel' target="_blank" class="btn btn-sm btn-success">Export
                                    Excel</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0">
                                    <thead style="text-align: center">
                                        <tr>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Action</th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Code</th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Country</th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Major</th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Batch</th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Student ID
                                            </th>
                                            <th rowspan="3" style="vertical-align : middle;text-align:center;">Name</th>
                                            <th rowspan="2" :colspan="batch_semesters.length"
                                                style="vertical-align : middle;text-align:center;">Semester | Status
                                            </th>
                                            <th colspan="8">International Exposure</th>
                                            <th colspan="10">Additional Notes</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Status</th>
                                            <th rowspan="2">Category</th>
                                            <th rowspan="2">University | Country</th>
                                            <th rowspan="2">Program</th>
                                            <th rowspan="2">Duration</th>
                                            <th rowspan="2">Year</th>
                                            <th rowspan="2">Start At - End At</th>
                                            <th rowspan="2">Funding</th>
                                            <th colspan="6">Most Recent IELTS/TOEFL iBT SCORE</th>
                                            <th colspan="2">Participation</th>
                                            <th rowspan="2">Achievement</th>
                                            <th rowspan="2">Other Information</th>
                                        </tr>
                                        <tr>
                                            <th v-for="(batch_semester, index) in batch_semesters">@{{ batch_semester.year }} |
                                                @{{ batch_semester.semester }}</th>
                                            <th>Test Date</th>
                                            <th>Listening</th>
                                            <th>Reading</th>
                                            <th>Writing</th>
                                            <th>Speaking</th>
                                            <th>Overall Score</th>
                                            <th>Event 1</th>
                                            <th>Event 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users">
                                            <td><a :href="'/exportPdf/' + user.id" target="_blank"
                                                    class="badge bg-danger">Export
                                                    PDF</a><br>
                                                <a :href="'/mahasiswa/' + user.id" target="_blank"
                                                    class="badge bg-primary">Detail</a>
                                            </td>
                                            <td>@{{ user.code }}</td>
                                            <td>@{{ user.country }}</td>
                                            <td>@{{ user.major }}</td>
                                            <td>@{{ user.batch }}</td>
                                            <td>@{{ user.nim }}</td>
                                            <td>@{{ user.name }}</td>
                                            <td v-for="(batch_semester_user_mahasiswa, index) in user.batch_semester_user_mahasiswas"
                                                :style="{
                                                    'background-color': batch_semester_user_mahasiswa
                                                        .semester_status_color
                                                }">
                                                <select name=""
                                                    @change="updateStatus([batch_semester_user_mahasiswa.id,batch_semester_user_mahasiswa.semester_status_id])"
                                                    v-model='batch_semester_user_mahasiswa.semester_status_id' id="">
                                                    <option value="">Status</option>
                                                    <option v-for="(semesterStatus, index) in semesterStatuses"
                                                        :value="semesterStatus.id">
                                                        @{{ semesterStatus.name }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.international_status_name }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.international_category_name }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.international_university_name }} | @{{ international_mahasiswa.international_university_country }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.international_program_name }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.duration }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.year }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.start_at }} - @{{ international_mahasiswa.end_at }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(international_mahasiswa, index) in user.international_mahasiswas">
                                                    <li>
                                                        @{{ international_mahasiswa.international_funding_name }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.test_date }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.listening }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.reading }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.writing }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.speaking }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.overall_score }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.event_1 }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.event_2 }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.achievement }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul v-for="(note, index) in user.notes">
                                                    <li>
                                                        @{{ note.other_information }}
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                <input type="text" class="form-control" value="{{ @old('nim') }}" name="nim"
                                    required>
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
                        }).catch((error) => {
                            this.users = [];
                            this.batch_semesters = [];
                            notif({
                                msg: error.message,
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
