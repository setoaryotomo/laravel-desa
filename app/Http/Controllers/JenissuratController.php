<?php

namespace App\Http\Controllers;

use App\Models\Jenissurat;
use Illuminate\Http\Request;

class JenissuratController extends Controller
{
    public function index()
    {
        $jenissurats = Jenissurat::all();
        return view('pages.jenissurat.index', compact('jenissurats'));
    }

    public function create()
    {
        return view('pages.jenissurat.create');
    }
    public function edit($id)
    {
        $jenissurat = Jenissurat::findOrFail($id);

        return view('pages.jenissurat.edit', compact('jenissurat'));
    }
    public function destroy($id)
    {
        $jenissurats = Jenissurat::findOrFail($id);
        $jenissurats->delete();
        return redirect('/jenissurat')->with('success', 'berhasil hapus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required',
            'keterangan' => 'required',
            'template' => 'nullable',
        ]);

        Jenissurat::create($validated);

        return redirect()->route('jenissurat.index')->with('success', 'Data jenissurat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required',
            'keterangan' => 'required',
            'template' => 'nullable',
        ]);


        // Jenissurat::findOrFail($id)->update($request->validated());
        Jenissurat::findOrFail($id)->update($validated);

        return redirect()->route('jenissurat.index')->with('success', 'Data jenissurat berhasil diubah');
    }
}
