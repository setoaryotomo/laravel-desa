<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        return view('pages.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('pages.berita.create');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('pages.berita.edit', compact('berita'));
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Delete the associated file if it exists
        if ($berita->foto_berita && file_exists(public_path('storage/berita/' . basename($berita->foto_berita)))) {
            unlink(public_path('storage/berita/' . basename($berita->foto_berita)));
        }
        
        $berita->delete();
        return redirect('/berita')->with('success', 'Berhasil menghapus data berita');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_berita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_berita')) {
            $file = $request->file('foto_berita');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/berita
            $file->move(public_path('storage/berita'), $filename);
            $validated['foto_berita'] = 'berita/' . $filename;
        }

        Berita::create($validated);
        return redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_berita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_berita')) {
            // Delete old file if it exists
            if ($berita->foto_berita && file_exists(public_path($berita->foto_berita))) {
                unlink(public_path($berita->foto_berita));
            }
            
            // Store new file
            $file = $request->file('foto_berita');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/berita
            $file->move(public_path('storage/berita'), $filename);
            $validated['foto_berita'] = 'berita/' . $filename;
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil diubah');
    }
}
