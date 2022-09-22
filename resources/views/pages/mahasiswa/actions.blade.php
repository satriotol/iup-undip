<div class="btn-list">
    <button class="btn btn-sm btn-secondary bg-secondary-gradient m-0" data-bs-toggle="modal"
        data-bs-target="#extralargemodal-{{ $mahasiswa->user_mahasiswa->id }}">Semester</button>
    @include('pages.mahasiswa.modal')
    <form action="{{ route('admin.reset_password', $mahasiswa->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure?')">
            Reset Password
        </button>
    </form>
    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
        <a class="btn btn-sm btn-primary" href="{{ route('mahasiswa.edit', $mahasiswa->id) }}">
            <span class="fe fe-edit"> </span>
        </a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
            <span class="fe fe-trash-2"> </span>
        </button>
    </form>
</div>
