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
        $agendas = Agenda::findOrFail($id);
        $agendas->delete();
        return redirect('/agenda')->with('success','berhasil hapus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_agenda' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_agenda')) {
            $validated['foto_agenda'] = $request->file('foto_agenda')->store('agenda', 'public');
        }

        Agenda::create($validated);

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'nullable',
            'foto_agenda' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_agenda')) {
            $validated['foto_agenda'] = $request->file('foto_agenda')->store('agenda', 'public');
        }

        // Agenda::findOrFail($id)->update($request->validated());
        Agenda::findOrFail($id)->update($validated);

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil diubah');
    }
}
