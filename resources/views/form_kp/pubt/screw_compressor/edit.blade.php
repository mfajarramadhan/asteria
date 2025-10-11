<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.screw_compressor.update', $formKpScrewCompressor->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
                @csrf
                @method('PUT')
                
                {{-- Tanggal Pemeriksaan --}}
                <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
                <div class="flex flex-wrap justify-between w-full gap-y-4">
                    <div class="w-full md:w-[48%]">
                        <div class="relative">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" 
                                value="{{ old('tanggal_pemeriksaan', Carbon::parse($formKpScrewCompressor->tanggal_pemeriksaan)->format('d-m-Y')) }}"
                                datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today 
                                type="text" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"> 
                        </div>
                        @error('tanggal_pemeriksaan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Perusahaan --}}
                <div>
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" id="nama_perusahaan" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_perusahaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('nama_perusahaan', $formKpScrewCompressor->pabrik_pembuat) }}">
                    @error('nama_perusahaan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                <div class="flex flex-col gap-2">
                    <h2 class="block text-sm font-bold text-gray-700">Dimensi</h2>
                    <h2 class="block text-sm font-bold text-gray-700">Shell/Badan</h2>
                </div>
                    
                {{-- Foto foto_shell --}}
                <div>
                    <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>
                    
                    {{-- tampilkan foto lama kalau ada --}}
                    @if($formKpScrewCompressor->foto_shell)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_shell, true); @endphp
                        @if(is_array($oldFiles))
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach($oldFiles as $oldFile)
                                    <img src="{{ asset('storage/' . $oldFile) }}" 
                                        alt="Foto Shell Lama" 
                                        class="object-contain w-32 border rounded">
                                @endforeach
                            </div>
                        @endif
                    @endif

                    {{-- preview foto baru --}}
                    <div id="foto_shell-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_shell[]" 
                        id="foto_shell" 
                        accept="image/*" 
                        multiple
                        onchange="previewImage()"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_shell')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Ketidak bulatan --}}
                <div>
                    <label for="ketidakbulatan" class="block text-sm font-medium text-gray-700">Ketidak bulatan</label>
                    <input type="text" name="ketidakbulatan" placeholder="Ketidak bulatan" id="ketidakbulatan" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ketidakbulatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketidakbulatan', $formKpScrewCompressor->ketidakbulatan) }}">
                    @error('ketidakbulatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpScrewCompressor->catatan) }}</textarea>
                    @error('catatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%]">
                    Update
                </button>
            </form>
        </div>
        <script>
        function previewImage() {
            const input = document.getElementById('foto_shell');
            const previewContainer = document.getElementById('foto_shell-preview');

            previewContainer.innerHTML = '';

            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.classList = "relative inline-block";

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList = "object-contain w-32 h-32 border rounded";

                        const btn = document.createElement('button');
                        btn.type = "button";
                        btn.innerHTML = "✕";
                        btn.classList = "absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-700";
                        btn.onclick = function() {
                            wrapper.remove();
                            if (previewContainer.children.length === 0) {
                                input.value = "";
                            }
                        };

                        wrapper.appendChild(img);
                        wrapper.appendChild(btn);
                        previewContainer.appendChild(wrapper);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
        </script>
</x-layout>
