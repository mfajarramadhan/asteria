@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Alat</h2>
    <a href="{{ route('tools.create') }}" class="mb-3 btn btn-primary">Tambah Alat</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Jenis Alat</th>
                <th>Spesifikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tools as $tool)
            <tr>
                <td>{{ $tool->nama_alat }}</td>
                <td>{{ $tool->jenis_alat }}</td>
                <td>{{ $tool->spesifikasi }}</td>
                <td>
                    <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
