@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Major</h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Major Table</h3>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('major.create') }}" class="btn btn-sm btn-primary" type="button">Create</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($majors as $major)
                                <tr>
                                    <td>{{$major->name}}</td>
                                    <td>$450,870</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
