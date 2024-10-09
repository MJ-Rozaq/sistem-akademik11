<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = [
        'kelas_id', 
        'mahasiswa_id', 
        'keterangan'
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
