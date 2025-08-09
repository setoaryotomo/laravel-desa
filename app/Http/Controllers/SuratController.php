<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuratController extends Controller
{
    public function index()
    {
        // $surats = Surat::all();
        $surats = Surat::orderBy('created_at', 'desc')->get();
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
            'email' => ['required'],
            // 'lampiran' => ['required'],
        ]);

        $surat = new Surat();
        $surat->nama = $request->input('nama');
        $surat->nik = $request->input('nik');
        $surat->jenis_surat = $request->input('jenis_surat');
        $surat->keterangan = $request->input('keterangan');
        $surat->telepon = $request->input('telepon');
        $surat->email = $request->input('email');
        // $surat->lampiran = $request->input('lampiran');
        $surat->status = 1;
        $surat->saveOrFail();

        // return redirect('/')->with('success','Berhasil, tunggu persetujuan');
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
            'email' => 'required',
            'tanggal' => 'nullable',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $validated['status'] = 2;

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('surat', 'public');
        }

        Surat::findOrFail($id)->update($validated);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat');
    }

    // public function mail($id)
    // {
    //     $surat = Surat::findOrFail($id);

    //     // Pastikan lampiran ada
    //     $attachmentPath = null;
    //     if ($surat->lampiran) {
    //         $attachmentPath = storage_path('app/public/' . $surat->lampiran);
    //     }

    //     Mail::to($surat->email)->send(new kirimEmail($surat, $attachmentPath));

    //     return back()->with('success', 'Email berhasil dikirim');
    // }

    public function mail($id)
    {
        $surat = Surat::findOrFail($id);

        // Pastikan lampiran ada
        $attachmentPath = null;
        if ($surat->lampiran) {
            $attachmentPath = storage_path('app/public/' . $surat->lampiran);
        }

        try {
            Mail::to($surat->email)->send(new kirimEmail($surat, $attachmentPath));

            // Update status menjadi 3 (Terkirim) hanya jika email berhasil dikirim
            $surat->update(['status' => Surat::STATUS_TERKIRIM]);

            return back()->with('success', 'Email berhasil dikirim dan status diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $surats = Surat::findOrFail($id);
        $surats->delete();
        session()->flash('success', 'Surat berhasil dihapus!');
        return redirect('/surat')->with('success','Surat berhasil dihapus!');
    }
}
