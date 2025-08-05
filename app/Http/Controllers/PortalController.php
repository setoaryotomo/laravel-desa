<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function homepage() {
        $beritas = Berita::all();
        $agendas = Agenda::all();
        $gallerys = Gallery::all();
        return view('pages.portal.index',[
            'beritas' => $beritas,
            'agendas' => $agendas,
            'gallerys' => $gallerys,
        ]);
    }

}
