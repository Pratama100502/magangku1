<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LaporanPerbulan;
use Illuminate\Support\Facades\Auth;

class LaporanPerbulanController extends Controller
{
    public function index()
    {
        $files = LaporanPerbulan::orderBy('created_at', 'desc')->get();
        return view('layouts.laporan-perbulan.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan file ke storage/app/public/laporan-perbulan
        $file->storeAs('laporan-perbulan', $filename, 'public');

        // Simpan ke DB
        LaporanPerbulan::create([
            'user_id' => auth()->id(),
            'nama_file' => $filename,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diupload.');
    }

    public function download($id)
    {
        $laporan = LaporanPerbulan::findOrFail($id);
        $path = 'laporan-perbulan/' . $laporan->nama_file;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($path);
    }
}
