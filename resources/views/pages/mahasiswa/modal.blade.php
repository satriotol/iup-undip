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
                    <form action="{{ route('mahasiswa.assignSemester', $mahasiswa->user_mahasiswa->id) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-helper">Semester</label><br>
                            <select name="semester_id" class="form-control select2-show-search form-select"
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
                            <select name="semester_status_id" class="form-control select2-show-search form-select"
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
                            <button class="btn btn-sm btn-success" type="submit">Submit</button>
                        </div>
                    </form>

                    <div class="table-responsive mt-2">
                        <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa->user_mahasiswa->mahasiswa_semesters as $mahasiswa_semester)
                                    <tr>
                                        <td class="text-helper">
                                            {{ $mahasiswa_semester->semester->year }}
                                            |
                                            {{ $mahasiswa_semester->semester->semester }}
                                        </td>
                                        <td class="text-helper">
                                            {{ $mahasiswa_semester->semester_status->name }}
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('mahasiswa.destroySemester', $mahasiswa_semester->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    <span class="fe fe-trash-2">
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
