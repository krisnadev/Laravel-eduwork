<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('register-index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $post = new User();
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->password = Hash::make($request->input('password'));
        $post->save();

        return redirect()->route('register.index')
            ->with('success', 'Sukses Menambahkan User');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return view('register-edit', compact('user'));
        } else {
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);

        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();
            return redirect()->route('register.index')->with('success', 'Ubah berhasil.');
        } else {
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('register.index')->with('success', 'Hapus berhasil.');
        } else {
            return redirect()->route('register.index')->with('error', 'User tidak ditemukan.');
        }
    }
}
