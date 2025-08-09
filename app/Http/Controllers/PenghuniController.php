<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PenghuniController extends Controller
{
    // Index untuk menampilkan semua penghuni rumah tertentu
    public function index(Rumah $rumah)
    {
        $penghunis = $rumah->penghunis()->orderBy('is_kepala_keluarga', 'desc')->get();
        return view('pages.penghuni.index', compact('rumah', 'penghunis'));
    }

    // Form create penghuni untuk rumah tertentu
    public function create(Rumah $rumah)
    {
        return view('pages.penghuni.create', compact('rumah'));
    }

    // Menyimpan penghuni baru untuk rumah tertentu
    public function store(Request $request, Rumah $rumah)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'status_martial' => 'required|in:MENIKAH,JANDA/DUDA,BELUM MENIKAH',
            'pendidikan' => 'required|in:Blm/tidak,SD,SMP,SMA,Diploma,S1,S2,S3',
            'pekerjaan' => 'required|in:swasta,pns,guru,dosen,pensiunan,ibu rumah tangga,lainnya',
            'tempat_kerja' => 'nullable|string|max:100',
            'status_penghuni' => 'required|in:pemilik rumah,kontrak,boro',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_kepala_keluarga' => 'required|boolean',
            'no_wa' => 'nullable|string|max:15',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/penghuni/ktp'), $filename);
            $validated['file_ktp'] = 'penghuni/ktp/' . $filename;
        }
        
        if ($request->hasFile('kartu_keluarga')) {
            $file = $request->file('kartu_keluarga');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/penghuni/kk'), $filename);
            $validated['kartu_keluarga'] = 'penghuni/kk/' . $filename;
        }

        // Tambahkan rumah_id ke data yang divalidasi
        $validated['rumah_id'] = $rumah->id;

        Penghuni::create($validated);

        return redirect()->route('rumah.penghuni.index', $rumah->id)
            ->with('success', 'Data penghuni berhasil ditambahkan');
    }

    // Menampilkan form edit penghuni
    public function edit(Rumah $rumah, Penghuni $penghuni)
    {
        return view('pages.penghuni.edit', compact('rumah', 'penghuni'));
    }

    // Update data penghuni
    public function update(Request $request, Rumah $rumah, Penghuni $penghuni)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'status_martial' => 'required|in:MENIKAH,JANDA/DUDA,BELUM MENIKAH',
            'pendidikan' => 'required|in:Blm/tidak,SD,SMP,SMA,Diploma,S1,S2,S3',
            'pekerjaan' => 'required|in:swasta,pns,guru,dosen,pensiunan,ibu rumah tangga,lainnya',
            'tempat_kerja' => 'nullable|string|max:100',
            'status_penghuni' => 'required|in:pemilik rumah,kontrak,boro',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_kepala_keluarga' => 'required|boolean',
            'no_wa' => 'nullable|string|max:15',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'hapus_ktp' => 'nullable|boolean',
            'hapus_kk' => 'nullable|boolean',
        ]);

        // Handle file uploads and deletions
        $this->handleFileUpdates($request, $penghuni, $validated);

        $penghuni->update($validated);

        return redirect()->route('rumah.penghuni.index', $rumah->id)
            ->with('success', 'Data penghuni berhasil diperbarui');
    }

    // Menghapus penghuni
    public function destroy(Rumah $rumah, Penghuni $penghuni)
    {
        // Hapus file terkait
        if ($penghuni->file_ktp && file_exists(public_path($penghuni->file_ktp))) {
            File::delete(public_path($penghuni->file_ktp));
        }
        if ($penghuni->kartu_keluarga && file_exists(public_path($penghuni->kartu_keluarga))) {
            File::delete(public_path($penghuni->kartu_keluarga));
        }

        $penghuni->delete();

        return redirect()->route('rumah.penghuni.index', $rumah->id)
            ->with('success', 'Data penghuni berhasil dihapus');
    }

    /**
     * Handle file uploads and deletions for update
     */
    protected function handleFileUpdates($request, $penghuni, &$validated)
    {
        // Handle KTP
        if ($request->has('hapus_ktp') && $request->hapus_ktp) {
            if ($penghuni->file_ktp && file_exists(public_path($penghuni->file_ktp))) {
                File::delete(public_path($penghuni->file_ktp));
            }
            $validated['file_ktp'] = null;
        } elseif ($request->hasFile('file_ktp')) {
            // Hapus file lama jika ada
            if ($penghuni->file_ktp && file_exists(public_path($penghuni->file_ktp))) {
                File::delete(public_path($penghuni->file_ktp));
            }
            
            // Simpan file baru
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/penghuni/ktp'), $filename);
            $validated['file_ktp'] = 'penghuni/ktp/' . $filename;
        } else {
            $validated['file_ktp'] = $penghuni->file_ktp;
        }

        // Handle Kartu Keluarga
        if ($request->has('hapus_kk') && $request->hapus_kk) {
            if ($penghuni->kartu_keluarga && file_exists(public_path($penghuni->kartu_keluarga))) {
                File::delete(public_path($penghuni->kartu_keluarga));
            }
            $validated['kartu_keluarga'] = null;
        } elseif ($request->hasFile('kartu_keluarga')) {
            // Hapus file lama jika ada
            if ($penghuni->kartu_keluarga && file_exists(public_path($penghuni->kartu_keluarga))) {
                File::delete(public_path($penghuni->kartu_keluarga));
            }
            
            // Simpan file baru
            $file = $request->file('kartu_keluarga');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/penghuni/kk'), $filename);
            $validated['kartu_keluarga'] = 'penghuni/kk/' . $filename;
        } else {
            $validated['kartu_keluarga'] = $penghuni->kartu_keluarga;
        }
    }
}