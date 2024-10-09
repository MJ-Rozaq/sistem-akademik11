<x-layout>

    <body>
        <div class="mx-10">
            <div class="flex items-center justify-between  py-4 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">Dashboard Kaprodi</h1>

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
            <div class="my-10">
                <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
                    <h1 class="text-2xl font-semibold">Daftar Dosen</h1>
                    <button
                        class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
                        onclick="openModal()">
                        Tambah Dosen
                    </button>
                </div>
                <!-- Modal background (overlay) -->
                <div id="tambahModal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-90 hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/2 p-6 relative">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Tambah Dosen</h3>
                            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
                        </div>

                        <!-- Modal content (form) -->
                        <form action="{{ route('kaprodi.dosens.save') }}" method="POST" class="space-y-6">
                            @csrf
                            <input id="name" type="text" name="name" required
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                            @error('name') border-red-500 @enderror"
                                placeholder="Nama" />
                            @error('name')
                                <span class="text-sm text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="nip" type="text" name="nip" required
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                            @error('nip') border-red-500 @enderror"
                                placeholder="NIP" />
                            @error('nip')
                                <span class="text-sm text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="kode_dosen" type="text" name="kode_dosen" required
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                            @error('kode_dosen') border-red-500 @enderror"
                                placeholder="Kode Dosen" />
                            @error('kode_dosen')
                                <span class="text-sm text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit"
                                class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>

                <table class="min-w-full mt-4  rounded-xl shadow-md">
                    <thead class=" dark:border-primary-darker uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">NIP</th>
                            <th class="py-3 px-6 text-left">Kode Dosen</th>
                            <th class="py-3 px-6 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class=" text-sm font-light">
                        @foreach ($dosens as $dosen)
                            <tr class="border-b border-primary-dark hover:bg-primary-dark">
                                <td class="py-3 px-6">{{ $dosen->name }}</td>
                                <td class="py-3 px-6">{{ $dosen->nip }}</td>
                                <td class="py-3 px-6">{{ $dosen->kode_dosen }}</td>
                                <td class="py-3 px-6">
                                    <a href="javascript:void(0);"
                                        onclick="openEditModal('{{ $dosen->id }}', '{{ $dosen->name }}', '{{ $dosen->nip }}', '{{ $dosen->kode_dosen }}', '{{ $dosen->kelas_id }}')"
                                        class="text-yellow-500 hover:text-yellow-700">Update</a>

                                    <!-- Modal for Editing Dosen -->
                                    <div id="editModal_{{ $dosen->id }}"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-90 hidden">
                                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/2 p-6 relative">
                                            <div class="flex justify-between items-center">
                                                <h3 class="text-lg font-semibold">Edit Dosen</h3>
                                                <button onclick="closeEditModal({{ $dosen->id }})"
                                                    class="text-gray-500 hover:text-gray-800">&times;</button>
                                            </div>

                                            <form id="editDosenForm_{{ $dosen->id }}" method="POST" action=""
                                                class="space-y-6">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" id="dosenId" name="dosen_id" value="">

                                                <input id="name_{{ $dosen->id }}" type="text" name="name"
                                                    required
                                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                                    placeholder="Nama Dosen" required
                                                    value="{{ old('name', $dosen->name) }}" />

                                                <input id="kode_dosen_{{ $dosen->id }}" type="text"
                                                    name="kode_dosen" readonly
                                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                                    placeholder="Kode Dosen"
                                                    value="{{ old('kode_dosen', $dosen->kode_dosen) }}" />

                                                <input id="nip_{{ $dosen->id }}" type="text" name="nip"
                                                    readonly
                                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                                    placeholder="NIP Dosen" value="{{ old('nip', $dosen->nip) }}" />

                                                <!-- Pilihan Kelas -->
                                                <select id="kelas_id" name="kelas_id"
                                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker">
                                                    <option value="">Pilih Kelas</option>
                                                    @foreach ($kelas as $kelasItem)
                                                        <option value="{{ $kelasItem->id }}"
                                                            {{ $dosen->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                                                            {{ $kelasItem->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit"
                                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark">
                                                    Kirim
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="{{ route('kaprodi.dosens.destroy', $dosen->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="mb-10">
                <div class="my-10">
                    <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
                        <h1 class="text-2xl font-semibold">Daftar Kelas</h1>
                        <button onclick="openAddKelasModal()"
                            class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                            Tambah Kelas
                        </button>
                    </div>
                    <div id="addKelasModal"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-90 hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/2 p-6 relative">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Tambah Kelas</h3>
                                <button onclick="closeAddKelasModal()"
                                    class="text-gray-500 hover:text-gray-800">&times;</button>
                            </div>

                            <form id="addKelasForm" method="POST" action="{{ route('kaprodi.kelas.save') }}"
                                class="space-y-6">
                                @csrf
                                <input id="name" type="text" name="name" required
                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                                    @error('name') border-red-500 @enderror"
                                    placeholder="Nama" />
                                @error('name')
                                    <span class="text-sm text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="jumlah" type="number" name="jumlah" required
                                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                                    @error('jumlah') border-red-500 @enderror"
                                    placeholder="Jumlah" />
                                @error('jumlah')
                                    <span class="text-sm text-red-500" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button type="submit"
                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark">
                                    Kirim
                                </button>
                            </form>
                        </div>
                    </div>
                    <table class="min-w-full mt-4 rounded-xl shadow-md">
                        <thead class="dark:border-primary-darker uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Kelas</th>
                                <th class="py-3 px-6 text-left">Jumlah</th>
                                <th class="py-3 px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-light">
                            @foreach ($kelas as $kelas)
                                <tr class="border-b border-primary-dark hover:bg-primary-dark">
                                    <td class="py-3 px-6">
                                        <a href="{{ route('kaprodi.kelas.read', $kelas->id) }}">
                                            {{ $kelas->name }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-6">{{ $kelas->jumlah }}</td>
                                    <td class="py-3 px-6">
                                        <a href="javascript:void(0);"
                                            onclick="openEditKelasModal('{{ $kelas->id }}', '{{ $kelas->name }}', '{{ $kelas->jumlah }}')"
                                            class="text-yellow-500 hover:text-yellow-700">Update</a>

                                        <!-- Modal for Editing Kelas -->
                                        <div id="editKelasModal_{{ $kelas->id }}"
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-90 hidden">
                                            <div
                                                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/2 p-6 relative">
                                                <div class="flex justify-between items-center">
                                                    <h3 class="text-lg font-semibold">Edit Kelas</h3>
                                                    <button onclick="closeEditKelasModal({{ $kelas->id }})"
                                                        class="text-gray-500 hover:text-gray-800">&times;</button>
                                                </div>

                                                <form id="editKelasForm_{{ $kelas->id }}" method="POST"
                                                    action="" class="space-y-6">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" id="kelasId_{{ $kelas->id }}"
                                                        name="kelas_id" value="{{ $kelas->id }}">

                                                    <input id="name_{{ $kelas->id }}" type="text"
                                                        name="name" required value="{{ $kelas->name }}"
                                                        class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                                                        @error('name') border-red-500 @enderror"
                                                        placeholder="Nama" />
                                                    @error('name')
                                                        <span class="text-sm text-red-500" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <input id="jumlah_{{ $kelas->id }}" type="number"
                                                        name="jumlah" required value="{{ $kelas->jumlah }}"
                                                        class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
                                                        @error('jumlah') border-red-500 @enderror"
                                                        placeholder="Jumlah" />
                                                    @error('jumlah')
                                                        <span class="text-sm text-red-500" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <button type="submit"
                                                        class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark">
                                                        Kirim
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="{{ route('kaprodi.kelas.destroy', $kelas->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-10">
                <div class="my-10">
                    <div class="flex items-center justify-between py-4 border-b lg:py-6 dark:border-primary-darker">
                        <h1 class="text-2xl font-semibold">Daftar Mahasiswa</h1>

                    </div>
                    <table class="min-w-full mt-4  rounded-xl shadow-md">
                        <thead class=" dark:border-primary-darker uppercase text-sm leading-normal">

                            <th class="py-3 px-6 text-left">Nim</th>
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">Tempat, Tanggal lahir</th>
                            <th class="py-3 px-6 text-left">Kelas</th>
                            </tr>
                        </thead>
                        <tbody class=" text-sm font-light">
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr class="border-b border-primary-dark hover:bg-primary-dark">
                                    <td class="py-3 px-6">{{ $mahasiswa->nim }}</td>
                                    <td class="py-3 px-6">{{ $mahasiswa->name }}</td>
                                    <td class="py-3 px-6">{{ $mahasiswa->tempat_lahir }},
                                        {{ $mahasiswa->tanggal_lahir }}</td>
                                    <td class="py-3 px-6">{{ $mahasiswa->kelas->name }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </body>

    {{-- @endsection --}}
</x-layout>
