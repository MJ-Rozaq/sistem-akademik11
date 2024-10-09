<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    public function index()
    {
        $kaprodis = Kaprodi::all();
        return view('kaprodi.dashboard', compact('kaprodis'));
    }
}
