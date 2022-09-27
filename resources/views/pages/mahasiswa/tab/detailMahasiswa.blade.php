<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Password</div>
            </div>
            <div class="card-body">
                <div class="text-center chat-image mb-5">
                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                        <a class="" href="{{ asset('uploads/' . $mahasiswa->photo) }}"><img alt="avatar"
                                src="{{ asset('uploads/' . $mahasiswa->photo) }}" class="brround"></a>
                    </div>
                    <div class="main-chat-msg-name">
                        <a href="profile.html">
                            <h5 class="mb-1 text-dark fw-semibold">{{ $mahasiswa->name }}</h5>
                        </a>
                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{ $mahasiswa->email }}</p>
                    </div>
                </div>
                <form action="{{ route('mahasiswa.updatePassword', $mahasiswa->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control" type="password" placeholder="New Password"
                                name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control" type="password" placeholder="Confirm Password"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="text-end">

                        <button type="submit" href="javascript:void(0)" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Detail</h3>
            </div>
            <div class="card-body">
                <form
                    action="@isset($mahasiswa) {{ route('mahasiswa.update', $mahasiswa->id) }} @endisset @empty($mahasiswa) {{ route('mahasiswa.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($mahasiswa)
                        @method('PUT')
                    @endisset
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control"
                            value="{{ isset($mahasiswa) ? $mahasiswa->name : @old('name') }}" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control"
                            value="{{ isset($mahasiswa) ? $mahasiswa->email : @old('email') }}" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control"
                            value="{{ isset($mahasiswa) ? $mahasiswa->user_mahasiswa->nim : @old('nim') }}"
                            name="nim" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control select2-show-search form-select" required
                                data-placeholder="Pilih Jenis Kelamin">
                                <option label="Pilih Jenis Kelamin"></option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender }}"
                                        @isset($mahasiswa)
                                        {{ $gender == $mahasiswa->user_mahasiswa->gender ? 'selected' : '' }}
                                    @endisset>
                                        {{ $gender }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control"
                                value="{{ isset($mahasiswa) ? $mahasiswa->user_mahasiswa->phone : @old('phone') }}"
                                name="phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Batch</label>
                            <select name="batch_id" class="form-control select2-show-search form-select" required
                                data-placeholder="Pilih Batch">
                                <option label="Pilih Batch"></option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        @isset($mahasiswa)
                                        {{ $batch->id == $mahasiswa->user_mahasiswa->batch_id ? 'selected' : '' }}
                                    @endisset>
                                        {{ $batch->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Major</label>
                            <select name="major_id" class="form-control select2-show-search form-select" required
                                data-placeholder="Pilih Major">
                                <option label="Pilih Major"></option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}"
                                        @isset($mahasiswa)
                                            {{ $major->id == $mahasiswa->user_mahasiswa->major_id ? 'selected' : '' }}
                                            @endisset>
                                        {{ $major->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Negara</label>
                            <select name="country_id" class="form-control select2-show-search form-select" required
                                data-placeholder="Pilih Negara">
                                <option label="Pilih Negara"></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @isset($mahasiswa)
                                        {{ $country->id == $mahasiswa->user_mahasiswa->country_id ? 'selected' : '' }}
                                        @endisset>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="photo" accept="image/*" class="form-control">
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
