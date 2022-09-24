<table>
    <thead>
        <tr style="text-align: center">
            <th rowspan="2">Code</th>
            <th rowspan="2">Country</th>
            <th rowspan="2">Major</th>
            <th rowspan="2">Batch</th>
            <th rowspan="2">Student ID</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Semester / Status</th>
            <th colspan="8">International Exposure</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Status</th>
            <th>Category</th>
            <th>University | Country</th>
            <th>Program</th>
            <th>Duration</th>
            <th>Year</th>
            <th>Start At s/d End At</th>
            <th>Funding</th>
        </tr>
        @foreach ($userMahasiswas as $userMahasiswa)
            <tr>
                <td>{{ $userMahasiswa->country->code }}</td>
                <td>{{ $userMahasiswa->country->name }}</td>
                <td>{{ $userMahasiswa->major->name }}</td>
                <td>{{ $userMahasiswa->batch->year }}</td>
                <td>{{ $userMahasiswa->nim }}</td>
                <td>{{ $userMahasiswa->user->name }}</td>
                <td>
                    @foreach ($userMahasiswa->mahasiswa_semesters as $mahasiswa_semester)
                        <ul>{{ $mahasiswa_semester->semester->year }} - {{ $mahasiswa_semester->semester->semester }} |
                            {{ $mahasiswa_semester->semester_status->name }}</ul>
                    @endforeach
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->international_status->name ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->international_category->name ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->international_university->name ?? '' }} |
                    {{ $userMahasiswa->international_mahasiswa->international_university->country->name ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->international_program->name ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->duration ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->year ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->start_at ?? '' }} s/d
                    {{ $userMahasiswa->international_mahasiswa->end_at ?? '' }}
                </td>
                <td>
                    {{ $userMahasiswa->international_mahasiswa->international_funding->name ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
