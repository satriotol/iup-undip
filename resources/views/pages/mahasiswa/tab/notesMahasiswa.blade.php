@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Additional Notes</h3>
            </div>
            <div class="card-body">
                <h5>Most Recent IELTS/TOEFL iBT SCORE</h5>
                <div class="form-group">
                    <label>Tanggal Test</label>
                    <input type="date" class="form-control" value="" name="test_date">
                </div>
                <div class="form-group">
                    <label>Listening</label>
                    <input type="text" class="form-control" value="" name="listening">
                </div>
                <div class="form-group">
                    <label>Reading</label>
                    <input type="text" class="form-control" value="" name="reading">
                </div>
                <div class="form-group">
                    <label>Writing</label>
                    <input type="text" class="form-control" value="" name="writing">
                </div>
                <div class="form-group">
                    <label>Speaking</label>
                    <input type="text" class="form-control" value="" name="speaking">
                </div>
                <div class="form-group">
                    <label>Overall Score</label>
                    <input type="text" class="form-control" value="" name="overall_score">
                </div>
                <hr>
                <h5>Participation</h5>
                <div class="form-group">
                    <label>Event 1</label>
                    <input type="text" class="form-control" value="" name="event_1">
                </div>
                <div class="form-group">
                    <label>Event 2</label>
                    <input type="text" class="form-control" value="" name="event_2">
                </div>
                <hr>
                <div class="form-group">
                    <label>Achievement</label>
                    <textarea name="achievement" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label>Informasi Lainnya</label>
                    <textarea name="other_information" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="text-end">
                    <button class="btn btn-sm btn-success btn-submitNote-{{ $mahasiswa->user_mahasiswa->id }}"
                        data-master="{{ $mahasiswa->user_mahasiswa->id }}">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Additional Notes</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table border text-nowrap text-md-nowrap table-hover mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>Tanggal Test</th>
                                <th>Listening</th>
                                <th>Reading</th>
                                <th>Writing</th>
                                <th>Speaking</th>
                                <th>Overall Score</th>
                                <th>Event 1</th>
                                <th>Event 2</th>
                                <th>Achievement</th>
                                <th>Informasi Lainnya</th>
                            </tr>
                        </thead>
                        <tbody id="userTableNoteBody">
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

        var getDataNote = function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('note.index', $mahasiswa->user_mahasiswa->id) }}",
                success: function(data) {
                    var len = 0;
                    $('#userTableNoteBody').empty();
                    len = data.length;
                    for (var i = 0; i < len; i++) {
                        var tr_str = "<tr>" +
                            "<td class='text-helper'>" + data[i].test_date + "</td>" +
                            "<td class='text-helper'>" + data[i].listening + "</td>" +
                            "<td class='text-helper'>" + data[i].reading + "</td>" +
                            "<td class='text-helper'>" + data[i].writing + "</td>" +
                            "<td class='text-helper'>" + data[i].speaking + "</td>" +
                            "<td class='text-helper'>" + data[i].overall_score + "</td>" +
                            "<td class='text-helper'>" + data[i].event_1 + "</td>" +
                            "<td class='text-helper'>" + data[i].event_2 + "</td>" +
                            "<td class='text-helper'>" + data[i].achievement + "</td>" +
                            "<td class='text-helper'>" + data[i].other_information + "</td>" +
                            "<td><button class='btn btn-sm btn-danger btn-delete' data-idnote=" +
                            data[i].id +
                            " ><span class='fe fe-trash-2'></span></button></td>" +
                            "</tr>";
                        $("#userTableNoteBody").append(tr_str);
                    }
                    $(".btn-delete").click(function(e) {
                        var idnote = $(this).data("idnote");
                        var route = "/note/" + idnote + "/destroy"
                        $.ajax({
                            type: 'POST',
                            url: route,
                            success: function(data) {
                                notif({
                                    msg: "<b>Success:</b> Well done Details Submitted Successfully",
                                    type: "success"
                                });
                                getDataNote();
                            }
                        });
                    });
                }
            });
        }
        $("#btnNote").click(function(e) {
            getDataNote();
        });
        $(".btn-submitNote-{{ $mahasiswa->user_mahasiswa->id }}").click(function(e) {
            e.preventDefault();

            var test_date = $("input[name=test_date]").val();
            var listening = $("input[name=listening]").val();
            var reading = $("input[name=reading]").val();
            var writing = $("input[name=writing]").val();
            var speaking = $("input[name=speaking]").val();
            var overall_score = $("input[name=overall_score]").val();
            var event_1 = $("input[name=event_1]").val();
            var event_2 = $("input[name=event_2]").val();
            var achievement = $("textarea[name=achievement]").val();
            var other_information = $("textarea[name=other_information]").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('note.store', $mahasiswa->user_mahasiswa->id) }}",
                data: {
                    test_date: test_date,
                    listening: listening,
                    reading: reading,
                    writing: writing,
                    speaking: speaking,
                    overall_score: overall_score,
                    event_1: event_1,
                    event_2: event_2,
                    achievement: achievement,
                    other_information: other_information,
                },
                success: function(data) {
                    getDataNote();
                    notif({
                        msg: "<b>Success:</b> Well done Details Submitted Successfully",
                        type: "success"
                    });
                }
            });
        });
    </script>
@endpush
