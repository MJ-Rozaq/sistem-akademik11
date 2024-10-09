<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $fillable = [
        'nim',
        'name',
        'user_id',
        'kelas_id',
        'tempat_lahir',
        'tanggal_lahir',

    ];

    public function index()
    {
        $mahasiswas = Mahasiswa::all();

        return view('mahasiswa.dashboard', compact('mahasiswas'));
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Dosen::class, 'wali_kelas_id');
    }
    public function requests()
    {
        return $this->hasMany(RequestMahasiswa::class);
    }
}
