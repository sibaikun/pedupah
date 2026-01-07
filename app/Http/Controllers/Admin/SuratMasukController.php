<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::orderBy('tanggal_terima', 'desc')->get();
        return view('admin.surat-masuk.index', compact('suratMasuk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string',
            'status' => 'required|in:pending,processed,archived',
            'catatan' => 'nullable|string',
            'file_surat' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        $data = $request->only(['nomor_surat', 'tanggal_terima', 'pengirim', 'perihal', 'status', 'catatan']);

        // Upload file jika ada
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-masuk', $filename, 'public');
            $data['file_path'] = $path;
        }

        SuratMasuk::create($data);

        return redirect()->route('admin.surat-masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat);
    }

    public function destroy($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        
        // Hapus file jika ada
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->route('admin.surat-masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus!');
    }
}