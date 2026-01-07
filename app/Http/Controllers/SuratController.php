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
     * Tampilkan daftar semua surat untuk admin dengan filter dan pagination
     */
    public function adminIndex(Request $request)
    {
        $query = SuratPengajuan::with('user')->latest();

        // Filter berdasarkan search (nama atau NIK)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pagination 15 data per halaman
        $surats = $query->paginate(15)->withQueryString();

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
            "file_pendukung" => "required|file|mimes:pdf,jpg,jpeg,png|max:2048"
        ], [
            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.min' => 'Nomor telepon minimal 10 digit.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 13 digit.',
            'file_pendukung.required' => 'File pendukung wajib diupload.',
            'file_pendukung.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_pendukung.max' => 'Ukuran file maksimal 2MB.',
        ]);

        // Upload file
        $validated["file_pendukung"] = $request->file("file_pendukung")->store("uploads/surat", "public");

        // Simpan ke database
        SuratPengajuan::create([
            "user_id" => auth()->id(),
            "status" => "pending",
            ...$validated
        ]);

        return redirect()->route("dashboard")->with("success", "Pengajuan surat berhasil dikirim!");
    }

    /**
     * Approve surat (untuk admin)
     */
    public function approve($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        
        if ($surat->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya surat dengan status pending yang dapat disetujui!');
        }

        $surat->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Surat berhasil disetujui!');
    }

    /**
     * Reject surat (untuk admin)
     */
    public function reject($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        
        if ($surat->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya surat dengan status pending yang dapat ditolak!');
        }

        $surat->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Surat telah ditolak!');
    }

    /**
     * Download file pendukung
     */
    public function download($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        
        $filePath = storage_path('app/public/' . $surat->file_pendukung);
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }

        return response()->download($filePath);
    }

    /**
     * Hapus pengajuan surat (untuk user)
     */
    public function destroy($id)
    {
        $surat = SuratPengajuan::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();
        
        // Hanya bisa hapus jika status pending atau rejected
        if ($surat->status !== 'pending' && $surat->status !== 'rejected') {
            return redirect()->back()->with('error', 'Hanya pengajuan dengan status pending atau ditolak yang dapat dihapus!');
        }
        
        // Hapus file jika ada
        if ($surat->file_pendukung && \Storage::disk('public')->exists($surat->file_pendukung)) {
            \Storage::disk('public')->delete($surat->file_pendukung);
        }
        
        $surat->delete();
        
        return redirect()->route('surats.index')->with('success', 'Pengajuan surat berhasil dihapus!');
    }
}