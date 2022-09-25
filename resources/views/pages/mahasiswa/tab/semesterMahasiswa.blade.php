@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Semester</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="text-helper">Semester</label><br>
                    <select name="semester_id" class="form-control select2-show-search form-select" required
                        data-placeholder="Pilih Semester">
                        <option label="Pilih Semester"></option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}">
                                {{ $semester->year }} |
                                {{ $semester->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-helper">Status
                        Semester</label><br>
                    <select name="semester_status_id" class="form-control select2-show-search form-select" required
                        data-placeholder="Pilih Status Semester">
                        <option label="Pilih Status Semester">
                        </option>
                        @foreach ($semesterStatuses as $semesterStatus)
                            <option value="{{ $semesterStatus->id }}">
                                {{ $semesterStatus->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-end">
                    <button class="btn btn-sm btn-success btn-submit-{{ $mahasiswa->user_mahasiswa->id }}"
                        data-master="{{ $mahasiswa->user_mahasiswa->id }}">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Semester</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table border text-nowrap text-md-nowrap table-hover mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
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
        var getData = function() {
            $.ajax({
                type: 'GET',
                url: "/mahasiswa/getData/ " + {{ $mahasiswa->user_mahasiswa->id }},
                success: function(data) {
                    var len = 0;
                    $('#userTableBody').empty();
                    len = data.length;
                    for (var i = 0; i < len; i++) {
                        var tr_str = "<tr>" +
                            "<td class='text-helper'>" + data[i].semester_name + "</td>" +
                            "<td class='text-helper'>" + data[i].semester_status_name +
                            "</td>" +
                            "<td><button class='btn btn-sm btn-danger btn-delete' data-id=" +
                            data[i].id +
                            " ><span class='fe fe-trash-2'></span></button></td>" +
                            "</tr>";
                        $("#userTableBody").append(tr_str);
                    }
                    $(".btn-delete").click(function(e) {
                        var id = $(this).data("id");
                        var route = "/mahasiswa/assignSemester/destroy/" + id
                        $.ajax({
                            type: 'POST',
                            url: route,
                            success: function(data) {
                                $.ajax({
                                    type: 'GET',
                                    url: "{{ route('mahasiswa.getData', $mahasiswa->user_mahasiswa->id) }}",
                                    success: function(data) {
                                        notif({
                                            msg: "<b>Success:</b> Well done Details Submitted Successfully",
                                            type: "success"
                                        });
                                        getData();
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }
        $("#btnSemester").click(function(e) {
            getData();
        });
        $(".btn-submit-{{ $mahasiswa->user_mahasiswa->id }}").click(function(e) {
            e.preventDefault();

            var semester_id = $("select[name=semester_id]").val();
            var semester_status_id = $("select[name=semester_status_id]").val();

            $.ajax({
                type: 'POST',
                url: '/mahasiswa/assignSemester/' + {{ $mahasiswa->user_mahasiswa->id }},
                data: {
                    semester_id: semester_id,
                    semester_status_id: semester_status_id,
                },
                success: function(data) {
                    getData();
                    notif({
                        msg: "<b>Success:</b> Well done Details Submitted Successfully",
                        type: "success"
                    });
                }
            });
        });
    </script>
@endpush
