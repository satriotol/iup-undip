@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form International Exposure</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Status</label>
                    <select name="international_status_id" class="form-control select2-show-search form-select" required
                        data-placeholder="Pilih Status">
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
                    <input type="text" class="form-control" value="" name="duration" required>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" class="form-control" value="" name="year" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" value="" name="start_at" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" class="form-control" value="" name="end_at" required>
                </div>
                <div class="text-end">
                    <button class="btn btn-sm btn-success btn-submitInternational-{{ $mahasiswa->user_mahasiswa->id }}"
                        data-master="{{ $mahasiswa->user_mahasiswa->id }}">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail International Exposure</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table border text-nowrap text-md-nowrap table-hover mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Category</th>
                                <th>University</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th>Duration</th>
                                <th>Start At s/d End At</th>
                                <th>Funding</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableInternationalBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getDataInternational = function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('internationalMahasiswa.index', $mahasiswa->user_mahasiswa->id) }}",
                success: function(data) {
                    var len = 0;
                    $('#userTableInternationalBody').empty();
                    len = data.length;
                    for (var i = 0; i < len; i++) {
                        var tr_str = "<tr>" +
                            "<td class='text-helper'>" + data[i].international_status_name + "</td>" +
                            "<td class='text-helper'>" + data[i].international_category_name + "</td>" +
                            "<td class='text-helper'>" + data[i].international_university_name + "</td>" +
                            "<td class='text-helper'>" + data[i].international_program_name + "</td>" +
                            "<td class='text-helper'>" + data[i].year + "</td>" +
                            "<td class='text-helper'>" + data[i].duration + "</td>" +
                            "<td class='text-helper'>" + data[i].start_at + ' s/d ' + data[i].end_at +
                            "</td>" +
                            "<td class='text-helper'>" + data[i].international_funding_name + "</td>" +
                            "<td><a class='btn btn-sm btn-primary' href='/internationalMahasiswa/" +
                            data[i].user_mahasiswa_id +
                            "/" + data[i].id +
                            "/edit'><span class='fe fe-edit'></span></a><button class='btn btn-sm btn-danger btn-delete' data-idinternational=" +
                            data[i].id +
                            " ><span class='fe fe-trash-2'></span></button></td>" +
                            "</tr>";
                        $("#userTableInternationalBody").append(tr_str);
                    }
                    $(".btn-delete").click(function(e) {
                        var idinternational = $(this).data("idinternational");
                        var route = "/internationalMahasiswa/" + idinternational + "/destroy"
                        $.ajax({
                            type: 'POST',
                            url: route,
                            success: function(data) {
                                notif({
                                    msg: "<b>Success:</b> Well done Details Submitted Successfully",
                                    type: "success"
                                });
                                getDataInternational();
                            }
                        });
                    });
                }
            });
        }
        $("#btnInternational").click(function(e) {
            getDataInternational();
        });
        $(".btn-submitInternational-{{ $mahasiswa->user_mahasiswa->id }}").click(function(e) {
            e.preventDefault();

            var international_status_id = $("select[name=international_status_id]").val();
            var international_category_id = $("select[name=international_category_id]").val();
            var international_university_id = $("select[name=international_university_id]").val();
            var international_program_id = $("select[name=international_program_id]").val();
            var international_funding_id = $("select[name=international_funding_id]").val();
            var duration = $("input[name=duration]").val();
            var year = $("input[name=year]").val();
            var start_at = $("input[name=start_at]").val();
            var end_at = $("input[name=end_at]").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('internationalMahasiswa.store', $mahasiswa->user_mahasiswa->id) }}",
                data: {
                    international_status_id: international_status_id,
                    international_category_id: international_category_id,
                    international_university_id: international_university_id,
                    international_program_id: international_program_id,
                    international_funding_id: international_funding_id,
                    duration: duration,
                    year: year,
                    start_at: start_at,
                    end_at: end_at,
                },
                success: function(data) {
                    getDataInternational();
                    notif({
                        msg: "<b>Success:</b> Well done Details Submitted Successfully",
                        type: "success"
                    });
                }
            });
        });
    </script>
@endpush
