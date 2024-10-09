<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'kode_dosen',
        'user_id',
        'kelas_id'
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id', 'kelas_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
