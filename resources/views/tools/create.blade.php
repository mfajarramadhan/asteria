<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('tools.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                {{-- Nama Alat --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Alat <span class="text-red-600">*</span></label>
                    <input type="text" required name="nama" id="nama" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama alat...">
                    @error('nama')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                {{-- End Nama Alat --}}

                {{-- Jenis Alat --}}
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Alat <span class="text-red-600">*</span></label>
                    <select required name="jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                        <option value="">--- Pilih Jenis Alat ---</option>
                        <option value="PUBT" {{ old('jenis') == 'PUBT' ? 'selected' : '' }}>PUBT</option>
                        <option value="PTP" {{ old('jenis') == 'PTP' ? 'selected' : '' }}>PTP</option>
                        <option value="PAPA" {{ old('jenis') == 'PAPA' ? 'selected' : '' }}>PAPA</option>
                        <option value="ILP" {{ old('jenis') == 'ILP' ? 'selected' : '' }}>ILP</option>
                        <option value="ELEVATOR" {{ old('jenis') == 'ELEVATOR' ? 'selected' : '' }}>ELEVATOR</option>
                        <option value="IPK" {{ old('jenis') == 'IPK' ? 'selected' : '' }}>IPK</option>
                        <option value="LINGKER" {{ old('jenis') == 'LINGKER' ? 'selected' : '' }}>LINGKER</option>
                    </select>
                    @error('jenis')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror  
                </div>
                {{-- End Jenis Alat --}}
                
                {{-- Upload 1 Image
                <div class="mb-4">
                    <label for="lampiran" class="block text-sm font-medium text-gray-700">Dokumen & Lampiran</label>
                    <img class="max-w-md rounded-md img-preview max-h-24" alt="">
                    <input type="file" id="lampiran" name="lampiran" onchange="previewImage()" class="block w-full text-sm text-gray-900 px-3 py-2 mt-1 border border-gray-300 rounded-md cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('lampiran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    @error('lampiran')
                        <div class="text-xs text-red-600">
                        {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                
                {{-- Lampiran --}}
                {{-- <div class="mb-4">
                    <label for="lampiran" class="block text-sm font-medium text-gray-700">Dokumen & Lampiran</label>
                    
                    <!-- Container untuk preview multiple image -->
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
                {{-- End Lampiran --}}

                {{-- Deskripsi --}}
                {{-- <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                    Deskripsi
                </label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deskripsi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" placeholder="Masukkan deskripsi alat...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
                </div> --}}
                {{-- End Deskripsi --}}

                {{-- Submit --}}
                <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm sm:w-auto hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
                {{-- End Submit --}}
            </form>
        </div>
        <script>
            // // Add previewImage (1 image)
            // function previewImage(){
            //     const image = document.querySelector('#lampiran');
            //     const imgPreview = document.querySelector('.img-preview');
            //     imgPreview.style.display = "block";
            //     const oFReader = new FileReader();
            //     oFReader.readAsDataURL(image.files[0]);
            //     oFReader.onload = function(oFREvent){
            //         imgPreview.src = oFREvent.target.result;
            //     }
            // }

            // Add previewImage (multiple image)
            // function previewImages() {
            //     const previewContainer = document.getElementById('preview-container');
            //     const files = document.getElementById('lampiran').files;
                
            //     // Kosongkan preview lama
            //     previewContainer.innerHTML = "";

            //     // Loop semua file yg dipilih
            //     Array.from(files).forEach(file => {
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             // Buat element <img> baru untuk tiap file
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