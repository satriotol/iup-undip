<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
            }
        }

        .container {
            margin-left: 33px;
            margin-right: 33px;
        }

        .table1 {
            position: relative;
            top: 218px;
        }

        table {
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid;
            border-collapse: collapse;
        }

        .col1 {
            position: absolute;
            top: 60px;
        }

        .col2 {
            position: absolute;
            top: 20px;
            left: 800px;
        }

        img {
            object-fit: cover;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col1">
            <p>
                Nama : {{ $user->name }} <br />
                NIM : {{ $user->user_mahasiswa->nim }}<br />
                Email : {{ $user->email }} <br>
                Major : {{ $user->user_mahasiswa->major->name }}<br>
                Batch : {{ $user->user_mahasiswa->batch->year }}<br>
                Asal : {{ $user->user_mahasiswa->country->name }}<br>
            </p>
        </div>
        <div class="col2">
            <img src="{{ public_path('/uploads/' . $user->photo) }}" alt="" width="80px" height="100px" />
        </div>
        <div class="table1">
            <p style="margin-bottom: 0; font-weight:bold">Semester</p>
            <table>
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->user_mahasiswa->batch_semester_user_mahasiswas as $batch_semester_user_mahasiswa)
                        <tr>
                            <td>{{ $batch_semester_user_mahasiswa->batch_semester->year ?? '' }} -
                                {{ $batch_semester_user_mahasiswa->batch_semester->semester ?? '' }}</td>
                            <td>{{ $batch_semester_user_mahasiswa->semester_status->name ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-bottom: 0; font-weight:bold">International Exposure</p>
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Category</th>
                        <th>University | Country</th>
                        <th>Program</th>
                        <th>Duration</th>
                        <th>Year</th>
                        <th>Start At - End At</th>
                        <th>Funding</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->user_mahasiswa->international_mahasiswa as $international_mahasiswa)
                        <tr>
                            <td>{{ $international_mahasiswa->international_status->name }}</td>
                            <td>{{ $international_mahasiswa->international_category->name }}</td>
                            <td>{{ $international_mahasiswa->international_university->name }} |
                                {{ $international_mahasiswa->international_university->country->name }}</td>
                            <td>{{ $international_mahasiswa->international_program->name }}</td>
                            <td>{{ $international_mahasiswa->duration }}</td>
                            <td>{{ $international_mahasiswa->year }}</td>
                            <td>{{ $international_mahasiswa->start_at }} - {{ $international_mahasiswa->end_at }}</td>
                            <td>{{ $international_mahasiswa->international_funding->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-bottom: 0; font-weight:bold">Additional Notes</p>
            <table>
                <thead>
                    <tr>
                        <th colspan="6">MOST RECENT IELTS/TOEFL IBT SCORE </th>
                        <th colspan="2">PARTICIPATION</th>
                        <th rowspan="2">ACHIEVEMENT</th>
                        <th rowspan="2">OTHER INFORMATION</th>
                    </tr>
                    <tr>
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
                    @foreach ($user->user_mahasiswa->notes as $note)
                        <tr>
                            <td>{{ $note->test_date }}</td>
                            <td>{{ $note->listening }}</td>
                            <td>{{ $note->reading }}</td>
                            <td>{{ $note->writing }}</td>
                            <td>{{ $note->speaking }}</td>
                            <td>{{ $note->overall_score }}</td>
                            <td>{{ $note->event_1 }}</td>
                            <td>{{ $note->event_2 }}</td>
                            <td>{{ $note->achievement }}</td>
                            <td>{{ $note->other_information }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
