@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Referensi Project</h1>

    <form action="{{ route('referensi.update', $referensiProject->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Referensi Project</label>
            <input type="text" name="nama_referensi_project" class="form-control" 
                value="{{ old('nama_referensi_project', $referensiProject->nama_referensi_project) }}" required>
            @error('nama_referensi_project')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ganti File PDF (opsional)</label>
            <input type="file" name="file" class="form-control" accept=".pdf">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('referensi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
