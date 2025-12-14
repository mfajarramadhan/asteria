<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.ptp.motor_diesel.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
                @csrf
                
                {{-- Tanggal Pemeriksaan --}}
                <div>
                    <label for="tanggal_pemeriksaan" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                    <div class="flex flex-wrap justify-between w-full gap-y-4">
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

                {{-- Jenis --}}
                <div>
                    <input type="text" name="jenis" placeholder="Jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis') }}">
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
                
                {{-- foto_mesin --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Engine</h2>
                    <label for="foto_mesin" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_mesin-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_mesin[]" id="foto_mesin" accept="image/*" multiple onchange="previewImage(this, 'foto_mesin-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_mesin')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <input type="text" name="pabrik_pembuat_mesin" placeholder="Pabrik Pembuat" id="pabrik_pembuat_mesin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat_mesin') }}">
                    @error('pabrik_pembuat_mesin')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Nomor Seri --}}
                <div>
                    <input type="text" name="nomor_seri_mesin" placeholder="Nomor Seri" id="nomor_seri_mesin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nomor_seri_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nomor_seri_mesin') }}">
                    @error('nomor_seri_mesin')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Daya Mesin --}}
                <div>
                    <input type="number" step="any" name="daya_mesin" placeholder="Daya" id="daya_mesin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('daya_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('daya_mesin') }}">
                    @error('daya_mesin')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Jumlah Silinder --}}
                <div>
                    <input type="text" name="jumlah_silinder" placeholder="Jumlah Silinder" id="jumlah_silinder" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_silinder') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jumlah_silinder') }}">
                    @error('jumlah_silinder')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- foto_generator --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Generator</h2>
                    <label for="foto_generator" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_generator-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_generator[]" id="foto_generator" accept="image/*" multiple onchange="previewImage(this, 'foto_generator-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_generator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_generator')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <input type="text" name="pabrik_pembuat_generator" placeholder="Pabrik Pembuat" id="pabrik_pembuat_generator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat_generator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat_generator') }}">
                    @error('pabrik_pembuat_generator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Nomor Seri --}}
                <div>
                    <input type="text" name="nomor_seri_generator" placeholder="Nomor Seri" id="nomor_seri_generator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nomor_seri_generator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nomor_seri_generator') }}">
                    @error('nomor_seri_generator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- foto_pengukuran --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
                    <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pengukuran-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pengukuran[]" id="foto_pengukuran" accept="image/*" multiple onchange="previewImage(this, 'foto_pengukuran-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pengukuran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pengukuran')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Grounding 1 --}}
                <div>
                    <input type="text" name="grounding1" placeholder="Grounding 1 (Hasil) - PLTD" id="grounding1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('grounding1') }}">
                    @error('grounding1')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Grounding 2 --}}
                <div>
                    <input type="text" name="grounding2" placeholder="Grounding 1 (Hasil) - Panel LVMDP" id="grounding2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('grounding2') }}">
                    @error('grounding2')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Getaran --}}
                <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Getaran</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="pondasi" class="block text-sm text-gray-700">Pondasi</label>
                    </div>
                    <div>
                        <input type="text" name="pondasi" placeholder="" id="pondasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pondasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pondasi') }}">
                        @error('pondasi')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="rangka" class="block text-sm text-gray-700">Rangka</label>
                    </div>
                    <div>
                        <input type="text" name="rangka" placeholder="" id="rangka" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('rangka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('rangka') }}">
                        @error('rangka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label for="cover_kipas" class="block text-sm text-gray-700">Cover Kipas</label>
                    </div>
                    <div>
                        <input type="text" name="cover_kipas" placeholder="" id="cover_kipas" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('cover_kipas') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('cover_kipas') }}">
                        @error('cover_kipas')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Pencahayaan --}}
                <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Pencahayaan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="pencahayaan_depan" class="block text-sm text-gray-700">Bagian Depan Diesel</label>
                    </div>
                    <div>
                        <input type="text" name="pencahayaan_depan" placeholder="" id="pencahayaan_depan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_depan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pencahayaan_depan') }}">
                        @error('pencahayaan_depan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="pencahayaan_belakang" class="block text-sm text-gray-700">Bagian Belakang</label>
                    </div>
                    <div>
                        <input type="text" name="pencahayaan_belakang" placeholder="" id="pencahayaan_belakang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pencahayaan_belakang') }}">
                        @error('pencahayaan_belakang')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label for="pencahayaan_tengah" class="block text-sm text-gray-700">Bagian Tengah</label>
                    </div>
                    <div>
                        <input type="text" name="pencahayaan_tengah" placeholder="" id="pencahayaan_tengah" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_tengah') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pencahayaan_tengah') }}">
                        @error('pencahayaan_tengah')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label for="pencahayaan_depan_panel" class="block text-sm text-gray-700">Depan Panel</label>
                    </div>
                    <div>
                        <input type="text" name="pencahayaan_depan_panel" placeholder="" id="pencahayaan_depan_panel" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_depan_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pencahayaan_depan_panel') }}">
                        @error('pencahayaan_depan_panel')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Kebisingan --}}
                <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Kebisingan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="kebisingan_ruang_pltd" class="block text-sm text-gray-700">Dalam Ruang PLTD</label>
                    </div>
                    <div>
                        <input type="text" name="kebisingan_ruang_pltd" placeholder="" id="kebisingan_ruang_pltd" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_ruang_pltd') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kebisingan_ruang_pltd') }}">
                        @error('kebisingan_ruang_pltd')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="kebisingan_ruang_kontrol" class="block text-sm text-gray-700">Ruang Kontrol</label>
                    </div>
                    <div>
                        <input type="text" name="kebisingan_ruang_kontrol" placeholder="" id="kebisingan_ruang_kontrol" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_ruang_kontrol') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kebisingan_ruang_kontrol') }}">
                        @error('kebisingan_ruang_kontrol')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label for="kebisingan_luar_ruang_pltd" class="block text-sm text-gray-700">Diluar Area PLTD</label>
                    </div>
                    <div>
                        <input type="text" name="kebisingan_luar_ruang_pltd" placeholder="" id="kebisingan_luar_ruang_pltd" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_luar_ruang_pltd') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kebisingan_luar_ruang_pltd') }}">
                        @error('kebisingan_luar_ruang_pltd')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label for="kebisingan_area_kerja" class="block text-sm text-gray-700">Aream Kerja</label>
                    </div>
                    <div>
                        <input type="text" name="kebisingan_area_kerja" placeholder="" id="kebisingan_area_kerja" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_area_kerja') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kebisingan_area_kerja') }}">
                        @error('kebisingan_area_kerja')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Pengujian --}}
                {{-- Foto --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pengujian</h2>
                    <label for="foto_pengujian" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pengujian-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pengujian[]" id="foto_pengujian" accept="image/*" multiple onchange="previewImage(this, 'foto_pengujian-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pengujian') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pengujian')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jenis Proteksi --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Jenis Proteksi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil Pengujian</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="emergency_stop" class="block text-sm text-gray-700">Emergency Stop</label>
                    </div>
                    <div>
                        <select name="emergency_stop" id="emergency_stop"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            
                            <option value="-" {{ old('emergency_stop') == '-' ? 'selected' : '' }}>-</option>
                            <option value="Berfungsi" {{ old('emergency_stop') == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                            <option value="Tidak Berfungsi" {{ old('emergency_stop') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                            
                        </select>

                        @error('emergency_stop')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="emergency_stop_ket" placeholder="" id="emergency_stop_ket" class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop_ket') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('emergency_stop_ket') }}">
                        @error('emergency_stop_ket')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
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



