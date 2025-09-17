<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggotakeluarga;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Penghuni;
use App\Models\Surat;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function homepage() {
        $beritas = Berita::all();
        $agendas = Agenda::all();
        $gallerys = Gallery::all();
        return view('pages.portal.index',[
            'beritas' => $beritas,
            'agendas' => $agendas,
            'gallerys' => $gallerys,
        ]);
    }

    public function berita($id){
        $berita = Berita::findOrFail($id);
        return view('pages.portal.detail.berita', compact('berita'));
    }
    
    public function agenda($id){
        $agenda = Agenda::findOrFail($id);
        return view('pages.portal.detail.agenda', compact('agenda'));
    }
    
    public function gallery($id){
        $gallery = gallery::findOrFail($id);
        return view('pages.portal.detail.gallery', compact('gallery'));
    }

    public function apiSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $searchBy = $request->input('search_by', 'nik');

        // Validasi input
        $request->validate([
            'keyword' => 'nullable|string|max:100',
            'search_by' => 'required|in:nik,nama,no_kk'
        ]);

        // Query untuk Penghuni (Kepala Keluarga)
        $penghuni = Penghuni::query()->with(['rumah' => function($query) {
            $query->select('id', 'no_rumah','alamat_lengkap', 'rt', 'rw' ,'kelurahan','kode_pos');
        }]);
        
        // Query untuk Anggota Keluarga
        $anggota = AnggotaKeluarga::query()->with([
            'penghuni' => function($query) {
                $query->select('id', 'nama as nama_kepala_keluarga', 'rumah_id');
            },
            'penghuni.rumah' => function($query) {
                $query->select('id','no_rumah', 'alamat_lengkap', 'rt', 'rw', 'kelurahan', 'kode_pos');
            }
        ]);

        if ($keyword) {
            $searchTerm = "%$keyword%";
            
            if ($searchBy === 'nik') {
                $penghuni->where('nik', 'like', $searchTerm);
                $anggota->where('nik', 'like', $searchTerm);
            } elseif ($searchBy === 'nama') {
                $penghuni->where('nama', 'like', $searchTerm);
                $anggota->where('nama', 'like', $searchTerm);
            } elseif ($searchBy === 'no_kk') {
                $penghuni->where('no_kk', 'like', $searchTerm);
                $anggota->where('no_kk', 'like', $searchTerm);
            }
        }

        // Gabungkan hasil
        $resultsPenghuni = $penghuni->limit(5)->get()->map(function($item) {
            $item->type = 'penghuni';
            return $item;
        });

        $resultsAnggota = $anggota->limit(5)->get()->map(function($item) {
            $item->type = 'anggota';
            return $item;
        });

        $combinedResults = $resultsPenghuni->merge($resultsAnggota)->take(10);

        return response()->json($combinedResults);
    }

    // New API endpoint for letter form autocomplete
    public function apiAutocompleteResident(Request $request)
    {
        $keyword = $request->input('keyword');
        
        if (!$keyword || strlen($keyword) < 2) {
            return response()->json([]);
        }

        // Validasi input
        $request->validate([
            'keyword' => 'required|string|max:100'
        ]);

        $searchTerm = "%$keyword%";

        // Query untuk Penghuni
        $penghuni = Penghuni::query()
            ->select('id', 'nama', 'nik', 'tgl_lahir', 'no_hp')
            ->where(function($query) use ($searchTerm) {
                $query->where('nama', 'like', $searchTerm)
                      ->orWhere('nik', 'like', $searchTerm);
            })
            ->limit(5)
            ->get()
            ->map(function($item) {
                $item->type = 'penghuni';
                $item->display_name = $item->nama . ' - ' . $item->nik;
                return $item;
            });

        // Query untuk Anggota Keluarga
        $anggota = AnggotaKeluarga::query()
            ->select('id', 'nama', 'nik', 'tgl_lahir', 'no_hp')
            ->where(function($query) use ($searchTerm) {
                $query->where('nama', 'like', $searchTerm)
                      ->orWhere('nik', 'like', $searchTerm);
            })
            ->limit(5)
            ->get()
            ->map(function($item) {
                $item->type = 'anggota';
                $item->display_name = $item->nama . ' - ' . $item->nik;
                return $item;
            });

        $combinedResults = $penghuni->merge($anggota)->take(8);

        return response()->json($combinedResults);
    }

    public function permohonan(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'tgl_lahir' => ['required', 'date'],
            'jenis_surat' => ['required'],
            'keterangan' => ['required'],
            'no_hp' => ['required'],
            'email' => ['required', 'email'],
        ]);

        // Verifikasi data dengan tanggal lahir
        $isValidResident = $this->verifyResidentData(
            $request->input('nik'),
            $request->input('nama'),
            $request->input('tgl_lahir')
        );

        if (!$isValidResident) {
            return redirect('/#surat')->withErrors([
                'verification' => 'Data yang Anda masukkan tidak sesuai dengan database. Pastikan NIK, Nama, dan Tanggal Lahir benar.'
            ])->withInput();
        }

        $surat = new Surat();
        $surat->nama = $request->input('nama');
        $surat->nik = $request->input('nik');
        $surat->jenis_surat = $request->input('jenis_surat');
        $surat->keterangan = $request->input('keterangan');
        $surat->telepon = $request->input('no_hp');
        $surat->email = $request->input('email');
        $surat->status = 1;
        $surat->saveOrFail();

        // return back()->with('success', 'Permohonan berhasil dikirim!');
        // return redirect('/#surat')->with('success', 'Permohonan Anda berhasil dikirim!');
        return back()->with('success', 'Permohonan Anda berhasil dikirim!')->withFragment('surat');

    }

    // Helper method to verify resident data
    private function verifyResidentData($nik, $nama, $tglLahir)
    {
        // Check in Penghuni table
        $penghuni = Penghuni::where('nik', $nik)
            ->where('nama', $nama)
            ->where('tgl_lahir', $tglLahir)
            ->first();

        if ($penghuni) {
            return true;
        }

        // Check in AnggotaKeluarga table
        $anggota = AnggotaKeluarga::where('nik', $nik)
            ->where('nama', $nama)
            ->where('tgl_lahir', $tglLahir)
            ->first();

        return $anggota ? true : false;
    }
}