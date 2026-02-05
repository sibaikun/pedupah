<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratKeluar::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%")
                  ->orWhere('perihal', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $suratKeluar = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.surat-keluar.index', compact('suratKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat-keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'alamat_tujuan' => 'required|string',
            'perihal' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'status' => 'required|in:draft,sent,delivered',
            'penandatangan' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-keluar', $filename, 'public');
            $validated['file_path'] = $path;
        }

        SuratKeluar::create($validated);

        return redirect()->route('admin.surat-keluar.index')
            ->with('success', 'Surat keluar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('admin.surat-keluar.show', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('admin.surat-keluar.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'alamat_tujuan' => 'required|string',
            'perihal' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'status' => 'required|in:draft,sent,delivered',
            'penandatangan' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
                Storage::disk('public')->delete($surat->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-keluar', $filename, 'public');
            $validated['file_path'] = $path;
        }

        $surat->update($validated);

        return redirect()->route('admin.surat-keluar.index')
            ->with('success', 'Surat keluar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surat = SuratKeluar::findOrFail($id);

        // Delete file if exists
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->route('admin.surat-keluar.index')
            ->with('success', 'Surat keluar berhasil dihapus!');
    }

    /**
     * Print the surat to PDF.
     */
    public function print(string $id)
    {
        try {
            $surat = SuratKeluar::findOrFail($id);
            
            // Load view with data
            $pdf = Pdf::loadView('admin.surat-keluar.print', compact('surat'));
            
            // Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');
            
            // Generate filename yang aman (tanpa karakter spesial)
            $filename = 'surat-keluar-' . str_replace(['/', '\\', ' '], '-', $surat->nomor_surat) . '.pdf';
            
            // Download PDF
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->route('admin.surat-keluar.index')
                ->with('error', 'Gagal mencetak PDF: ' . $e->getMessage());
        }
    }
}