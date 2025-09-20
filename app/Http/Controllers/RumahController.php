<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;

class RumahController extends Controller
{
    public function index()
    {
        $rumahs = Rumah::all();
        return view('pages.rumah.index', compact('rumahs'));
    }

    public function create()
    {
        return view('pages.rumah.create');
    }
    public function edit($id)
    {
        $rumah = Rumah::findOrFail($id);

        return view('pages.rumah.edit', compact('rumah'));
    }
    public function destroy($id)
    {
        $rumahs = Rumah::findOrFail($id);
        $rumahs->delete();
        return redirect('/rumah')->with('success','berhasil hapus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_lengkap' => 'required',
            'no_rumah' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'lokasi' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'sertifikat_an' => 'required',
            'luas_tanah' => 'required|numeric',
            'foto_tampak_depan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_tampak_depan')) {
            $file = $request->file('foto_tampak_depan');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/rumah
            $file->move(public_path('storage/rumah'), $filename);
            $validated['foto_tampak_depan'] = 'rumah/' . $filename;
        }
        
        // if ($request->hasFile('foto_tampak_depan')) {
        //     $validated['foto_tampak_depan'] = $request->file('foto_tampak_depan')->store('rumah', 'public');
        // }

        Rumah::create($validated);

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $rumah = Rumah::findOrFail($id);

        $validated = $request->validate([
            'alamat_lengkap' => 'required',
            'no_rumah' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'lokasi' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'sertifikat_an' => 'required',
            'luas_tanah' => 'required|numeric',
            'foto_tampak_depan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_tampak_depan')) {
            // Delete old file if it exists
            if ($rumah->foto_tampak_depan && file_exists(public_path($rumah->foto_tampak_depan))) {
                unlink(public_path($rumah->foto_tampak_depan));
            }
            
            // Store new file
            $file = $request->file('foto_tampak_depan');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/rumah
            $file->move(public_path('storage/rumah'), $filename);
            $validated['foto_tampak_depan'] = 'rumah/' . $filename;
        }

        // if ($request->hasFile('foto_tampak_depan')) {
        //     $validated['foto_tampak_depan'] = $request->file('foto_tampak_depan')->store('rumah', 'public');
        // }

        // Rumah::findOrFail($id)->update($request->validated());
        // Rumah::findOrFail($id)->update($validated);

        $rumah->update($validated);

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil diubah');
    }
}
