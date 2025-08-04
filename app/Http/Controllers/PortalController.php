<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function homepage() {
        
        return view('pages.portal.index');
    }
}
