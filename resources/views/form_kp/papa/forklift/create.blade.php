<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.papa.forklift.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
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
                
                {{-- foto_kecepatan --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Kecepatan (Speed)</h2>
                    <label for="foto_kecepatan" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_kecepatan-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_kecepatan[]" id="foto_kecepatan" accept="image/*" multiple onchange="previewImage(this, 'foto_kecepatan-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_kecepatan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Kecepatan Angkat --}}
                <div>
                    <input type="text" name="kecepatan_angkat" placeholder="Angkat/Lifting" id="kecepatan_angkat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_angkat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_angkat') }}">
                    @error('kecepatan_angkat')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kecepatan Ungkit --}}
                <div>
                    <input type="text" name="kecepatan_ungkit" placeholder="Ungkit/Tilting" id="kecepatan_ungkit" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_ungkit') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_ungkit') }}">
                    @error('kecepatan_ungkit')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kecepatan Jalan --}}
                <div>
                    <input type="text" name="kecepatan_jalan" placeholder="Jalan/Travelling" id="kecepatan_jalan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_jalan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_jalan') }}">
                    @error('kecepatan_jalan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_radius --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Radius Putaran</h2>
                    <label for="foto_radius" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_radius-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_radius[]" id="foto_radius" accept="image/*" multiple onchange="previewImage(this, 'foto_radius-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_radius') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_radius')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Radius Putaran Kiri --}}
                <div>
                    <input type="text" name="radius_putaran_kiri" placeholder="Kiri Max/Min" id="radius_putaran_kiri" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('radius_putaran_kiri') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('radius_putaran_kiri') }}">
                    @error('radius_putaran_kiri')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Radius Putaran Kanan --}}
                <div>
                    <input type="text" name="radius_putaran_kanan" placeholder="Kanan Max/Min" id="radius_putaran_kanan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('radius_putaran_kanan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring:red-200 @enderror" value="{{ old('radius_putaran_kanan') }}">
                    @error('radius_putaran_kanan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penggerak --}}
                <div>
                    <input type="text" name="penggerak" placeholder="Penggerak Utama" id="penggerak" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('penggerak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring:red-200 @enderror" value="{{ old('penggerak') }}">
                    @error('penggerak')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Operator --}}
                <div>
                    <input type="text" name="nama_operator" placeholder="Nama Operator" id="nama_operator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_operator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring:red-200 @enderror" value="{{ old('nama_operator') }}">
                    @error('nama_operator')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sertifikat Operator SIO --}}
                <div>
                    <input type="text" name="sertifikat_operator_sio" placeholder="Sertifikat Operator (SIO)" id="sertifikat_operator_sio" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('sertifikat_operator_sio') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring:red-200 @enderror" value="{{ old('sertifikat_operator_sio') }}">
                    @error('sertifikat_operator_sio')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_dimensi_forklift --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Forklift</h2>
                    <label for="foto_dimensi_forklift" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_dimensi_forklift-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_dimensi_forklift[]" id="foto_dimensi_forklift" accept="image/*" multiple onchange="previewImage(this, 'foto_dimensi_forklift-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_dimensi_forklift')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Panjang Dimensi Forklift --}}
                <div>
                    <input type="text" name="panjang_dimensi_forklift" placeholder="Panjang" id="panjang_dimensi_forklift" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('panjang_dimensi_forklift') }}">
                    @error('panjang_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lebar Dimensi Forklift --}}
                <div>
                    <input type="text" name="lebar_dimensi_forklift" placeholder="Lebar" id="lebar_dimensi_forklift" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_dimensi_forklift') }}">
                    @error('lebar_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tinggi Dimensi Forklift --}}
                <div>
                    <input type="text" name="tinggi_dimensi_forklift" placeholder="Tinggi" id="tinggi_dimensi_forklift" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_dimensi_forklift') }}">
                    @error('tinggi_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_garpu --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Garpu/Fork</h2>
                    <label for="foto_garpu" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_garpu-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_garpu[]" id="foto_garpu" accept="image/*" multiple onchange="previewImage(this, 'foto_garpu-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_garpu')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tinggi Garpu --}}
                <div>
                    <input type="text" name="tinggi_garpu" placeholder="Tinggi" id="tinggi_garpu" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_garpu') }}">
                    @error('tinggi_garpu')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lebar Garpu --}}
                <div>
                    <input type="text" name="lebar_garpu" placeholder="Lebar" id="lebar_garpu" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_garpu') }}">
                    @error('lebar_garpu')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-3 gap-3">
                    {{-- Tebal Garpu 1 --}}
                    <div>
                        <input type="text" name="tebal_garpu1" placeholder="Tebal 1" id="tebal_garpu1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_garpu1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu1') }}">

                        @error('tebal_garpu1')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tebal Garpu 2 --}}
                    <div>
                        <input type="text" name="tebal_garpu2" placeholder="Tebal 2" id="tebal_garpu2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_garpu2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu2') }}">

                        @error('tebal_garpu2')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tebal Garpu 3 --}}
                    <div>
                        <input type="text" name="tebal_garpu3" placeholder="Tebal 3" id="tebal_garpu3"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_garpu3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu3') }}">

                        @error('tebal_garpu3')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- foto_pagar --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pagar/Back Rest</h2>
                    <label for="foto_pagar" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pagar-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pagar[]" id="foto_pagar" accept="image/*" multiple onchange="previewImage(this, 'foto_pagar-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pagar')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tinggi Pagar --}}
                <div>
                    <input type="text" name="tinggi_pagar" placeholder="Tinggi" id="tinggi_pagar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_pagar') }}">
                    @error('tinggi_pagar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lebar Pagar --}}
                <div>
                    <input type="text" name="lebar_pagar" placeholder="Lebar" id="lebar_pagar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_pagar') }}">
                    @error('lebar_pagar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_mast --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Mast</h2>
                    <label for="foto_mast" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_mast-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_mast[]" id="foto_mast" accept="image/*" multiple onchange="previewImage(this, 'foto_mast-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_mast')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tinggi Mast --}}
                <div>
                    <input type="text" name="tinggi_mast" placeholder="Tinggi" id="tinggi_mast" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_mast') }}">
                    @error('tinggi_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lebar Mast --}}
                <div>
                    <input type="text" name="lebar_mast" placeholder="Lebar" id="lebar_mast" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_mast') }}">
                    @error('lebar_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tebal Mast --}}
                <div>
                    <input type="text" name="tebal_mast" placeholder="Tebal" id="tebal_mast" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_mast') }}">
                    @error('tebal_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- foto_torak --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Torak/Hidrolik</h2>
                    <label for="foto_torak" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_torak-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_torak[]" id="foto_torak" accept="image/*" multiple onchange="previewImage(this, 'foto_torak-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_torak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_torak')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Torak Dalam --}}
                <div>
                    <input type="text" name="torak_dalam" placeholder="Torak Dalam" id="torak_dalam" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('torak_dalam') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('torak_dalam') }}">
                    @error('torak_dalam')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Torak Luar --}}
                <div>
                    <input type="text" name="torak_luar" placeholder="Torak Luar" id="torak_luar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('torak_luar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('torak_luar') }}">
                    @error('torak_luar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tinggi Torak --}}
                <div>
                    <input type="text" name="tinggi_torak" placeholder="Tinggi Torak" id="tinggi_torak" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_torak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_torak') }}">
                    @error('tinggi_torak')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_jarak_antarroda --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Jarak Antar Roda</h2>
                    <label for="foto_jarak_antarroda" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_jarak_antarroda-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_jarak_antarroda[]" id="foto_jarak_antarroda" accept="image/*" multiple onchange="previewImage(this, 'foto_jarak_antarroda-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_jarak_antarroda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_jarak_antarroda')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Jarak Roda Depan --}}
                <div>
                    <input type="text" name="jarak_roda_depan" placeholder="Bagian Depan" id="jarak_roda_depan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_roda_depan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_roda_depan') }}">
                    @error('jarak_roda_depan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jarak Roda Belakang --}}
                <div>
                    <input type="text" name="jarak_roda_belakang" placeholder="Bagian Belakang" id="jarak_roda_belakang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_roda_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_roda_belakang') }}">
                    @error('jarak_roda_belakang')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jarak As Roda Depan Belakang --}}
                <div>
                    <input type="text" name="jarak_as_roda_depan_belakang" placeholder="Jarak As Roda Depan-Belakang" id="jarak_as_roda_depan_belakang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_as_roda_depan_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_as_roda_depan_belakang') }}">
                    @error('jarak_as_roda_depan_belakang')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_load_test --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
                    <label for="foto_load_test" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_load_test-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_load_test[]" id="foto_load_test" accept="image/*" multiple onchange="previewImage(this, 'foto_load_test-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_load_test') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_load_test')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Pengujian --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Swl Tinggi Angkat</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Beban Uji Load Chard</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Travelling/ Kecepatan</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Gerakan (mm)</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil</label>
                        </div>
                        
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <input type="number" step="any" name="tinggi_angkat_hook1" id="tinggi_angkat_hook1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_angkat_hook1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_angkat_hook1') }}">
                            @error('tinggi_angkat_hook1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="swl_beban_uji1" id="swl_beban_uji1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_beban_uji1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_beban_uji1') }}">
                            @error('swl_beban_uji1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="travelling_kecepatan1" id="travelling_kecepatan1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling_kecepatan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling_kecepatan1') }}">
                            @error('travelling_kecepatan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="gerakan1" id="gerakan1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('gerakan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('gerakan1') }}">
                            @error('gerakan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="hasil1" id="hasil1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil1') }}">
                            @error('hasil1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="keterangan1" id="keterangan1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keterangan1') }}">
                            @error('keterangan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <input type="number" step="any" name="tinggi_angkat_hook2" id="tinggi_angkat_hook2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_angkat_hook2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_angkat_hook2') }}">
                            @error('tinggi_angkat_hook2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="swl_beban_uji2" id="swl_beban_uji2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_beban_uji2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_beban_uji2') }}">
                            @error('swl_beban_uji2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="travelling_kecepatan2" id="travelling_kecepatan2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling_kecepatan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling_kecepatan2') }}">
                            @error('travelling_kecepatan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="gerakan2" id="gerakan2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('gerakan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('gerakan2') }}">
                            @error('gerakan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="hasil2" id="hasil2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil2') }}">
                            @error('hasil2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="text" name="keterangan2" id="keterangan2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keterangan2') }}">
                            @error('keterangan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <input type="number" step="any" name="tinggi_angkat_hook3" id="tinggi_angkat_hook3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_angkat_hook3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_angkat_hook3') }}">
                            @error('tinggi_angkat_hook3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="swl_beban_uji3" id="swl_beban_uji3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_beban_uji3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_beban_uji3') }}">
                            @error('swl_beban_uji3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="travelling_kecepatan3" id="travelling_kecepatan3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling_kecepatan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling_kecepatan3') }}">
                            @error('travelling_kecepatan3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="gerakan3" id="gerakan3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('gerakan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('gerakan3') }}">
                            @error('gerakan3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="hasil3" id="hasil3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('hasil3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('hasil3') }}">
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



