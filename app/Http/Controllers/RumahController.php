<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RumahController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    
    $query = Rumah::query();

    // Filter otomatis berdasarkan role
    if ($user->role_id == 3) { // Role RW
        $query->where('rw', $user->rw);
    } elseif ($user->role_id == 4) { // Role RT
        $query->where('rt', $user->rt)->where('rw', $user->rw);
    }

    // Filter tambahan dari form
    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }
    if ($request->filled('rw')) {
        $query->where('rw', $request->rw);
    }

    $rumahs = $query->get();

    return view('pages.rumah.index', compact('rumahs'));
}


    public function create()
    {
        return view('pages.rumah.create');
    }
    
    public function edit($id)
    {
        $rumah = Rumah::findOrFail($id);
        
        // Authorization check untuk RW dan RT
        $user = Auth::user();
        if ($user->role_id == 3 && $rumah->rw != $user->rw) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role_id == 4 && ($rumah->rt != $user->rt || $rumah->rw != $user->rw)) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.rumah.edit', compact('rumah'));
    }
    
    public function destroy($id)
    {
        $rumah = Rumah::findOrFail($id);
        
        // Authorization check untuk RW dan RT
        $user = Auth::user();
        if ($user->role_id == 3 && $rumah->rw != $user->rw) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role_id == 4 && ($rumah->rt != $user->rt || $rumah->rw != $user->rw)) {
            abort(403, 'Unauthorized action.');
        }
        
        $rumah->delete();
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
        
        Rumah::create($validated);

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $rumah = Rumah::findOrFail($id);
        
        // Authorization check untuk RW dan RT
        $user = Auth::user();
        if ($user->role_id == 3 && $rumah->rw != $user->rw) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role_id == 4 && ($rumah->rt != $user->rt || $rumah->rw != $user->rw)) {
            abort(403, 'Unauthorized action.');
        }

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

        $rumah->update($validated);

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil diubah');
    }
}