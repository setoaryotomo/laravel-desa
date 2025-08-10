<?php

namespace App\Http\Controllers;

use App\Models\Anggotakeluarga;
use App\Models\Penghuni;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnggotakeluargaController extends Controller
{
    // Index untuk menampilkan semua anggotakeluarga penghuni tertentu
    public function index($rumahId, $penghuniId)
    {
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);
        $anggotakeluargas = $penghuni->anggotakeluargas()->get();
        return view('pages.anggotakeluarga.index', compact('rumah', 'penghuni', 'anggotakeluargas'));
    }

    // Form create anggotakeluarga untuk penghuni tertentu
    public function create($rumahId, $penghuniId)
    {
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);
        return view('pages.anggotakeluarga.create', compact('rumah', 'penghuni'));
    }

    // Menyimpan anggotakeluarga baru untuk penghuni tertentu
    public function store(Request $request, $rumahId, $penghuniId)
    {
        // Find the rumah and penghuni (verify penghuni belongs to rumah)
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'status_martial' => 'required|in:MENIKAH,JANDA/DUDA,BELUM MENIKAH',
            'pendidikan' => 'required|in:Blm/tidak,SD,SMP,SMA,Diploma,S1,S2,S3',
            'pekerjaan' => 'required|in:swasta,pns,guru,dosen,pensiunan,ibu penghuni tangga,lainnya',
            'tempat_kerja' => 'nullable|string|max:100',
            'status_keluarga' => 'required|in:istri,anak,cucu',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_wa' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create directory if not exists
            // if (!file_exists(public_path('storage/anggotakeluarga/ktp'))) {
            //     File::makeDirectory(public_path('storage/anggotakeluarga/ktp'), 0755, true);
            // }
            
            $file->move(public_path('storage/anggotakeluarga/ktp'), $filename);
            $validated['file_ktp'] = 'anggotakeluarga/ktp/' . $filename;
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create directory if not exists
            // if (!file_exists(public_path('storage/anggotakeluarga/foto'))) {
            //     File::makeDirectory(public_path('storage/anggotakeluarga/foto'), 0755, true);
            // }
            
            $file->move(public_path('storage/anggotakeluarga/foto'), $filename);
            $validated['foto'] = 'anggotakeluarga/foto/' . $filename;
        }

        $validated['penghuni_id'] = $penghuni->id;

        Anggotakeluarga::create($validated);

        return redirect()->route('penghuni.anggotakeluarga.index', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id])
            ->with('success', 'Data anggotakeluarga berhasil ditambahkan');
    }

    // Menampilkan form edit anggotakeluarga
    public function edit($rumahId, $penghuniId, Anggotakeluarga $anggotakeluarga)
    {
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);
        return view('pages.anggotakeluarga.edit', compact('rumah', 'penghuni', 'anggotakeluarga'));
    }

    // Update data anggotakeluarga
    public function update(Request $request, $rumahId, $penghuniId, Anggotakeluarga $anggotakeluarga)
    {
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'status_martial' => 'required|in:MENIKAH,JANDA/DUDA,BELUM MENIKAH',
            'pendidikan' => 'required|in:Blm/tidak,SD,SMP,SMA,Diploma,S1,S2,S3',
            'pekerjaan' => 'required|in:swasta,pns,guru,dosen,pensiunan,ibu penghuni tangga,lainnya',
            'tempat_kerja' => 'nullable|string|max:100',
            'status_keluarga' => 'required|in:istri,anak,cucu',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_wa' => 'nullable|string|max:15',
            'hapus_ktp' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hapus_foto' => 'nullable|boolean',
        ]);

        // Handle file uploads and deletions
        $this->handleFileUpdates($request, $anggotakeluarga, $validated);

        $anggotakeluarga->update($validated);

        return redirect()->route('penghuni.anggotakeluarga.index', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id])
            ->with('success', 'Data anggotakeluarga berhasil diperbarui');
    }

    // Menghapus anggotakeluarga
    public function destroy($rumahId, $penghuniId, Anggotakeluarga $anggotakeluarga)
    {
        $rumah = Rumah::findOrFail($rumahId);
        $penghuni = Penghuni::where('rumah_id', $rumahId)->findOrFail($penghuniId);
        
        // Hapus file terkait
        if ($anggotakeluarga->file_ktp && file_exists(public_path($anggotakeluarga->file_ktp))) {
            File::delete(public_path($anggotakeluarga->file_ktp));
        }

        if ($anggotakeluarga->foto && file_exists(public_path($anggotakeluarga->foto))) {
            File::delete(public_path($anggotakeluarga->foto));
        }

        $anggotakeluarga->delete();

        return redirect()->route('penghuni.anggotakeluarga.index', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id])
            ->with('success', 'Data anggotakeluarga berhasil dihapus');
    }

    /**
     * Handle file uploads and deletions for update
     */
    protected function handleFileUpdates($request, $anggotakeluarga, &$validated)
    {
        // Handle KTP
        if ($request->has('hapus_ktp') && $request->hapus_ktp) {
            if ($anggotakeluarga->file_ktp && file_exists(public_path($anggotakeluarga->file_ktp))) {
                File::delete(public_path($anggotakeluarga->file_ktp));
            }
            $validated['file_ktp'] = null;
        } elseif ($request->hasFile('file_ktp')) {
            // Hapus file lama jika ada
            if ($anggotakeluarga->file_ktp && file_exists(public_path($anggotakeluarga->file_ktp))) {
                File::delete(public_path($anggotakeluarga->file_ktp));
            }
            
            // Create directory if not exists
            // if (!file_exists(public_path('storage/anggotakeluarga/ktp'))) {
            //     File::makeDirectory(public_path('storage/anggotakeluarga/ktp'), 0755, true);
            // }
            
            // Simpan file baru
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/anggotakeluarga/ktp'), $filename);
            $validated['file_ktp'] = 'anggotakeluarga/ktp/' . $filename;
        } else {
            $validated['file_ktp'] = $anggotakeluarga->file_ktp;
        }

        // Handle Foto
        if ($request->has('hapus_foto') && $request->hapus_foto) {
            if ($anggotakeluarga->foto && file_exists(public_path($anggotakeluarga->foto))) {
                File::delete(public_path($anggotakeluarga->foto));
            }
            $validated['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($anggotakeluarga->foto && file_exists(public_path($anggotakeluarga->foto))) {
                File::delete(public_path($anggotakeluarga->foto));
            }
            
            // Create directory if not exists
            // if (!file_exists(public_path('storage/anggotakeluarga/foto'))) {
            //     File::makeDirectory(public_path('storage/anggotakeluarga/foto'), 0755, true);
            // }
            
            // Simpan file baru
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/anggotakeluarga/foto'), $filename);
            $validated['foto'] = 'anggotakeluarga/foto/' . $filename;
        } else {
            $validated['foto'] = $anggotakeluarga->foto;
        }
    }
}