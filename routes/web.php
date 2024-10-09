<?php

use App\Http\Controllers\MahasiswaCtr;
use App\Http\Controllers\Dosen;
use App\Http\Controllers\Kaprodi;
use App\Http\Controllers\SearchCtr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return Auth::check() 
        ? redirect()->route(Auth::user()->role . '.dashboard') 
        : view('auth.login');
});

// Route untuk Mahasiswa
Route::get('/mahasiswa/dashboard', [MahasiswaCtr::class, 'index'])->middleware('auth')->name('mahasiswa.dashboard');

// Route untuk Kaprodi
Route::get('/kaprodi/dashboard', [
    Kaprodi::class,
    'index',

])->middleware('auth')->name('kaprodi.dashboard');

// Route untuk Dosen
Route::get('/dosen/dashboard', [
    Dosen::class, 'index'
    ])->middleware('auth')->name('dosen.dashboard');

Route::controller(Kaprodi::class)->group(function () {
    // Route untuk CRUD dosen
    // Route::get('/kaprodi/dosens/create', 'createDosen')->name('kaprodi.dosens.create'); // Form untuk tambah dosen 
    Route::post('/kaprodi/dosens', 'saveDosen')->name('kaprodi.dosens.save'); // Simpan dosen baru
    // Route::get('/kaprodi/dosens/{dosen}/edit', 'editDosen')->name('kaprodi.dosens.edit'); // Form untuk edit dosen
    Route::put('/kaprodi/dosens/{dosen}', 'updateDosen')->name('kaprodi.dosens.update'); // Update data dosen
    Route::delete('/kaprodi/dosens/{dosen}', 'destroyDosen')->name('kaprodi.dosens.destroy'); // Hapus dosen

    // Route untuk CRUD kelas
    Route::get('/kaprodi/kelas/read', 'showKelas')->name('kaprodi.kelas.read'); // Form untuk tambah kelas
    Route::get('/kaprodi/kelas/create', 'createKelas')->name('kaprodi.kelas.create'); // Form untuk tambah kelas
    Route::post('/kaprodi/kelas', 'saveKelas')->name('kaprodi.kelas.save'); // Simpan kelas baru
    Route::get('/kaprodi/kelas/{kelas}/edit', 'editKelas')->name('kaprodi.kelas.edit'); // Form untuk edit kelas
    Route::put('/kaprodi/kelas/{kelas}', 'updateKelas')->name('kaprodi.kelas.update'); // Update data kelas
    Route::delete('/kaprodi/kelas/{kelas}', 'destroyKelas')->name('kaprodi.kelas.destroy'); // Hapus kelas

    //plotting kelas
    Route::get('/kaprodi/kelas/{kelas}/', 'showkelas')->name('kaprodi.kelas.read'); // Plotting kelas
    Route::post('/kaprodi/kelas/{kelas}/plot-mahasiswa', 'plotMahasiswaKelas')->name('kaprodi.kelas.plotmahasiswa'); // Plotting mahasiswa
    Route::post('/kaprodi/kelas/{kelas}/plot-dosen', 'plotDosenKelas')->name('kaprodi.kelas.plotdosen'); // Plotting dosen
});

Route::controller(Dosen::class)->group(function () {
    // Route untuk CRUD mahasiswa
    Route::get('/dosen/mahasiswas/create', 'createMahasiswa')->name('dosen.mahasiswas.create'); // Form untuk tambah mahasiswa
    Route::post('/dosen/mahasiswas', 'storeMahasiswa')->name('dosen.mahasiswas.store'); // Simpan mahasiswa baru
    Route::get('/dosen/mahasiswas/{mahasiswa}/edit', 'editMahasiswa')->name('dosen.mahasiswas.edit'); // Form untuk edit mahasiswa
    Route::put('/dosen/mahasiswas/{mahasiswa}', 'updateMahasiswa')->name('dosen.mahasiswas.update'); // Update data mahasiswa
    Route::delete('/dosen/mahasiswas/{mahasiswa}', 'destroyMahasiswa')->name('dosen.mahasiswas.destroy'); // Hapus mahasiswa
    Route::post('/dosen/approveRequest/{id}', 'approveRequest')->name('dosen.approveRequest');
    Route::post('/dosen/requests/{id}/reject', 'rejectRequest')->name('dosen.rejectRequest');
});

Route::controller(MahasiswaCtr::class)->group(function () {
    Route::get('/mahasiswa/profile', 'profile')->name('mahasiswa.profile');
    Route::post('/mahasiswa/requestEdit', 'submitRequest')->name('mahasiswa.requestEdit');
    Route::get('/mahasiswa/edit', 'edit')->name('mahasiswa.edit');
    Route::post('/mahasiswa/updateProfile', 'updateProfile')->name('mahasiswa.updateProfile');
});




