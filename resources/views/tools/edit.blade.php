<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('tools.update', $tool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Nama Alat -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">
                        Nama Alat <span class="text-red-600">*</span>
                    </label>
                    <input 
                        type="text" 
                        required 
                        name="nama" 
                        id="nama" 
                        value="{{ old('nama', $tool->nama) }}" 
                        placeholder="Masukkan nama alat..."
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    >
                    @error('nama')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror   
                </div>
                <!-- End Nama Alat -->

                <!-- Jenis Alat -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">
                        Jenis Alat <span class="text-red-600">*</span>
                    </label>
                    <select 
                        required 
                        name="jenis" 
                        id="jenis" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    >
                        <option value="">--- Pilih Jenis Alat ---</option>
                        <option value="PUBT" {{ old('jenis', $tool->jenis) == 'PUBT' ? 'selected' : '' }}>PUBT</option>
                        <option value="PTP" {{ old('jenis', $tool->jenis) == 'PTP' ? 'selected' : '' }}>PTP</option>
                        <option value="PAPA" {{ old('jenis', $tool->jenis) == 'PAPA' ? 'selected' : '' }}>PAPA</option>
                        <option value="ILP" {{ old('jenis', $tool->jenis) == 'ILP' ? 'selected' : '' }}>ILP</option>
                        <option value="ELEVATOR" {{ old('jenis', $tool->jenis) == 'ELEVATOR' ? 'selected' : '' }}>ELEVATOR</option>
                        <option value="IPK" {{ old('jenis', $tool->jenis) == 'IPK' ? 'selected' : '' }}>IPK</option>
                        <option value="LINGKER" {{ old('jenis', $tool->jenis) == 'LINGKER' ? 'selected' : '' }}>LINGKER</option>
                    </select>
                    @error('jenis')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror  
                </div>
                <!-- End Jenis Alat -->

                <!-- Lampiran -->
                {{-- <div class="mb-4">
                    <label for="lampiran" class="block text-sm font-medium text-gray-700">Dokumen & Lampiran</label>

                    <!-- Preview gambar lama -->
                    <div class="flex flex-wrap gap-2 mb-2">
                        @php
                            $lampiranList = $tool->lampiran ? json_decode($tool->lampiran, true) : [];
                        @endphp
                        @forelse ($lampiranList as $lampiran)
                            <img src="{{ asset('storage/' . $lampiran) }}" alt="Lampiran" class="border rounded-md max-h-24">
                        @empty
                            <p class="text-sm text-gray-500">Belum ada lampiran.</p>
                        @endforelse
                    </div>

                    <!-- Preview gambar baru -->
                    <div id="preview-container" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        id="lampiran" 
                        name="lampiran[]" 
                        multiple
                        onchange="previewImages()" 
                        class="block w-full text-sm text-gray-900 px-3 py-2 mt-1 border border-gray-300 rounded-md cursor-pointer bg-gray-50 
                        @error('lampiran.*') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @if($errors->has('lampiran.*'))
                        <ul class="mt-1 space-y-1">
                            @foreach($errors->get('lampiran.*') as $messages)
                                @foreach($messages as $message)
                                    <li class="text-xs text-red-600">{{ $message }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    @endif
                </div> --}}
                <!-- End Lampiran -->

                <!-- Deskripsi -->
                {{-- <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi" 
                        rows="4"
                        placeholder="Masukkan deskripsi alat..."
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deskripsi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    >{{ old('deskripsi', $tool->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror   
                </div> --}}
                <!-- End Deskripsi -->

                <!-- Submit -->
                <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm sm:w-auto hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update
                </button>
                {{-- End Submit --}}
            </form>
        </div>

        <script>
            // Preview multiple image baru saat edit
            // function previewImages() {
            //     const previewContainer = document.getElementById('preview-container');
            //     const files = document.getElementById('lampiran').files;
            //     previewContainer.innerHTML = "";

            //     Array.from(files).forEach(file => {
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             const img = document.createElement('img');
            //             img.src = e.target.result;
            //             img.classList.add("max-h-24", "rounded-md", "border", "object-cover");
            //             previewContainer.appendChild(img);
            //         }
            //         reader.readAsDataURL(file);
            //     });
            // }
        </script>
</x-layout>
