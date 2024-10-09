<x-layout title="Profil">
    <div class="-mt-20 mx-10">
        <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Profil Saya</h1>
            <div class="p-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 ml-4">Register</a>
                @else
                    <h2 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->name }}</h2>
                @endguest
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-2 rounded mt-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-4">
            @if ($mahasiswa)
                <!-- Tombol Request Edit -->
                @if (!$mahasiswa->edit)
                    <form action="{{ route('mahasiswa.requestEdit') }}" method="POST" id="requestEditForm">
                        @csrf

                        <div class="mb-4">
                            <label for="keterangan" class="block text-gray-700 text-sm font-bold mb-2">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      placeholder="{{ session('success', 'Jelaskan alasan Anda meminta akses edit...') }}"
                                      oninput="checkInput()"></textarea>
                            <span id="warningMessage" class="text-red-500 text-sm hidden">Keterangan tidak boleh kosong!</span>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="submitButton" disabled>
                            Request Edit
                        </button>
                    </form>
                @endif

                <h3 class="text-xl font-semibold mb-4">Detail Mahasiswa</h3>
                <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                <p><strong>Nama:</strong> {{ $mahasiswa->name }}</p>
                <p><strong>Tempat, Tanggal Lahir:</strong> {{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</p>

                @if ($mahasiswa->edit)
                    <div class="mt-4">
                        <button onclick="location.href='{{ route('mahasiswa.edit') }}'" 
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Profil
                        </button>
                    </div>
                @endif
            @else
                <p>Data mahasiswa tidak ditemukan.</p>
            @endif
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-4">Detail User</h3>
            @if ($user)
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Password:</strong> ****</p>
            @endif
        </div>
    </div>
</x-layout>

<script>
    function checkInput() {
        const textarea = document.getElementById('keterangan');
        const warningMessage = document.getElementById('warningMessage');
        const submitButton = document.getElementById('submitButton');

        if (textarea.value.trim() === '') {
            warningMessage.classList.remove('hidden');
            submitButton.disabled = true;
        } else {
            warningMessage.classList.add('hidden');
            submitButton.disabled = false;
        }
    }
</script>
