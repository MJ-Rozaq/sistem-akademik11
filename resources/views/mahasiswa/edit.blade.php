<x-layout title="Edit Profile">
    <div class="-mt-20 mx-10">
        <h1 class="text-2xl font-semibold mb-6 mt-6">Edit Profile {{ $mahasiswa->name }}</h1>
        <form action="{{ route('mahasiswa.updateProfile') }}" method="POST" class="dark:border-primary-darker shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            {{-- @method('PUT') --}}

            <div class="mb-4">
                <label for="kelas_id" class="block text-sm font-bold mb-2">Kelas</label>
                <select id="kelas_id" name="kelas_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}" {{ $mahasiswa->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                            {{ $kelasItem->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-sm font-bold mb-2">NIM</label>
                <input type="text" id="nim" name="nim" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $mahasiswa->nim }}" required disabled>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-bold mb-2">Nama</label>
                <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $mahasiswa->name }}" required>
            </div>

            <div class="mb-4">
                <label for="tempat_lahir" class="block text-sm font-bold mb-2">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $mahasiswa->tempat_lahir }}" required>
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-bold mb-2">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $mahasiswa->tanggal_lahir }}" required>
            </div>

            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </form>
    </div>
</x-layout>