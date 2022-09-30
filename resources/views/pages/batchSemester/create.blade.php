@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Batch {{ $batch->year }}</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Batch {{ $batch->year }}</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($batchSemester) {{ route('batchSemester.update', [$batchSemester->id, $batch->id]) }} @endisset @empty($batchSemester) {{ route('batchSemester.store', $batch->id) }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($batchSemester)
                            @method('PUT')
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control"
                                    value="{{ isset($batchSemester) ? $batchSemester->year : @old('year') }}" name="year"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="number" class="form-control"
                                    value="{{ isset($batchSemester) ? $batchSemester->semester : @old('semester') }}"
                                    name="semester" required>
                            </div>
                        @endisset
                        @empty($batchSemester)
                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><input type="number" name="batch[0][year]" placeholder="Tahun" required
                                            class="form-control" />
                                    </td>
                                    <td><input type="number" name="batch[0][semester]" placeholder="Semester" required
                                            class="form-control" />
                                    </td>
                                    <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add
                                            More</button></td>
                                </tr>
                            </table>
                        @endempty
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ url()->previous() }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script type="text/javascript">
        var i = 1;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr>' +
                '<td><input type="number" required name="batch[' + i +
                '][year]" placeholder="Tahun" class="form-control" /></td>' +
                '<td><input type="number" required name="batch[' + i +
                '][semester]" placeholder="Semester" class="form-control" /></td>' +
                '<td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>' +
                '</tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
