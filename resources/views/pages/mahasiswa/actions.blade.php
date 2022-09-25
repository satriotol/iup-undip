<div class="btn-list">
    <form action="{{ route('admin.reset_password', $mahasiswa->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure?')">
            Reset Password
        </button>
    </form>
    <button data-master="{{ $mahasiswa->user_mahasiswa->id }}"
        class="btn btn-sm btn-secondary btn-{{ $mahasiswa->user_mahasiswa->id }} bg-secondary-gradient m-0"
        data-bs-toggle="modal"
        data-bs-target="#extralargemodal-{{ $mahasiswa->user_mahasiswa->id }}">Semester</button><br>
    @include('pages.mahasiswa.modal')
    <br>
    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-sm btn-primary m-0">Detail</a>
    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
            Hapus
        </button>
    </form>
</div>
