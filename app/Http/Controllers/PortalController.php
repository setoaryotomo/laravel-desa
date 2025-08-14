<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggotakeluarga;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Penghuni;
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
    

//     public function apiSearch(Request $request)
// {
//     $keyword = $request->input('keyword');
//     $searchBy = $request->input('search_by', 'nik');

//     $results = Penghuni::query();

//     if ($keyword) {
//         if ($searchBy === 'nik') {
//             $results->where('nik', 'like', "%$keyword%");
//         } elseif ($searchBy === 'nama') {
//             $results->where('nama', 'like', "%$keyword%");
//         } elseif ($searchBy === 'no_kk') {
//             $results->where('no_kk', 'like', "%$keyword%");
//         }
//     }

//     return response()->json($results->limit(10)->get());
// }

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
    // $penghuni = Penghuni::query();
    $penghuni = Penghuni::query()->with(['rumah' => function($query) {
        $query->select('id', 'no_rumah','alamat_lengkap', 'rt', 'rw' ,'kelurahan','kode_pos');
    }]);
    
    // Query untuk Anggota Keluarga
    // $anggota = Anggotakeluarga::query();
    // $anggota = AnggotaKeluarga::query()->with(['penghuni' => function($query) {
    //     $query->select('id', 'nama as nama_kepala_keluarga');
    // }]);
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

    // Gabungkan hasil dengan UNION (jika menggunakan database yang sama)
    // Atau gabungkan secara manual di PHP
    $resultsPenghuni = $penghuni->limit(5)->get()->map(function($item) {
        $item->type = 'penghuni';
        return $item;
    });

    $resultsAnggota = $anggota->limit(5)->get()->map(function($item) {
        $item->type = 'anggota';
        return $item;
    });

    // Gabungkan hasil dan urutkan
    $combinedResults = $resultsPenghuni->merge($resultsAnggota)->take(10);

    return response()->json($combinedResults);
}

}
