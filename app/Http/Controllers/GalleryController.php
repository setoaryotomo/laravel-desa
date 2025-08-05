<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallerys = Gallery::all();
        return view('pages.gallery.index', compact('gallerys'));
    }

    public function create()
    {
        return view('pages.gallery.create');
    }
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('pages.gallery.edit', compact('gallery'));
    }
    public function destroy($id)
    {
        $gallerys = Gallery::findOrFail($id);
        $gallerys->delete();
        return redirect('/gallery')->with('success','berhasil hapus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_gallery' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_gallery')) {
            $validated['foto_gallery'] = $request->file('foto_gallery')->store('gallery', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('gallery.index')->with('success', 'Data gallery berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_gallery' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_gallery')) {
            $validated['foto_gallery'] = $request->file('foto_gallery')->store('gallery', 'public');
        }

        // Gallery::findOrFail($id)->update($request->validated());
        Gallery::findOrFail($id)->update($validated);

        return redirect()->route('gallery.index')->with('success', 'Data gallery berhasil diubah');
    }
}
