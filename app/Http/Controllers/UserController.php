<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function account_request_view(){
        $users =  User::where('status', 'submited')->get();
        return view('pages.account-request.index', [
            'users' => $users,
        ]);
    }

    public function account_approval(Request $request, $userId) {
        // $request->validate([
        //     'for' => ['required', Rule::in(['approve', 'reject', 'activate',' deactivate'])],
        // ]);
        
        $for = $request->input('for');
        
        $user = User::findOrFail($userId);
        $user->status = ($for == 'approve' || $for == 'activate') ? 'approved' : 'rejected';
        $user->save();

        if (in_array($for, ['activate', 'deactivate'])) {
            return back()->with('success', $for == 'activate' ? 'Berhasil mengaktifkan akun' : 'Berhasil menon-aktifkan akun');
        }

        if ($for == 'activate') {
            return back()->with('success', 'Berhasil mengaktifkan akun');
        } else if ($for == 'deactivate') {
            return back()->with('success',  'Berhasil menon-aktifkan akun');
        }

        return back()->with('success', $for == 'approve' ? 'Berhasil menyetujui akun' : 'Berhasil menolak akun');
    }

    public function account_list_view() {
        $users = User::where('role_id', 2)->where('status', '!=','submited')->get();
        return view('pages.account-list.index', [
            'users' => $users,
        ]);
    }

    public function profile_view() {
        return view('pages.profile.index');
    }

    public function update_profile(Request $request, $userId) {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $user = User::findOrFail($userId);
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success','Berhasil mengubah profile');
    }

    public function change_password_view() {
        return view('pages.profile.change-password');
    }

    public function change_password(Request $request, $userId) {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail($userId);
        
        $currentPasswordIsValid = Hash::check($request->input('old_password'), $user->password);
        if($currentPasswordIsValid){
            $user->password = $request->input('new_password');
            $user->save();
            return back()->with('success','Berhasil mengubah password');
        }

        return back()->with('error','Gagal ubah password, password lama tidak valid');
    }
}
