@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h1>Daftar Laporan Perbulan</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('laporan.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="file" name="file" class="form-control" required>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        @error('file')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </form>

    @if($files->count() > 0)
    <ul class="list-group">
        @foreach($files as $file)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $file->nama_file }}</strong><br>
                <small class="text-muted">Diunggah: {{ $file->created_at->format('d M Y H:i') }}</small>
            </div>
            <a href="{{ route('laporan.download', $file->id) }}" class="btn btn-sm btn-success">Download</a>
        </li>
        @endforeach
    </ul>

    @else
    <p>Tidak ada laporan yang diunggah.</p>
    @endif
</div>
@endsection