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
        $beritas = Berita::findOrFail($id);
        $beritas->delete();
        return redirect('/berita')->with('success','berhasil hapus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_berita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_berita')) {
            $validated['foto_berita'] = $request->file('foto_berita')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_berita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_berita')) {
            $validated['foto_berita'] = $request->file('foto_berita')->store('berita', 'public');
        }

        // Berita::findOrFail($id)->update($request->validated());
        Berita::findOrFail($id)->update($validated);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil diubah');
    }
}
