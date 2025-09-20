<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
{
    $users = User::where('role_id', '!=', 1)
                 ->orderBy('created_at', 'asc') // paling lama dulu
                 ->get();

    return view('pages.account-list.index', compact('users'));
}



    public function create()
    {
        return view('pages.account-list.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.account-list.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        
        $user->delete();
        return redirect('/account-list')->with('success', 'Berhasil menghapus data user');
    }


    public function store(Request $request) {
       
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

        return redirect()->route('user.index');
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            
        ],
        'role_id' => 'required',
        'rw' => 'nullable',
        'rt' => 'nullable',
        'password' => 'nullable|min:8', // kalau tidak diisi, password tidak berubah
    ]);

    // Update data
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role_id = $validated['role_id'];
    $user->rw = $validated['rw'] ?? null;
    $user->rt = $validated['rt'] ?? null;

    // Atur logika RT/RW
    if ($validated['role_id'] == 3) {
        // Role RW → kosongkan RT
        $user->rt = null;
    } elseif ($validated['role_id'] == 4) {
        // Role RT → RW dan RT wajib ada
        $user->rt = $validated['rt'] ?? null;
    } else {
        // Role lain → kosongkan RT & RW
        $user->rw = null;
        $user->rt = null;
    }

    // Update password hanya kalau diisi
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('user.index')->with('success', 'Data user berhasil diubah');
}



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
        $users = User::where('role_id', '!=',1)->where('status', '!=','submited')->get();
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
