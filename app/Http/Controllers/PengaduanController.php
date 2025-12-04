<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Tampilkan daftar pengaduan untuk user
     */
    public function index()
    {
        $pengaduans = auth()->user()->pengaduans()->latest()->get();
        return view('pengaduans.index', compact('pengaduans'));
    }

    /**
     * Tampilkan form create pengaduan
     */
    public function create()
    {
        return view('pengaduans.create');
    }

    /**
     * Simpan pengaduan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('uploads/pengaduan', 'public');
        }

        // Simpan pengaduan
        Pengaduan::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            ...$validated
        ]);

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    /**
     * Tampilkan semua pengaduan untuk admin
     */
    public function adminIndex()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();
        return view('admin.pengaduans.index', compact('pengaduans'));
    }

    /**
     * Tampilkan detail pengaduan untuk admin
     */
    public function adminShow($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('admin.pengaduans.show', compact('pengaduan'));
    }

    /**
     * Update status menjadi diproses
     */
    public function proses($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => 'diproses']);

        return redirect()->back()->with('success', 'Pengaduan sedang diproses!');
    }

    /**
     * Update status menjadi selesai
     */
    public function selesai(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        $validated = $request->validate([
            'tanggapan' => 'required|string'
        ]);

        $pengaduan->update([
            'status' => 'selesai',
            'tanggapan' => $validated['tanggapan']
        ]);

        return redirect()->back()->with('success', 'Pengaduan selesai ditangani!');
    }

    /**
     * Update status menjadi ditolak
     */
    public function tolak(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        $validated = $request->validate([
            'tanggapan' => 'required|string'
        ]);

        $pengaduan->update([
            'status' => 'ditolak',
            'tanggapan' => $validated['tanggapan']
        ]);

        return redirect()->back()->with('success', 'Pengaduan ditolak!');
    }
}