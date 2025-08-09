<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $gallery = Gallery::findOrFail($id);
        
        // Delete the associated file if it exists
        if ($gallery->foto_gallery && file_exists(public_path('storage/gallery/' . basename($gallery->foto_gallery)))) {
            unlink(public_path('storage/gallery/' . basename($gallery->foto_gallery)));
        }
        
        $gallery->delete();
        return redirect('/gallery')->with('success', 'Berhasil menghapus data gallery');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_gallery' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_gallery')) {
            $file = $request->file('foto_gallery');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/gallery
            $file->move(public_path('storage/gallery'), $filename);
            $validated['foto_gallery'] = 'gallery/' . $filename;
        }

        Gallery::create($validated);
        return redirect()->route('gallery.index')->with('success', 'Data gallery berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_gallery' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_gallery')) {
            // Delete old file if it exists
            if ($gallery->foto_gallery && file_exists(public_path($gallery->foto_gallery))) {
                unlink(public_path($gallery->foto_gallery));
            }
            
            // Store new file
            $file = $request->file('foto_gallery');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/gallery
            $file->move(public_path('storage/gallery'), $filename);
            $validated['foto_gallery'] = 'gallery/' . $filename;
        }

        $gallery->update($validated);

        return redirect()->route('gallery.index')->with('success', 'Data gallery berhasil diubah');
    }
}