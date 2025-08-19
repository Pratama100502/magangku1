@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h1>Tambah Referensi Project</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('referensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Referensi Project</label>
            <input type="text" name="nama_referensi_project" class="form-control" required>
            @error('nama_referensi_project')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>File PDF</label>
            <input type="file" name="file" class="form-control" accept=".pdf" required>
            @error('file')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('referensi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection