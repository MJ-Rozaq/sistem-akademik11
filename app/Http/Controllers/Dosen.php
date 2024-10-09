<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\RequestMahasiswa;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class Dosen extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $mahasiswas = Mahasiswa::all();
        $requests = RequestMahasiswa::with('mahasiswa')->get();
        return view('dosen.dashboard', compact('mahasiswas', 'user', 'requests'));
    }

    public function createMahasiswa()
    {
        $user = User::all();
        $kelas = Kelas::all();
        return view('dosen.mahasiswas.create', compact('user', 'kelas'));
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Create user and mahasiswa
        $user = User::create([
            'username' => $request->nim,
            'email' => $request->nim . '@example.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create(array_merge($request->all(), [
            'user_id' => $user->id,
        ]));

        return redirect()->route('dosen.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function editMahasiswa(Mahasiswa $mahasiswa)
    {
        $user = User::all();
        $kelas = Kelas::all();

        if (!$this->isDosenWaliKelas(Auth::user(), $mahasiswa->kelas_id)) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses untuk mengedit mahasiswa ini.');
        }

        return view('dosen.mahasiswas.edit', compact('mahasiswa', 'user', 'kelas'));
    }

    public function updateMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('dosen.dashboard')->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function destroyMahasiswa(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('dosen.dashboard')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function approveRequest($id)
    {
        $request = RequestMahasiswa::find($id);
        if (!$request) {
            return redirect()->route('dosen.dashboard')->with('error', 'Request tidak ditemukan.');
        }

        $dosen = Auth::user()->dosen; // Get dosen from authenticated user
        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);

        if (!$this->isDosenWaliKelas($dosen, $mahasiswa->kelas_id)) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses untuk menyetujui request ini.');
        }

        // Approve the request
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Delete the request after approval
        $request->delete();

        return redirect()->route('dosen.dashboard')->with('success', 'Request edit disetujui.');
    }

    public function rejectRequest($id)
    {
        $request = RequestMahasiswa::find($id);
        if (!$request) {
            return redirect()->route('dosen.dashboard')->with('error', 'Request tidak ditemukan.');
        }

        $dosen = Auth::user()->dosen;
        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);

        if (!$this->isDosenWaliKelas($dosen, $mahasiswa->kelas_id)) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses untuk menolak request ini.');
        }

        // Delete the request after rejection
        $request->delete();

        return redirect()->route('dosen.dashboard')->with('success', 'Request edit ditolak.');
    }

    private function isDosenWaliKelas($dosen, $kelasId)
    {
        return $dosen->kelas()->where('id', $kelasId)->exists();
    }
}
