@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
    + Tambah User
</a>

    {{-- flash alert sukses (setelah store / update / delete) --}}
    @if (session('success'))
        <div id="flash-success" data-msg="{{ session('success') }}"></div>
    @endif

    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->level }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <button class="btn btn-danger btn-sm"
                        onclick="confirmDelete({{ $user->id }})">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    // aktifkan DataTables
    $('#users-table').DataTable();

    // jika ada flash sukses, tampilkan SweetAlert
    const flash = $('#flash-success').data('msg');
    if (flash) swal("Berhasil", flash, "success");
});

/**
 * Konfirmasi hapus + kirim DELETE via Axios
 */
function confirmDelete(id) {
    swal({
        title: "Yakin ingin menghapus?",
        text: "Data user akan hilang permanen!",
        icon: "warning",
        buttons: ["Batal", "Hapus!"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            axios.delete(`/users/${id}`)
                 .then(() => {
                     swal("Terhapus!", "User berhasil dihapus.", "success")
                         .then(() => location.reload());
                 })
                 .catch(() => {
                     swal("Gagal", "Terjadi kesalahan.", "error");
                 });
        }
    });
}
</script>
@endpush