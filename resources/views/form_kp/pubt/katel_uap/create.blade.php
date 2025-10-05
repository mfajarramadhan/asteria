<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.katel_uap.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
                @csrf
                
                {{-- Tanggal Pemeriksaan --}}
                <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
                <div class="flex flex-wrap justify-between w-full gap-y-4">
                    {{-- Tanggal Pemeriksaan 1 --}}
                    <div class="w-full md:w-[50%]">
                        <div class="relative">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 shadow-md text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tanggal_pemeriksaan') }}"> 
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
                    <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" id="nama_perusahaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_perusahaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan') }}">
                    @error('nama_perusahaan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                <h2 class="block text-sm font-bold text-gray-700">Informasi Umum</h2>
                
                {{-- Informasi Umum --}}
                {{-- Foto foto_informasi_umum --}}
                <div>
                    <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto Informasi Umum</label>
                    <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_informasi_umum[]" id="foto_informasi_umum" accept="image/*" multiple onchange="previewImage(this, 'foto_informasi_umum-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_informasi_umum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_informasi_umum')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jenis Alat --}}
                <div>
                    <input type="text" name="jenis_alat" placeholder="Jenis Alat" id="jenis_alat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_alat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_alat') }}">
                    @error('jenis_alat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Merk Model --}}
                <div>
                    <input type="text" name="merk_model" placeholder="Merk/Model" id="merk_model" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('merk_model') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('merk_model') }}">
                    @error('merk_model')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Tempat & Tahun Pembuatan --}}
                <div>
                    <input type="text" name="tempat_tahun_pembuatan" placeholder="Tempat & Tahun Pembuatan" id="tempat_tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tempat_tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tempat_tahun_pembuatan') }}">
                    @error('tempat_tahun_pembuatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- No. Seri/No. Unit --}}
                <div>
                    <input type="text" name="no_seri_unit" placeholder="No. Seri/No. Unit" id="no_seri_unit" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('no_seri_unit') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('no_seri_unit') }}">
                    @error('no_seri_unit')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Tekanan Desain --}}
                <div>
                    <input type="number" step="0.001" name="tekanan_desain" placeholder="Tekanan Desain" id="tekanan_desain" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_desain') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_desain') }}">
                    @error('tekanan_desain')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Tekanan Kerja --}}
                <div>
                    <input type="number" step="0.001" name="tekanan_kerja" placeholder="Tekanan Kerja" id="tekanan_kerja" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_kerja') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_kerja') }}">
                    @error('tekanan_kerja')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Kapasitas Uap --}}
                <div>
                    <input type="text" name="kapasitas_uap" placeholder="Kapasitas Uap" id="kapasitas_uap" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_uap') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_uap') }}">
                    @error('kapasitas_uap')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Luas Pemanasan --}}
                <div>
                    <input type="number" step="0.001" name="luas_pemanasan" placeholder="Luas Pemanasan" id="luas_pemanasan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('luas_pemanasan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('luas_pemanasan') }}">
                    @error('luas_pemanasan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Work Temperature --}}
                <div>
                    <input type="number" step="0.001" name="work_temperature" placeholder="Work Temperature" id="work_temperature" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('work_temperature') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('work_temperature') }}">
                    @error('work_temperature')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Bahan Bakar --}}
                <div>
                    <input type="text" name="bahan_bakar" placeholder="Bahan Bakar" id="bahan_bakar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('bahan_bakar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('bahan_bakar') }}">
                    @error('bahan_bakar')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Lokasi --}}
                <div>
                    <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi') }}">
                    @error('lokasi')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_safety_valve --}}
                <div>
                    <label for="foto_safety_valve" class="block mt-10 mb-1 text-sm font-medium text-gray-700">Foto Safety Valve</label>
                    <div id="foto_safety_valve-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_safety_valve[]" id="foto_safety_valve" accept="image/*" multiple onchange="previewImage(this, 'foto_safety_valve-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_safety_valve') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_safety_valve')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Safety Valve --}}
                <div class="grid grid-cols-3 gap-4 items-center">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Item</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Membuka</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Menutup</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="safety_valve1_membuka" class="block text-sm text-gray-700">Safety Valve 1</label>
                    </div>
                    <div>
                        <input type="number" step="0.001" name="safety_valve1_membuka" placeholder="" id="safety_valve1_membuka" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve1_membuka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_valve1_membuka') }}">
                        @error('safety_valve1_membuka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="0.001" name="safety_valve1_menutup" placeholder="" id="safety_valve1_menutup" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve1_menutup') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_valve1_menutup') }}">
                        @error('safety_valve1_menutup')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="safety_valve2_membuka" class="block text-sm text-gray-700">Safety Valve 2</label>
                    </div>
                    <div>
                        <input type="number" step="0.001" name="safety_valve2_membuka" placeholder="" id="safety_valve2_membuka" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve2_membuka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_valve2_membuka') }}">
                        @error('safety_valve2_membuka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="0.001" name="safety_valve2_menutup" placeholder="" id="safety_valve2_menutup" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve2_menutup') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_valve2_menutup') }}">
                        @error('safety_valve2_menutup')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Safety Valve --}}
                <div>
                    <textarea name="catatan_safety_valve" id="catatan_safety_valve" placeholder="Catatan Safety Valve" rows="2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('catatan_safety_valve') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_safety_valve') }}</textarea>
                    @error('catatan_safety_valve')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Foto foto_pressure_switch --}}
                <div>
                    <label for="foto_pressure_switch" class="block mb-1 mt-10 text-sm font-medium text-gray-700">Foto Pressure Switch</label>
                    <div id="foto_pressure_switch-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pressure_switch[]" id="foto_pressure_switch" accept="image/*" multiple onchange="previewImage(this, 'foto_pressure_switch-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pressure_switch')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Pressure Switch --}}
                <div class="grid grid-cols-3 gap-4 items-center">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Deskripsi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Tekanan Setting</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm text-gray-700 font-bold">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="pressure_switch_on_set" class="block text-sm text-gray-700">Pressure Switch On</label>
                    </div>
                    <div>
                        <input type="number" step="0.001" name="pressure_switch_on_set" placeholder="" id="pressure_switch_on_set" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pressure_switch_on_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pressure_switch_on_set') }}">
                        @error('pressure_switch_on_set')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="0.001" name="pressure_switch_on_hasil" placeholder="" id="pressure_switch_on_hasil" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pressure_switch_on_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pressure_switch_on_hasil') }}">
                        @error('pressure_switch_on_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="pressure_switch_off_set" class="block text-sm text-gray-700">Pressure Switch Off</label>
                    </div>
                    <div>
                        <input type="number" step="0.001" name="pressure_switch_off_set" placeholder="" id="pressure_switch_off_set" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pressure_switch_off_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pressure_switch_off_set') }}">
                        @error('pressure_switch_off_set')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="0.001" name="pressure_switch_off_hasil" placeholder="" id="pressure_switch_off_hasil" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pressure_switch_off_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pressure_switch_off_hasil') }}">
                        @error('pressure_switch_off_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Pressure Switch --}}
                <div>
                    <textarea name="catatan_pressure_switch" id="catatan_pressure_switch" placeholder="Catatan Pressure Switch" rows="2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('catatan_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_pressure_switch') }}</textarea>
                    @error('catatan_pressure_switch')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan') }}</textarea>
                    @error('catatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%]">
                    Simpan
                </button>
            </form>
        </div>
        <script>
            // Add preview image
            function previewImage(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = "";

            Array.from(inputElement.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("max-h-32", "rounded", "border", "m-1");
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
        </script>
</x-layout>



