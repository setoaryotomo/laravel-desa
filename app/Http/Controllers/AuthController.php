<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggotakeluarga;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Penghuni;
use App\Models\Rumah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return back();
        }
        return view('pages.auth.login');
    }

    public function dashboard() {
        $rumahs = Rumah::all();
        $penghunis = Penghuni::all();
        $anggotas = Anggotakeluarga::all();
        $beritas = Berita::all();
        $gallerys = Gallery::all();
        $agendas = Agenda::all();
        $users = User::all();
        return view('pages.dashboard', compact('rumahs','penghunis','anggotas','beritas','gallerys','agendas','users'));
    }


    public function authenticate(Request $request) {
        if (Auth::check()) {
            return back();
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userStatus = Auth::user()->status;


            // dd(Auth::user());
            if($userStatus == 'submited'){
                $this->_logout($request);
                return back()->withErrors(['email' => 'Akun anda belum disetujui']);
            } else if($userStatus == 'rejected'){
                $this->_logout($request);
                return back()->withErrors(['email' => 'Akun anda ditolak']);
            }
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function registerView() {
        if (Auth::check()) {
            return back();
        }
        return view('pages.auth.register');
    }

    public function register(Request $request) {
        if (Auth::check()) {
            return back();
        }
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'role_id' => ['required'],
            'rw' => ['nullable'],
            'rt' => ['nullable'], 
            'password' => ['required'],
        ]);
        

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        // $user->role_id = 3; // User (RW)
        // $user->role_id = 4; // User (RT)
        $user->role_id = $request->input('role_id');
        $user->rw = $request->input('rw');
        $user->rt = $request->input('rt');
        $user->status = 'approved';
        $user->saveOrFail();

        return redirect('/login')->with('success','Berhasil daftar akun, tunggu persetujuan');
    }

    public function _logout(Request $request) {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
    }

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $this->_logout($request);
     
        return redirect('/');
    }

}
