<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = SuratKeluar::orderBy('tanggal_kirim', 'desc')->get();
        return view('admin.surat-keluar.index', compact('suratKeluar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'alamat_tujuan' => 'required|string',
            'perihal' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'status' => 'required|in:draft,sent,delivered',
            'penandatangan' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
            'file_lampiran' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        $data = $request->only([
            'nomor_surat', 'tanggal_kirim', 'tujuan', 'alamat_tujuan',
            'perihal', 'isi_surat', 'status', 'penandatangan', 'tembusan'
        ]);

        // Upload file jika ada
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-keluar', $filename, 'public');
            $data['file_path'] = $path;
        }

        SuratKeluar::create($data);

        return redirect()->route('admin.surat-keluar.index')
            ->with('success', 'Surat keluar berhasil dibuat!');
    }

    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return response()->json($surat);
    }

    public function print($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('admin.surat-keluar.print', compact('surat'));
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        
        // Hapus file jika ada
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->route('admin.surat-keluar.index')
            ->with('success', 'Surat keluar berhasil dihapus!');
    }
}