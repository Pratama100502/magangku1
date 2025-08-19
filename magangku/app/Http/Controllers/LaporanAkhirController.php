<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        $files = LaporanAkhir::with('user')->orderBy('created_at', 'desc')->get();
        return view('layouts.laporan-akhir.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->storeAs('laporan-akhir', $filename, 'public');

        LaporanAkhir::create([
            'user_id' => auth()->id(),
            'nama_file' => $filename,
        ]);

        return redirect()->route('laporan-akhir.index')->with('success', 'Laporan akhir berhasil diupload.');
    }

    public function download($id)
    {
        $laporan = LaporanAkhir::findOrFail($id);
        $path = 'laporan-akhir/' . $laporan->nama_file;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($path);
    }
}
