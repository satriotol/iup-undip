<div class="btn-list">
    <form action="{{ route('admin.reset_password', $mahasiswa->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure?')">
            Reset Password
        </button>
    </form>
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
