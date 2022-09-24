@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="modal fade" id="extralargemodal-{{ $mahasiswa->user_mahasiswa->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Semester {{ $mahasiswa->name }}
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form>
                        <div class="form-group">
                            <label class="text-helper">Semester</label><br>
                            <select name="semester_id-{{ $mahasiswa->user_mahasiswa->id }}"
                                class="form-control select2-show-search form-select" required
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
                            <select name="semester_status_id-{{ $mahasiswa->user_mahasiswa->id }}"
                                class="form-control select2-show-search form-select" required
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

                    <div class="table-responsive mt-2">
                        <table class="table border text-nowrap text-md-nowrap table-hover mb-0"
                            id="userTable-{{ $mahasiswa->user_mahasiswa->id }}">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody-{{ $mahasiswa->user_mahasiswa->id }}">
                            </tbody>
                        </table>
                    </div>
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
        var getData = function(master) {
            $.ajax({
                type: 'GET',
                url: "mahasiswa/getData/ " + master,
                success: function(data) {
                    console.log(data);
                    var len = 0;
                    $('#userTableBody-' + master).empty();
                    len = data.length;
                    for (var i = 0; i < len; i++) {
                        var tr_str = "<tr>" +
                            "<td class='text-helper'>" + data[i].semester_name + "</td>" +
                            "<td class='text-helper'>" + data[i].semester_status_name + "</td>" +
                            "<td><button class='btn btn-sm btn-danger btn-delete' data-id=" + data[i].id +
                            " ><span class='fe fe-trash-2'></span></button></td>" +
                            "</tr>";
                        $("#userTableBody-" + master).append(tr_str);
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
                                        getData(master);

                                    }
                                });
                            }
                        });
                    });
                }
            });
        }
        $(".btn-{{ $mahasiswa->user_mahasiswa->id }}").click(function(e) {
            var master = $(this).data("master");
            getData(master);
        });
        $(".btn-submit-{{ $mahasiswa->user_mahasiswa->id }}").click(function(e) {
            var master = $(this).data("master");
            e.preventDefault();

            var semester_id = $("select[name=semester_id-" + master + "]").val();
            var semester_status_id = $("select[name=semester_status_id-" + master + "]").val();
            console.log(semester_status_id);

            $.ajax({
                type: 'POST',
                url: '/mahasiswa/assignSemester/' + master,
                data: {
                    semester_id: semester_id,
                    semester_status_id: semester_status_id,
                },
                success: function(data) {
                    getData(master);
                    notif({
                        msg: "<b>Success:</b> Well done Details Submitted Successfully",
                        type: "success"
                    });
                }
            });
        });
    </script>
@endpush
