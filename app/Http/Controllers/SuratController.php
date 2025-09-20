<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    $query = Surat::query()->orderBy('created_at', 'desc');

    if ($user->role_id == 3) { // Role RW
        $query->where('rw', $user->rw);
    } elseif ($user->role_id == 4) { // Role RT
        $query->where('rt', $user->rt)->where('rw', $user->rw);
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Search by nama / nik
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('nik', 'like', '%' . $request->search . '%');
        });
    }

    $surats = $query->get();

    return view('pages.surat.index', compact('surats'));
}


    public function permohonan(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'jenis_surat' => ['required'],
            'keterangan' => ['required'],
            'telepon' => ['required'],
            'email' => ['required', 'email'], // Tambahkan validasi email
        ]);

        $surat = new Surat();
        $surat->nama = $request->input('nama');
        $surat->nik = $request->input('nik');
        $surat->jenis_surat = $request->input('jenis_surat');
        $surat->keterangan = $request->input('keterangan');
        $surat->telepon = $request->input('telepon');
        $surat->email = $request->input('email');
        $surat->status = 1;
        $surat->saveOrFail();

        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('pages.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'jenis_surat' => 'required',
            'keterangan' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'tanggal' => 'nullable',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $validated['status'] = 2;

        $surat = Surat::findOrFail($id);

        // Handle file upload dengan public_path
        if ($request->hasFile('lampiran')) {
            // Delete old file if exists
            if ($surat->lampiran && file_exists(public_path('storage/' . $surat->lampiran))) {
                File::delete(public_path('storage/' . $surat->lampiran));
            }

            // Create directory if not exists
            if (!file_exists(public_path('storage/surat'))) {
                File::makeDirectory(public_path('storage/surat'), 0755, true);
            }

            // Store new file
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/surat'), $filename);
            $validated['lampiran'] = 'surat/' . $filename;
        }

        $surat->update($validated);

        // return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat');
        return redirect()->route('surat.edit', $surat->id)->with('success', 'Surat berhasil dibuat');
        
    }

    public function mail($id)
    {
        try {
            $surat = Surat::findOrFail($id);

            // Validasi email format
            if (!filter_var($surat->email, FILTER_VALIDATE_EMAIL)) {
                return back()->with('error', 'Format email tidak valid');
            }

            // Cek lampiran dengan public_path
            $attachmentPath = null;
            if ($surat->lampiran) {
                // Gunakan public_path untuk mengakses file
                $attachmentPath = public_path('storage/' . $surat->lampiran);
                
                // Cek apakah file ada
                if (!file_exists($attachmentPath)) {
                    $attachmentPath = null;
                }
            }

            // Log untuk debugging

            // Kirim email
            Mail::to($surat->email)->send(new kirimEmail($surat, $attachmentPath));

            // Update status menjadi 3 (Terkirim) hanya jika email berhasil dikirim
            $surat->update(['status' => Surat::STATUS_TERKIRIM]);

            return back()->with('success', 'Email berhasil dikirim dan status diperbarui');
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function tolak($id)
    {
        try {
            $surat = Surat::findOrFail($id);

            // Validasi email format
            if (!filter_var($surat->email, FILTER_VALIDATE_EMAIL)) {
                return back()->with('error', 'Format email tidak valid');
            }

            // Cek lampiran dengan public_path
            $attachmentPath = null;
            if ($surat->lampiran) {
                // Gunakan public_path untuk mengakses file
                $attachmentPath = public_path('storage/' . $surat->lampiran);
                
                // Cek apakah file ada
                if (!file_exists($attachmentPath)) {
                    $attachmentPath = null;
                }
            }

            // Log untuk debugging

            // Update status menjadi 3 (Terkirim) hanya jika email berhasil dikirim
            $surat->update(['status' => Surat::STATUS_DITOLAK]);

            return back()->with('success', 'Email berhasil ditolak');
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Delete attachment menggunakan public_path
        if ($surat->lampiran && file_exists(public_path('storage/' . $surat->lampiran))) {
            File::delete(public_path('storage/' . $surat->lampiran));
        }
        
        $surat->delete();
        
        return redirect('/surat')->with('success', 'Surat berhasil dihapus!');
    }
}