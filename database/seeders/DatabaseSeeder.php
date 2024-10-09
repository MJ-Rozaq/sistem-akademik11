<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Factories\kaprodiFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $kelasA = Kelas::create(['name' => 'Kelas A', 'jumlah' => '0']);
        $kelasB = Kelas::create(['name' => 'Kelas B', 'jumlah' => '0']);

        $kaprodi = User::create([
            'username' => 'Kaprodi User',
            'email' => 'kaprodi@example.com',
            'password' => Hash::make('password'),
            'role' => 'kaprodi',
        ]);
        Kaprodi::factory(1)->create(['user_id' => $kaprodi->id]);

        // Dosen
        $dosenW1 = User::create([
            'username' => 'Dosen wali 1',
            'email' => 'dosenw1@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        Dosen::create([
            'name' => 'Dosen Wali 1',
            'user_id' => $dosenW1->id,
            'kode_dosen' => 'DW001',
            'nip' => '1234567890',
            'kelas_id' => $kelasA->id
        ]);
        $dosenW2 = User::create([
            'username' => 'Dosen wali 2',
            'email' => 'dosenw2@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        Dosen::create(['name' => 'Dosen Wali 2', 'user_id' => $dosenW2->id, 'kode_dosen' => 'DW002', 'nip' => '0987654321', 'kelas_id' => $kelasB->id]);


        $dosen = User::create([
            'username' => 'Dosen',
            'email' => 'dosen@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        Dosen::factory(1)->create(['user_id' => $dosen->id]);

        $dosen2 = User::create([
            'username' => 'Dosen2',
            'email' => 'dosen2@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        Dosen::factory(1)->create(['user_id' => $dosen2->id]);

        $dosen3 = User::create([
            'username' => 'Dosen3',
            'email' => 'dosen3@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        Dosen::factory(1)->create(['user_id' => $dosen3->id]);


        // Mahasiswa
        $mahasiswa = User::create([
            'username' => 'Mahasiswa User',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa'

        ]);
        Mahasiswa::factory(19)
            ->recycle(Kelas::all())
            ->recycle([$dosenW1, $dosenW2])
            ->create();
        Mahasiswa::create([
            'name' => 'Mahasiswa User',
            'user_id' => $mahasiswa->id,
            'nim' => '1234567890',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'kelas_id' => 1,
            // 'wali_kelas_id' => 1,
        ]);
    }
}
