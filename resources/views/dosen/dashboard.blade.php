<x-layout title="Dosen">
    <body>
        <div class="-mt-20 mx-10">
            <div class="flex items-center justify-between  py-4 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">Dashboard Dosen</h1>
                <div class="p-4">
                    <h2 class="text-lg font-semibold">Selamat datang, {{ $user->username }}</h2>
                    
                   
                </div>
            </div>
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="space-y-4">
            <!-- Header -->
            <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">Request Akses Edit</h1>
            </div>

            <div class="p-6 mt-4 shadow-sm rounded-lg dark:border-primary-darker">
                @if ($requests->count())
                    <ul>
                        @foreach ($requests as $request)
                            <li class="mb-4 dark:border-primary-darker">
                                <!-- Notification Container -->
                                <div id="notification-{{ $request->id }}" class="flex items-center justify-between p-4 bg-gray-100 rounded-md shadow-sm dark:bg-gray-800">
                                    <div class="flex flex-col">
                                        <span class="font-bold">Mahasiswa: {{ $request->mahasiswa->name }}</span>
                                        <p class="mt-2 text-sm">{{ $request->keterangan }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <!-- Approve Button -->
                                        <form action="{{ route('dosen.approveRequest', $request->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                                Approve
                                            </button>
                                        </form>
        
                                        <!-- Reject Button -->
                                        <form action="{{ route('dosen.rejectRequest', $request->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                Reject
                                            </button>
                                        </form>
        
                                        <!-- Dismiss Button -->
                                        <button onclick="document.getElementById('notification-{{ $request->id }}').remove()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada request.</p>
                @endif
            </div>
        </div>
        
        <div class="my-10">
            <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">Daftar Mahasiswa</h1>
                <a href="{{ route('dosen.mahasiswas.create') }}" target="_blank"
                    class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                    Tambah Mahasiswa
                </a>
            </div>
            
            <table class="min-w-full mt-4  rounded-xl shadow-md">
                <thead class=" dark:border-primary-darker uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nim</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Tempat, Tgl Lahir</th>
                        <th class="py-3 px-6 text-left">kelas</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class=" text-sm font-light">
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="border-b border-primary-dark hover:bg-primary-dark">
                            <td class="py-3 px-6">{{ $mahasiswa->nim }}</td>
                            <td class="py-3 px-6">{{ $mahasiswa->name }}</td>
                            <td class="py-3 px-6">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</td>
                            <td class="py-3 px-6">{{ $mahasiswa->kelas->name }}</td>

                            <td class="py-3 px-6">
                                <a href="{{ route('dosen.mahasiswas.edit', $mahasiswa->id) }}"
                                    class="text-yellow-500 hover:text-yellow-700">Update</a>
                                <form action="{{ route('dosen.mahasiswas.destroy', $mahasiswa->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </body>

    </html>
</x-layout>