<x-layout title="Mahasiswa">
    <div class="-mt-20 mx-10">
        <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Profil Mahasiswa</h1>
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
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-2 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-4">
            @if ($mahasiswa)
                <h3 class="text-xl font-semibold mb-4">Detail Mahasiswa</h3>
                <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                <p><strong>Nama:</strong> {{ $mahasiswa->name }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $mahasiswa->tempat_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $mahasiswa->tanggal_lahir }}</p>
            @else
                <p>Data mahasiswa tidak ditemukan.</p>
            @endif
        </div>

        <div class="mt-4">
            <button onclick="location.href='{{ route('mahasiswa.profile') }}'"
                class="block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Profil Saya
            </button>
        </div>
    </div>
</x-layout>

<script>
    // Script to toggle the sidebar if needed
    document.getElementById('toggleButton').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-collapsed');
    });
</script>
