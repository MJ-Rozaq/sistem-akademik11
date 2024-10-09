<x-layout title="{{ $kelas->name }}" heading="-">
    <div class="-mt-20">
        <div class="flex items-center justify-between  py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">{{ $kelas->name }}</h1>

        </div>
        <div class="container">

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tampilkan Dosen Pengampu -->
            <h3 class="text-xl font-semibold mb-2">Dosen:</h3>
            <table class="min-w-full rounded-xl shadow-md table-auto">
                <thead class="dark:border-primary-darker uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Kode</th>
                        <th class="py-3 px-6 text-left">NIP</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light">
                    @foreach ($kelas->dosens as $dosen)
                        <tr class="border-b class=border-b border-primary-dark hover:bg-primary-dark">
                            <td class="py-3 px-6">{{ $dosen->name }}</td>
                            <td class="py-3 px-6">{{ $dosen->kode_dosen }}</td>
                            <td class="py-3 px-6">{{ $dosen->nip }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tampilkan Daftar Mahasiswa di Kelas Ini -->
            <h3 class="text-xl font-semibold mt-6 mb-2">Daftar Mahasiswa:</h3>
            <table class="min-w-full rounded-xl shadow-md table-auto">
                <thead class="dark:border-primary-darker uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">NIM</th>
                        <th class="py-3 px-6 text-left">Nama Mahasiswa</th>
                        <th class="py-3 px-6 text-left">Tempat, Tgl Lahir</th>

                    </tr>
                </thead>
                <tbody class="text-sm font-light">
                    @foreach ($kelas->mahasiswas as $mahasiswa)
                        <tr class="border-b class=border-b border-primary-dark hover:bg-primary-dark">
                            <td class="py-3 px-6">{{ $mahasiswa->nim }}</td>
                            <td class="py-3 px-6">{{ $mahasiswa->name }}</td>
                            <td class="py-3 px-6">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <h3 class="text-xl font-semibold">Tambah Mahasiswa ke {{ $kelas->name }}</h3>
                <form action="{{ route('kaprodi.kelas.plotmahasiswa', $kelas->id) }}" method="POST">
                    @csrf
                    <label for="mahasiswa_id" class="block mb-2">Pilih Mahasiswa</label>
                    <select name="mahasiswa_id" id="mahasiswa_id"
                        class="border rounded w-1/2 text-white text-sm bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                        @foreach ($availableMahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">
                                    {{ $mahasiswa->name }} -> {{ $mahasiswa->kelas->name ?? '--' }}</td>
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">Tambah
                        Mahasiswa</button>
                </form>
            </div>

            <div class="my-4">
                <h3 class="text-xl font-semibold">Tambah Dosen ke Kelas</h3>
                <form action="{{ route('kaprodi.kelas.plotdosen', $kelas->id) }}" method="POST">
                    @csrf
                    <label for="dosen_id" class="block mb-2">Pilih Dosen</label>
                    <select name="dosen_id" id="dosen_id"
                        class="border rounded w-1/2 text-white text-sm bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                        @foreach ($availableDosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->name }} wali kelas asal:
                                {{ $dosen->kelas->name ?? '--'}} </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">Tambah
                        Dosen</button>
                </form>
            </div>
        </div>
</x-layout>
