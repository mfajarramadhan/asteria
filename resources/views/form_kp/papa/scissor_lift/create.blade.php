<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.papa.scissor_lift.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
                @csrf
                
                {{-- Tanggal Pemeriksaan --}}
                <div>
                    <label for="tanggal_pemeriksaan" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                    <div class="flex flex-wrap justify-between w-full">
                        {{-- Tanggal Pemeriksaan 1 --}}
                        <div class="w-full md:w-[50%]">
                            <div class="relative">
                                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input required id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tanggal_pemeriksaan') }}"> 
                            </div>
                            @error('tanggal_pemeriksaan')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- foto_informasi_umum --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
                    <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_informasi_umum[]" id="foto_informasi_umum" accept="image/*" multiple onchange="previewImage(this, 'foto_informasi_umum-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_informasi_umum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_informasi_umum')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Nama Perusahaan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->jobOrder->nama_perusahaan }}">
                </div>
                
                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->kapasitas }}">
                </div>
                
                {{-- Model/Tipe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->model }}">
                </div>
                
                {{-- No.Seri --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->no_seri }}">
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat') }}">
                    @error('pabrik_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Jenis Alat --}}
                <div>
                    <input type="text" name="jenis" placeholder="Jenis Alat" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis') }}">
                    @error('jenis')
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

                {{-- Tahun Pembuatan --}}
                <div>
                    <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan') }}">
                    @error('tahun_pembuatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Kapasitas Angkat --}}
                <div>
                    <input type="text" name="kapasitas_angkat" placeholder="Kapasitas Angkat" id="kapasitas_angkat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_angkat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_angkat') }}">
                    @error('kapasitas_angkat')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tinggi Angkat Maksimum --}}
                <div>
                    <input type="text" name="tinggi_angkat_maksimum" placeholder="Tinggi Angkat Maksimum" id="tinggi_angkat_maksimum" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_angkat_maksimum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_angkat_maksimum') }}">
                    @error('tinggi_angkat_maksimum')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kecepatan Angkat --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Kecepatan Angkat
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="kecepatan_angkat_naik"
                                placeholder="Naik" id="kecepatan_angkat_naik"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kecepatan_angkat_naik') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('kecepatan_angkat_naik') }}">

                            @error('kecepatan_angkat_naik')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="kecepatan_angkat_turun"
                                placeholder="Turun" id="kecepatan_angkat_turun"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kecepatan_angkat_turun') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('kecepatan_angkat_turun') }}">

                            @error('kecepatan_angkat_turun')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Tiang Penyangga/Mast --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Tiang Penyangga/Mast
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="tiang_penyangga_panjang"
                                placeholder="Panjang" id="tiang_penyangga_panjang"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('tiang_penyangga_panjang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('tiang_penyangga_panjang') }}">

                            @error('tiang_penyangga_panjang')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="tiang_penyangga_lebar"
                                placeholder="Lebar" id="tiang_penyangga_lebar"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('tiang_penyangga_lebar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('tiang_penyangga_lebar') }}">

                            @error('tiang_penyangga_lebar')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 3 --}}
                        <div>
                            <input type="text" name="tiang_penyangga_tebal"
                                placeholder="Tebal" id="tiang_penyangga_tebal"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('tiang_penyangga_tebal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('tiang_penyangga_tebal') }}">

                            @error('tiang_penyangga_tebal')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                {{-- Platform --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Platform
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="platform_panjang"
                                placeholder="Panjang" id="platform_panjang"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('platform_panjang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('platform_panjang') }}">

                            @error('platform_panjang')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="platform_lebar"
                                placeholder="Lebar" id="platform_lebar"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('platform_lebar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('platform_lebar') }}">

                            @error('platform_lebar')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 3 --}}
                        <div>
                            <input type="text" name="platform_tinggi"
                                placeholder="Tebal" id="platform_tinggi"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('platform_tinggi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('platform_tinggi') }}">

                            @error('platform_tinggi')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                {{-- Torak Hidrolik --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Torak Hidrolik
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="torak_hidrolik_dalam"
                                placeholder="Torak Dalam" id="torak_hidrolik_dalam"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('torak_hidrolik_dalam') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('torak_hidrolik_dalam') }}">

                            @error('torak_hidrolik_dalam')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="torak_hidrolik_luar"
                                placeholder="Torak Luar" id="torak_hidrolik_luar"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('torak_hidrolik_luar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('torak_hidrolik_luar') }}">

                            @error('torak_hidrolik_luar')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 3 --}}
                        <div>
                            <input type="text" name="torak_hidrolik_tinggi"
                                placeholder="Tinggi Torak" id="torak_hidrolik_tinggi"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('torak_hidrolik_tinggi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('torak_hidrolik_tinggi') }}">

                            @error('torak_hidrolik_tinggi')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                {{-- Jig/Kaki Penumpu --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Jig/Kaki Penumpu
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="jig_panjang"
                                placeholder="Panjang" id="jig_panjang"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('jig_panjang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('jig_panjang') }}">

                            @error('jig_panjang')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="jig_lebar"
                                placeholder="Lebar" id="jig_lebar"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('jig_lebar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('jig_lebar') }}">

                            @error('jig_lebar')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 3 --}}
                        <div>
                            <input type="text" name="jig_tebal"
                                placeholder="Tebal" id="jig_tebal"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('jig_tebal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('jig_tebal') }}">

                            @error('jig_tebal')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 4 --}}
                        <div>
                            <input type="text" name="jig_diameter"
                                placeholder="Diameter" id="jig_diameter"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('jig_diameter') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('jig_diameter') }}">

                            @error('jig_diameter')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                {{-- Rem --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Rem
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="text" name="rem_macam"
                                placeholder="Macam" id="rem_macam"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('rem_macam') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('rem_macam') }}">

                            @error('rem_macam')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="text" name="rem_type"
                                placeholder="Type" id="rem_type"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('rem_type') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('rem_type') }}">

                            @error('rem_type')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                {{-- foto_engine --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Engine</h2>
                    <label for="foto_engine" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_engine-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_engine[]" id="foto_engine" accept="image/*" multiple onchange="previewImage(this, 'foto_engine-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_engine') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_engine')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Item --}}
                <div>
                    <input type="text" name="item" placeholder="Item" id="item" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('item') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('item') }}">
                    @error('item')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Voltage --}}
                <div>
                    <input type="text" name="voltage" placeholder="Voltage" id="voltage" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('voltage') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('voltage') }}">
                    @error('voltage')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Daya --}}
                <div>
                    <input type="text" name="daya" placeholder="Daya" id="daya" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('daya') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('daya') }}">
                    @error('daya')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Frequency --}}
                <div>
                    <input type="text" name="frequency" placeholder="Frequency" id="frequency" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('frequency') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('frequency') }}">
                    @error('frequency')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phase --}}
                <div>
                    <input type="text" name="phase" placeholder="Phase" id="phase" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phase') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('phase') }}">
                    @error('phase')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Arus --}}
                <div>
                    <input type="text" name="arus" placeholder="Arus" id="arus" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('arus') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('arus') }}">
                    @error('arus')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Beban --}}
                <div>
                    <input type="text" name="beban" placeholder="Beban" id="beban" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban') }}">
                    @error('beban')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Putaran --}}
                <div>
                    <input type="text" name="putaran" placeholder="Putaran" id="putaran" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline:none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('putaran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('putaran') }}">
                    @error('putaran')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- foto_loadtest --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
                    <label for="foto_loadtest" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_loadtest-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_loadtest[]" id="foto_loadtest" accept="image/*" multiple onchange="previewImage(this, 'foto_loadtest-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_loadtest') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_loadtest')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Pengujian --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-5 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Swl Tinggi Angkat</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Beban Uji Load Chard</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Lifting/Kecepatan</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil</label>
                        </div>
                        
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <input type="text" name="swl_tinggi_angkat1" id="swl_tinggi_angkat1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat1') }}">
                            @error('swl_tinggi_angkat1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="beban_uji_load_chard1" id="beban_uji_load_chard1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard1') }}">
                            @error('beban_uji_load_chard1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="lifting1" id="lifting1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lifting1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lifting1') }}">
                            @error('lifting1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="hasil1" id="hasil1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil1') }}">
                            @error('hasil1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="keterangan1" id="keterangan1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keterangan1') }}">
                            @error('keterangan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <input type="text" name="swl_tinggi_angkat2" id="swl_tinggi_angkat2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat2') }}">
                            @error('swl_tinggi_angkat2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="beban_uji_load_chard2" id="beban_uji_load_chard2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard2') }}">
                            @error('beban_uji_load_chard2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="lifting2" id="lifting2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lifting2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lifting2') }}">
                            @error('lifting2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="hasil2" id="hasil2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil2') }}">
                            @error('hasil2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="keterangan2" id="keterangan2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keterangan2') }}">
                            @error('keterangan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <input type="text" name="swl_tinggi_angkat3" id="swl_tinggi_angkat3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat3') }}">
                            @error('swl_tinggi_angkat3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="beban_uji_load_chard3" id="beban_uji_load_chard3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard3') }}">
                            @error('beban_uji_load_chard3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="lifting3" id="lifting3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lifting3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lifting3') }}">
                            @error('lifting3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="hasil3" id="hasil3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil3') }}">
                            @error('hasil3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="keterangan3" id="keterangan3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keterangan3') }}">
                            @error('keterangan3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                {{-- Catatan --}}
                <div>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan') }}</textarea>
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



