<?php

namespace App\Http\Controllers;

use App\Models\ReferensiProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReferensiProjectController extends Controller
{
    // Tampilkan semua referensi project peserta
    public function index()
    {
        $referensi = ReferensiProject::with('peserta')->get();
        return view('layouts.referensi_project.index', compact('referensi'));
    }

    // Form tambah
    public function create()
    {
        return view('layouts.referensi_project.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_referensi_project' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('referensi_project', $filename, 'public');

        ReferensiProject::create([
            'user_id' => auth()->id(),
            'nama_referensi_project' => $request->nama_referensi_project,
            'nama_file' => $filename,
        ]);

        return redirect()->route('referensi.index')->with('success', 'Referensi project berhasil ditambahkan.');
    }

    // Form edit
    public function edit(ReferensiProject $referensiProject)
    {
        return view('layouts.referensi_project.edit', compact('referensiProject'));
    }

    // Update data
    public function update(Request $request, ReferensiProject $referensiProject)
    {
        $request->validate([
            'nama_referensi_project' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048', // file opsional saat update
        ]);

        $data = ['nama_referensi_project' => $request->nama_referensi_project];

        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($referensiProject->nama_file) {
                Storage::disk('public')->delete('referensi_project/' . $referensiProject->nama_file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('referensi_project', $filename, 'public');

            $data['nama_file'] = $filename;
        }

        $referensiProject->update($data);

        return redirect()->route('referensi.index')->with('success', 'Referensi project berhasil diupdate.');
    }

    // Hapus data
    public function destroy(ReferensiProject $referensiProject)
    {
        if ($referensiProject->nama_file) {
            Storage::disk('public')->delete('referensi_project/' . $referensiProject->nama_file);
        }

        $referensiProject->delete();

        return redirect()->route('referensi.index')->with('success', 'Referensi project berhasil dihapus.');
    }

    // Download file
    public function download(ReferensiProject $referensiProject)
    {
        $path = 'referensi_project/' . $referensiProject->nama_file;
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($path);
    }
}
