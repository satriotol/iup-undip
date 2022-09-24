<div class="btn-list">
    <form action="{{ route('admin.reset_password', $mahasiswa->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure?')">
            Reset Password
        </button>
    </form>
    <button class="btn btn-sm btn-secondary btn-{{ $mahasiswa->user_mahasiswa->id }} bg-secondary-gradient m-0"
        data-bs-toggle="modal"
        data-bs-target="#extralargemodal-{{ $mahasiswa->user_mahasiswa->id }}">Semester</button><br>
    @include('pages.mahasiswa.modal')
    @if ($mahasiswa->user_mahasiswa->international_mahasiswa)
        <a href="{{ route('internationalMahasiswa.edit', [$mahasiswa->user_mahasiswa->id, $mahasiswa->user_mahasiswa->international_mahasiswa->id]) }}"
            class="btn btn-sm btn-success m-0">Internasional</a>
    @else
        <a href="{{ route('internationalMahasiswa.create', $mahasiswa->user_mahasiswa->id) }}"
            class="btn btn-sm btn-success m-0">Internasional</a>
    @endif
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
