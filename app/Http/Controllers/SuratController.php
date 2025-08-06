<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::all();
        return view('pages.surat.index', compact('surats'));
    }


    public function permohonan(Request $request) {
        $validated = $request->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'jenis_surat' => ['required'],
            'keterangan' => ['required'],
            'telepon' => ['required'],
            'email' => ['required'],
            'lampiran' => ['required'],
        ]);

        $surat = new Surat();
        $surat->nama = $request->input('nama');
        $surat->nik = $request->input('nik');
        $surat->jenis_surat = $request->input('jenis_surat');
        $surat->keterangan = $request->input('keterangan');
        $surat->telepon = $request->input('telepon');
        $surat->email = $request->input('email');
        $surat->lampiran = $request->input('lampiran');
        $surat->status = 1;
        $surat->saveOrFail();

        // return redirect('/')->with('success','Berhasil, tunggu persetujuan');
        return back()->with('success', 'Permohonan berhasil dikirim!');
    }
}
