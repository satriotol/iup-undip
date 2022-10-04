@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="row" id="app">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Batch Semester</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table border text-nowrap text-md-nowrap table-hover mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <tr v-for="(batchSemester,index) in batchSemesters">
                                <td>
                                    @{{ batchSemester.year }} | @{{ batchSemester.semester }}
                                </td>
                                <td>
                                    <select v-model.number="batchSemester.semester_status_id" class="form-control"
                                        id="">
                                        @foreach ($semesterStatuses as $semesterStatus)
                                            <option value="{{ $semesterStatus->id }}">{{ $semesterStatus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button class="btn btn-success" @click="postBatchSemesterUserMahasiswa">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    batchSemesters: [],
                }
            },
            mounted() {
                this.getBatchSemester();
            },
            methods: {
                getBatchSemester() {
                    axios
                        .get('/getBatchSemester/{{ $mahasiswa->id }}')
                        .then(response => {
                            this.batchSemesters = response.data.data;
                        })
                },
                postBatchSemesterUserMahasiswa() {
                    axios.post('/postBatchSemesterUserMahasiswa/{{ $mahasiswa->user_mahasiswa->id }}', this
                            .batchSemesters)
                        .then((response) => {
                            notif({
                                msg: "<b>Success:</b> Well done Details Submitted Successfully",
                                type: "success"
                            });
                        });
                },
            },
        }).mount('#app')
    </script>
@endpush
