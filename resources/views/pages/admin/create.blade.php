@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Admin</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Admin</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($admin) {{ route('admin.update', $admin->id) }} @endisset @empty($admin) {{ route('admin.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($admin)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                value="{{ isset($admin) ? $admin->name : @old('name') }}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control"
                                value="{{ isset($admin) ? $admin->email : @old('email') }}" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"
                                @empty($admin)
                            required
                            @endempty>
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                @empty($admin)
                            required
                            @endempty>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" required name="roles">
                                <option value="">Select Role</option>
                                @foreach ($roles as $r)
                                    <option value="{{ $r->id }}"
                                        @isset($admin) @if ($r->id === $admin->roles[0]->id) selected @endif
                                    @endisset>
                                        {{ $r->name }}
                                    </option>
                                @endforeach
                            </select>
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
