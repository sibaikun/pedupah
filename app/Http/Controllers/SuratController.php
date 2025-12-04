<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengajuan;

class SuratController extends Controller
{
    /**
     * Tampilkan daftar surat untuk user
     */
    public function userIndex()
    {
        $surats = auth()->user()->suratPengajuans()->latest()->get();
        return view('surats.index', compact('surats'));
    }

    /**
     * Tampilkan daftar semua surat untuk admin
     */
    public function adminIndex()
    {
        $surats = SuratPengajuan::with('user')->latest()->get();
        return view('admin.surats.index', compact('surats'));
    }

    /**
     * Tampilkan detail surat (untuk admin)
     */
    public function show($id)
    {
        $surat = SuratPengajuan::with('user')->findOrFail($id);
        return view('admin.surats.show', compact('surat'));
    }

    /**
     * Tampilkan form create surat
     */
    public function create()
    {   
        return view('surats.create');
    }

    /**
     * Simpan surat baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nama_pemohon" => "required|string|max:255",
            "nik" => "required|string|size:16",
            "alamat" => "required|string",
            "nomor_telepon" => "required|string|min:10|max:13",
            "tanggal_lahir" => "required|date",
            "tempat_lahir" => "required|string|max:255",
            "jenis_kelamin" => "required|in:Laki-laki,Perempuan",
            "jenis_surat" => "required|string",
            "keperluan" => "required|string",
            "file_pendukung" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048" // max 2MB
        ]);

        // Upload file
        $validated["file_pendukung"] = $request->file("file_pendukung")->store("uploads/surat", "public");

        // Simpan ke database
        SuratPengajuan::create([
            "user_id" => auth()->id(),
            "status" => "pending", // Set default status
            ...$validated
        ]);

        return redirect()->route("surats.index")->with("success", "Pengajuan surat berhasil dikirim!");
    }

    /**
     * Approve surat (untuk admin)
     */
    public function approve($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        $surat->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Surat berhasil disetujui!');
    }

    /**
     * Reject surat (untuk admin)
     */
    public function reject($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        $surat->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Surat berhasil ditolak!');
    }
}