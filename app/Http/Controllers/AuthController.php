<?php

namespace App\Http\Controllers;

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
            'password' => ['required'],
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = 2; // User (penduduk)
        $user->saveOrFail();

        return redirect('/')->with('success','Berhasil daftar akun, tunggu persetujuan');
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
