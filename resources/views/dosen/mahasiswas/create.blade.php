<x-form>

    <form action="{{ route('dosen.mahasiswas.store') }}" method="POST" class="space-y-6">
        @csrf
        <input id="nim" type="text" name="nim" required
        class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
        @error('nim') border-red-500 @enderror"
        placeholder="NIM" />
    @error('name')
        <span class="text-sm text-red-500" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

        <input id="name" type="text" name="name" required
            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
            @error('name') border-red-500 @enderror"
            placeholder="Nama" />
        @error('name')
            <span class="text-sm text-red-500" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input id="tempat_lahir" type="text" name="tempat_lahir" required
        class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
        @error('tempat_lahir') border-red-500 @enderror"
        placeholder="Tempat Lahir" />
    @error('tempat_lahir')
        <span class="text-sm text-red-500" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        <input id="tanggal_lahir" type="date" name="tanggal_lahir" required
        class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
        @error('tanggal_lahir') border-red-500 @enderror"
        placeholder="Tempat Lahir" />
    @error('tanggal_lahir')
        <span class="text-sm text-red-500" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

        <select id="kelas_id" type="text" name="kelas_id" required
            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker 
            @error('kelas_id') border-red-500 @enderror">
            <option value="" disabled selected>Pilih kelas</option>
            @foreach ($kelas as $kelasItem)
                <option value="{{ $kelasItem->id }}">{{ $kelasItem->name }}</option>
            @endforeach
</select>
        @error('kelas_id')
            <span class="text-sm text-red-500" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <div>
            <button type="submit"
                class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                Kirim
            </button>
        </div>
    </form>

</x-form>

