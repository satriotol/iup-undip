<table>
    <thead style="text-align: center">
        <tr>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Code</th>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Country</th>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Major</th>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Batch</th>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Student ID</th>
            <th rowspan="3" style="vertical-align : middle;text-align:center;">Name</th>
            <th rowspan="2" colspan="{{ $userMahasiswas[0]->batch->batch_semesters->count() }}"
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
            @foreach ($userMahasiswas[0]->batch->batch_semesters as $batch_semester)
                <th>{{ $batch_semester->year }} | {{ $batch_semester->semester }}</th>
            @endforeach
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
        @foreach ($userMahasiswas as $userMahasiswa)
            <tr>
                <td>{{ $userMahasiswa->country->code }}</td>
                <td>{{ $userMahasiswa->country->name }}</td>
                <td>{{ $userMahasiswa->major->name }}</td>
                <td>{{ $userMahasiswa->batch->year }}</td>
                <td>{{ $userMahasiswa->nim }}</td>
                <td>{{ $userMahasiswa->user->name }}</td>
                @foreach ($userMahasiswa->batch_semester_user_mahasiswas as $batch_semester_user_mahasiswa)
                    <td style="background-color: {{ $batch_semester_user_mahasiswa->semester_status->color ?? '' }}">
                        {{ $batch_semester_user_mahasiswa->semester_status->name ?? '' }}
                    </td>
                @endforeach
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>{{ $international_mahasiswa->international_status?->name ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>{{ $international_mahasiswa->international_category?->name ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->international_university?->name ?? '' }}
                                |
                                {{ $international_mahasiswa->international_university?->country->name ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->international_program?->name ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->duration ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->year ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->start_at ?? '' }} -
                                {{ $international_mahasiswa->end_at ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->international_mahasiswa as $international_mahasiswa)
                        <ul>
                            <li>
                                {{ $international_mahasiswa->international_funding?->name ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->test_date ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->listening ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->reading ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->writing ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->speaking ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->overall_score ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->event_1 ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->event_2 ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->achievement ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    @foreach ($userMahasiswa->notes as $note)
                        <ul>
                            <li>
                                {{ $note->other_information ?? '' }}
                            </li>
                        </ul>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
