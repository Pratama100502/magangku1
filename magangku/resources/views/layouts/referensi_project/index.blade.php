@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h1>Daftar Referensi Project</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('referensi.create') }}" class="btn btn-primary mb-3">Tambah Referensi</a>

    @if($referensi->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Referensi Project</th>
                    <th>File</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_referensi_project }}</td>
                    <td>{{ $item->nama_file }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('referensi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('referensi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                        <a href="{{ route('referensi.download', $item->id) }}" class="btn btn-sm btn-success">Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada referensi yang diunggah.</p>
    @endif
</div>
@endsection
