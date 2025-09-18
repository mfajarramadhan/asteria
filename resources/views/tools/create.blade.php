<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('tools.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            {{-- Nama Alat --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">
                    Nama Alat <span class="text-red-600">*</span>
                </label>
                <input type="text" required name="nama" id="nama"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama') border-red-600 focus:border-red-600 focus:ring-red-200 @enderror"
                    value="{{ old('nama') }}" placeholder="Masukkan nama alat...">
                @error('nama')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- End Nama Alat --}}

            {{-- Jenis Alat --}}
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">
                    Jenis Alat <span class="text-red-600">*</span>
                </label>
                <select required name="jenis_riksa_uji_id" id="jenis"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_riksa_uji_id') border-red-600 focus:border-red-600 focus:ring-red-200 @enderror">
                    <option value="">--- Pilih Jenis Alat ---</option>
                    @foreach ($jenisRiksaUji as $jenisRiksa)
                        <option value="{{ $jenisRiksa->id }}" {{ old('jenis_riksa_uji_id') == $jenisRiksa->id ? 'selected' : '' }}>
                            {{ $jenisRiksa->jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_riksa_uji_id')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- End Jenis Alat --}}

            {{-- Sub Jenis Alat --}}
            <div>
                <label for="sub_jenis" class="block text-sm font-medium text-gray-700">
                    Sub Jenis Alat <span class="text-red-600">*</span>
                </label>
                <select required name="sub_jenis_riksa_uji_id" id="sub_jenis"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('sub_jenis_riksa_uji_id') border-red-600 focus:border-red-600 focus:ring-red-200 @enderror">
                    <option value="">--- Pilih Sub Jenis ---</option>
                </select>
                @error('sub_jenis_riksa_uji_id')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- End Sub Jenis Alat --}}

            {{-- Submit --}}
            <button type="submit" class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%]">
                Simpan
            </button>
            {{-- End Submit --}}
        </form>
    </div>

    <script>
        document.getElementById('jenis').addEventListener('change', function() {
            let jenisId = this.value;
            let subJenisSelect = document.getElementById('sub_jenis');
            subJenisSelect.innerHTML = '<option value="">--- Pilih Sub Jenis ---</option>';

            if (jenisId) {
                fetch(`/tools/sub-jenis/${jenisId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(sub => {
                            let option = document.createElement('option');
                            option.value = sub.id;
                            option.text = sub.sub_jenis;
                            subJenisSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
</x-layout>
