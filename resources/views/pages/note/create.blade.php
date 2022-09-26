@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Note</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Note</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($note) {{ route('note.update', [$user_mahasiswa_id, $note->id]) }} @endisset @empty($note) {{ route('note.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($note)
                            @method('PUT')
                        @endisset
                        <h5>Most Recent IELTS/TOEFL iBT SCORE</h5>
                        <div class="form-group">
                            <label>Tanggal Test</label>
                            <input type="date" class="form-control" value="{{ $note->test_date }}" name="test_date">
                        </div>
                        <div class="form-group">
                            <label>Listening</label>
                            <input type="text" class="form-control" value="{{ $note->listening }}" name="listening">
                        </div>
                        <div class="form-group">
                            <label>Reading</label>
                            <input type="text" class="form-control" value="{{ $note->reading }}" name="reading">
                        </div>
                        <div class="form-group">
                            <label>Writing</label>
                            <input type="text" class="form-control" value="{{ $note->writing }}" name="writing">
                        </div>
                        <div class="form-group">
                            <label>Speaking</label>
                            <input type="text" class="form-control" value="{{ $note->speaking }}" name="speaking">
                        </div>
                        <div class="form-group">
                            <label>Overall Score</label>
                            <input type="text" class="form-control" value="{{ $note->overall_score }}"
                                name="overall_score">
                        </div>
                        <hr>
                        <h5>Participation</h5>
                        <div class="form-group">
                            <label>Event 1</label>
                            <input type="text" class="form-control" value="{{ $note->event_1 }}" name="event_1">
                        </div>
                        <div class="form-group">
                            <label>Event 2</label>
                            <input type="text" class="form-control" value="{{ $note->event_2 }}" name="event_2">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Achievement</label>
                            <textarea name="achievement" class="form-control" id="" cols="30" rows="10">{{ $note->achievement }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Informasi Lainnya</label>
                            <textarea name="other_information" class="form-control" id="" cols="30" rows="10">{{ $note->other_information }}</textarea>
                        </div>
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
