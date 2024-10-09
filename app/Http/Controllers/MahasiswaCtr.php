<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\RequestMahasiswa;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MahasiswaCtr extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $user = Auth::user();
        return view('mahasiswa.dashboard', compact('user', 'mahasiswa'));
    }
    public function profile()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $user = Auth::user();
        return view('mahasiswa.profile', compact('user', 'mahasiswa'));
    }
    public function request()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $user = Auth::user();
        return view('mahasiswa.profile', compact('user', 'mahasiswa'));
    }
    public function submitRequest(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        if ($mahasiswa->edit == false) {
            $request->validate([
                'keterangan' => 'required|string|max:255',
            ]);
            RequestMahasiswa::create([
                'kelas_id' => $mahasiswa->kelas_id,
                'mahasiswa_id' => $mahasiswa->id,
                'keterangan' => $request->input('keterangan'),
            ]);
            // RequestMahasiswa::create(array_merge($request->all(), [
            //     'mahasiswa_id' => $mahasiswa->id,
            //     'kelas_id' => $mahasiswa->kelas_id
            // ]));
        }

        return redirect()->route('mahasiswa.profile')->with('success', 'Request berhasil dikirim');
    }
    public function edit()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $user = Auth::user();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('user', 'mahasiswa', 'kelas'));
    }
    public function updateProfile(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $request->validate([
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
        $mahasiswa->update($request->all());

        // Setelah update, kembalikan hak edit menjadi false
        $mahasiswa->edit = false;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
