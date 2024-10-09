<?php
// Migration for creating dosen_kelas pivot table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenKelasTable extends Migration
{
    public function up(): void
    {
        Schema::create('dosen_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_kelas');
    }
}
