<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('pages.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('pages.agenda.create');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('pages.agenda.edit', compact('agenda'));
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        
        // Delete the associated file if it exists
        if ($agenda->foto_agenda && file_exists(public_path('storage/agenda/' . basename($agenda->foto_agenda)))) {
            unlink(public_path('storage/agenda/' . basename($agenda->foto_agenda)));
        }
        
        $agenda->delete();
        return redirect('/agenda')->with('success', 'Berhasil menghapus data agenda');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_agenda' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_agenda')) {
            $file = $request->file('foto_agenda');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/agenda
            $file->move(public_path('storage/agenda'), $filename);
            $validated['foto_agenda'] = 'agenda/' . $filename;
        }

        Agenda::create($validated);
        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_agenda' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_agenda')) {
            // Delete old file if it exists
            if ($agenda->foto_agenda && file_exists(public_path($agenda->foto_agenda))) {
                unlink(public_path($agenda->foto_agenda));
            }
            
            // Store new file
            $file = $request->file('foto_agenda');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file langsung ke public/storage/agenda
            $file->move(public_path('storage/agenda'), $filename);
            $validated['foto_agenda'] = 'agenda/' . $filename;
        }

        $agenda->update($validated);

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil diubah');
    }
}
