<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jumlah'
    ];

    // Index method for listing all classes
    public function index()
    {
        $kelas = Kelas::all();
        return view('kaprodi.dashboard', compact('kelas'));
    }

    // Method to update the jumlah field based on related Mahasiswa and Dosen
    public function updateJumlah()
    {
        // Count related mahasiswa
        $jumlahMahasiswa = $this->mahasiswas()->count();
        
        // Count related dosen from the pivot table
        $jumlahDosen = $this->dosens()->count();

        // Update the jumlah field with the total number of mahasiswa and dosen
        $this->jumlah = $jumlahMahasiswa + $jumlahDosen;

        // Save the updated jumlah value to the database
        $this->save();
    }

    // Relationship with Mahasiswa
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id');
    }

    // Many-to-many relationship with Dosen through the pivot table
    public function dosens()
    {
        // Use belongsToMany to define the relationship through the dosen_kelas pivot table
        return $this->belongsToMany(Dosen::class, 'dosen_kelas', 'kelas_id', 'dosen_id');
    }
}
