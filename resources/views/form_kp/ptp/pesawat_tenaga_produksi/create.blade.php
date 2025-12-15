<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.ptp.pesawat_tenaga_produksi.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
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

                {{-- Nama Mesin --}}
                <div>
                    <input type="text" name="nama_mesin" placeholder="Nama Mesin" id="nama_mesin"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('nama_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('nama_mesin') }}">
                    @error('nama_mesin')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Fungsi --}}
                <div>
                    <input type="text" name="fungsi" placeholder="Fungsi" id="fungsi"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('fungsi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('fungsi') }}">
                    @error('fungsi')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Foto Device --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Safety Device</h2>
                    <label for="foto_device" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_device-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_device[]" id="foto_device" accept="image/*" multiple onchange="previewImage(this, 'foto_device-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_device') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_device')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Safety Device --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Safety Device</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Komponen Utama</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Pendukung Mesin</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <input type="text" name="safety_device1" placeholder="" id="safety_device1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device1') }}">
                        @error('safety_device1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="komponen_utama1" placeholder="" id="komponen_utama1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama1') }}">
                        @error('komponen_utama1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="pendukung_mesin1" placeholder="" id="pendukung_mesin1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin1') }}">
                        @error('pendukung_mesin1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <input type="text" name="safety_device2" placeholder="" id="safety_device2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device2') }}">
                        @error('safety_device2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="komponen_utama2" placeholder="" id="komponen_utama2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama2') }}">
                        @error('komponen_utama2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="pendukung_mesin2" placeholder="" id="pendukung_mesin2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin2') }}">
                        @error('pendukung_mesin2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <input type="text" name="safety_device3" id="safety_device3" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('safety_device3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_device3') }}">
                        @error('safety_device3')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama3" id="komponen_utama3" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('komponen_utama3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('komponen_utama3') }}">
                        @error('komponen_utama3')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin3" id="pendukung_mesin3" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pendukung_mesin3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pendukung_mesin3') }}">
                        @error('pendukung_mesin3')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <input type="text" name="safety_device4" id="safety_device4" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('safety_device4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_device4') }}">
                        @error('safety_device4')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama4" id="komponen_utama4" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('komponen_utama4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('komponen_utama4') }}">
                        @error('komponen_utama4')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin4" id="pendukung_mesin4" placeholder=""
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pendukung_mesin4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pendukung_mesin4') }}">
                        @error('pendukung_mesin4')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <input type="text" name="safety_device5" id="safety_device5" class="block w-full px-3 py-2 mt-1 
                        border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 
                        focus:border-blue-500 sm:text-sm @error('safety_device5') valid:border-red-600 
                        valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('safety_device5') }}">
                        @error('safety_device5') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama5" id="komponen_utama5" class="block w-full px-3 py-2 mt-1 
                        border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 
                        focus:border-blue-500 sm:text-sm @error('komponen_utama5') valid:border-red-600 
                        valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('komponen_utama5') }}">
                        @error('komponen_utama5') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin5" id="pendukung_mesin5" class="block w-full px-3 py-2 mt-1 
                        border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 
                        focus:border-blue-500 sm:text-sm @error('pendukung_mesin5') valid:border-red-600 
                        valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pendukung_mesin5') }}">
                        @error('pendukung_mesin5') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 7 --}}
                    <div>
                        <input type="text" name="safety_device6" id="safety_device6" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device6') }}">
                        @error('safety_device6') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama6" id="komponen_utama6" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama6') }}">
                        @error('komponen_utama6') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin6" id="pendukung_mesin6" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin6') }}">
                        @error('pendukung_mesin6') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 8 --}}
                    <div>
                        <input type="text" name="safety_device7" id="safety_device7" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device7') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device7') }}">
                        @error('safety_device7') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama7" id="komponen_utama7" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama7') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama7') }}">
                        @error('komponen_utama7') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin7" id="pendukung_mesin7" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin7') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin7') }}">
                        @error('pendukung_mesin7') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 9 --}}
                    <div>
                        <input type="text" name="safety_device8" id="safety_device8" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device8') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device8') }}">
                        @error('safety_device8') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama8" id="komponen_utama8" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama8') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama8') }}">
                        @error('komponen_utama8') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin8" id="pendukung_mesin8" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin8') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin8') }}">
                        @error('pendukung_mesin8') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 10 --}}
                    <div>
                        <input type="text" name="safety_device9" id="safety_device9" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device9') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device9') }}">
                        @error('safety_device9') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama9" id="komponen_utama9" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama9') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama9') }}">
                        @error('komponen_utama9') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin9" id="pendukung_mesin9" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin9') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin9') }}">
                        @error('pendukung_mesin9') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 11 --}}
                    <div>
                        <input type="text" name="safety_device10" id="safety_device10" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_device10') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('safety_device10') }}">
                        @error('safety_device10') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="komponen_utama10" id="komponen_utama10" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('komponen_utama10') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('komponen_utama10') }}">
                        @error('komponen_utama10') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="pendukung_mesin10" id="pendukung_mesin10" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pendukung_mesin10') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pendukung_mesin10') }}">
                        @error('pendukung_mesin10') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Foto Pengukuran --}}
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

                {{-- Pengukuran --}}
                <div class="grid items-center grid-cols-2 gap-4">
                    {{-- Baris 1 --}}
                    <div>
                        <input type="number" placeholder="Grounding" step="any" name="pengukuran_grounding" id="pengukuran_grounding" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pengukuran_grounding') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pengukuran_grounding') }}">
                        @error('pengukuran_grounding') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <input type="number" placeholder="Suhu" step="any" name="pengukuran_pencahayaan" id="pengukuran_pencahayaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pengukuran_pencahayaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pengukuran_pencahayaan') }}">
                        @error('pengukuran_pencahayaan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <input type="number" placeholder="Pencahayaan" step="any" name="pengukuran_suhu" id="pengukuran_suhu" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pengukuran_suhu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pengukuran_suhu') }}">
                        @error('pengukuran_suhu') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <input type="number" placeholder="Kebisingan" step="any" name="pengukuran_kebisingan" id="pengukuran_kebisingan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pengukuran_kebisingan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pengukuran_kebisingan') }}">
                        @error('pengukuran_kebisingan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                {{-- Foto Pengujian --}}
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

                {{-- Proteksi --}}
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
                        <input type="text" name="emergency_stop" placeholder="Emergency Stop" id="emergency_stop" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('emergency_stop') }}">
                        @error('emergency_stop')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <select name="emergency_stop_hasil" id="emergency_stop_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            
                            <option value="-" {{ old('emergency_stop_hasil') == '-' ? 'selected' : '' }}>-</option>
                            <option value="Berfungsi" {{ old('emergency_stop_hasil') == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                            <option value="Tidak Berfungsi" {{ old('emergency_stop_hasil') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                            
                        </select>

                        @error('emergency_stop_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="ket_emergency_stop" placeholder="" id="ket_emergency_stop" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ket_emergency_stop') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ket_emergency_stop') }}">
                        @error('ket_emergency_stop')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <input type="text" name="blank" placeholder="" id="blank" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('blank') }}">
                        @error('blank')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <select name="blank_hasil" id="blank_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            
                            <option value="-" {{ old('blank_hasil') == '-' ? 'selected' : '' }}>-</option>
                            <option value="Berfungsi" {{ old('blank_hasil') == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                            <option value="Tidak Berfungsi" {{ old('blank_hasil') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                            
                        </select>

                        @error('blank_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="ket_blank" placeholder="" id="ket_blank" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ket_blank') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ket_blank') }}">
                        @error('ket_blank')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <input type="text" name="blank2" placeholder="" id="blank2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('blank2') }}">
                        @error('blank2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <select name="blank2_hasil" id="blank2_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank2_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            
                            <option value="-" {{ old('blank2_hasil') == '-' ? 'selected' : '' }}>-</option>
                            <option value="Berfungsi" {{ old('blank2_hasil') == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                            <option value="Tidak Berfungsi" {{ old('blank2_hasil') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                            
                        </select>

                        @error('blank2_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="ket_blank2" placeholder="" id="ket_blank2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ket_blank2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ket_blank2') }}">
                        @error('ket_blank2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <input type="text" name="blank3" placeholder="" id="blank3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('blank3') }}">
                        @error('blank3')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <select name="blank3_hasil" id="blank3_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('blank3_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            
                            <option value="-" {{ old('blank3_hasil') == '-' ? 'selected' : '' }}>-</option>
                            <option value="Berfungsi" {{ old('blank3_hasil') == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                            <option value="Tidak Berfungsi" {{ old('blank3_hasil') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                            
                        </select>

                        @error('blank3_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="ket_blank3" placeholder="" id="ket_blank3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ket_blank3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ket_blank3') }}">
                        @error('ket_blank3')
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



