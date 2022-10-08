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
                <th rowspan="2" :colspan="batch_semesters.length" style="vertical-align : middle;text-align:center;">
                    Semester | Status
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
                <td>
                    <form :action="'/admin/reset_password/' + user.id" method="POST">
                        @csrf
                        <button type="submit" class="badge bg-warning b-0" onclick="return confirm('Are you sure?')">
                            Reset Password
                        </button>
                    </form>
                    <a :href="'/exportPdf/' + user.id" target="_blank" class="badge bg-danger">Export
                        PDF</a><br>
                    <a :href="'/mahasiswa/' + user.id" target="_blank" class="badge bg-primary">Detail</a>
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
                        <option v-for="(semesterStatus, index) in semesterStatuses" :value="semesterStatus.id">
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
