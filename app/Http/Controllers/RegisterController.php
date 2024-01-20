<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari model User
        $users = User::all();
        
        // Menampilkan tampilan 'register-index' dengan data pengguna
        return view('register-index', ['users' => $users]);
    }

    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     */
    public function create()
    {
        // Menampilkan tampilan 'register' untuk membuat pengguna baru
        return view('register');
    }

    /**
     * Menyimpan pengguna baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:3',
        ]);

        // Membuat instance User dan mengisi propertinya dengan data dari formulir
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        
        // Menyimpan data pengguna baru ke dalam database
        $user->save();

        // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('register.index')->with('success', 'Sukses Menambahkan User');
    }

    /**
     * Menampilkan informasi pengguna tertentu.
     */
    public function show(string $id)
    {
        // Metode ini bisa diimplementasikan jika ingin menampilkan informasi spesifik pengguna
    }

    /**
     * Menampilkan formulir untuk mengedit informasi pengguna.
     */
    public function edit(string $id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna ditemukan, menampilkan formulir edit
        if ($user) {
            return view('register-edit', compact('user'));
        } else {
            // Jika pengguna tidak ditemukan, mengarahkan kembali ke halaman daftar pengguna dengan pesan error
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }

    /**
     * Menyimpan perubahan informasi pengguna ke dalam penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirimkan melalui formulir
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna ditemukan, mengupdate informasi pengguna
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();
            
            // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
            return redirect()->route('register.index')->with('success', 'Ubah berhasil.');
        } else {
            // Jika pengguna tidak ditemukan, mengarahkan kembali ke halaman daftar pengguna dengan pesan error
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }

    /**
     * Menghapus pengguna dari penyimpanan.
     */
    public function destroy(string $id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::find($id);

        // Jika pengguna ditemukan, menghapus pengguna
        if ($user) {
            $user->delete();
            
            // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
            return redirect()->route('register.index')->with('success', 'Hapus berhasil.');
        } else {
            // Jika pengguna tidak ditemukan, mengarahkan kembali ke halaman daftar pengguna dengan pesan error
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }
}
