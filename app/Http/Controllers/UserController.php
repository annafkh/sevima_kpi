<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
{
    $users = User::orderBy('created_at', 'desc')->get();
    return view('users.index', compact('users'));
}


   public function create()
{
    $leaders = User::where('role', 'leader')->get();
    return view('users.create', compact('leaders'));
}

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role'  => 'required|in:karyawan,leader,hc',
        'password' => 'nullable|min:6',
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}


public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role'     => 'required|in:karyawan,leader,hc',
        'leader_id' => 'nullable|exists:users,id',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    // Cari data karyawan berdasarkan nama
    if ($request->role === 'karyawan' && $request->leader_id) {
        $karyawan = Karyawan::where('nama', $user->name)->first();
        if ($karyawan) {
            DB::table('leader_karyawans')->insert([
                'leader_user_id' => $request->leader_id,
                'karyawan_id' => $karyawan->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
}

public function destroy(User $user)
{
    if (auth()->id() === $user->id) {
        return redirect()->route('users.index')->with('error', 'Tidak bisa menghapus user yang sedang login.');
    }

    $user->delete();
    return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
}

}
