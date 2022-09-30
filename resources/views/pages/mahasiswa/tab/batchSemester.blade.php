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
                            <tr v-for="batchSemester in batchSemesters">
                                <td>@{{ batchSemester.year }} | @{{ batchSemester.semester }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
@endpush
