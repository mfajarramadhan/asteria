<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.papa.dump_trailer.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
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
                
                {{-- Panjang Keseluruhan --}}
                <div>
                    <input type="number" step="any" name="panjang_keseluruhan" placeholder="Panjang Keseluruhan" id="panjang_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('panjang_keseluruhan') }}">
                    @error('panjang_keseluruhan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Tinggi Keseluruhan --}}
                <div>
                    <input type="number" step="any" name="tinggi_keseluruhan" placeholder="Tinggi Keseluruhan" id="tinggi_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_keseluruhan') }}">
                    @error('tinggi_keseluruhan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Ketinggian Kabin --}}
                <div>
                    <input type="number" step="any" name="ketinggian_kabin" placeholder="Ketinggian Kabin" id="ketinggian_kabin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ketinggian_kabin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ketinggian_kabin') }}">
                    @error('ketinggian_kabin')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Lebar Keseluruhan --}}
                <div>
                    <input type="number" step="any" name="lebar_keseluruhan" placeholder="Lebar Keseluruhan" id="lebar_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_keseluruhan') }}">
                    @error('lebar_keseluruhan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Kecepatan --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- Left: Label --}}
                    <div class="flex items-center">
                        <label class="block text-sm font-medium text-gray-700">
                            Kecepatan
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        {{-- Input 1 --}}
                        <div>
                            <input type="number" step="any" name="kecepatan_angkat"
                                placeholder="Angkat/Lifting" id="kecepatan_angkat"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kecepatan_angkat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('kecepatan_angkat') }}">

                            @error('kecepatan_angkat')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 2 --}}
                        <div>
                            <input type="number" step="any" name="kecepatan_turun"
                                placeholder="Turun/Lowering" id="kecepatan_turun"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kecepatan_turun') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('kecepatan_turun') }}">

                            @error('kecepatan_turun')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input 3 --}}
                        <div>
                            <input type="number" step="any" name="kecepatan_travelling"
                                placeholder="Travelling" id="kecepatan_travelling"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kecepatan_travelling') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('kecepatan_travelling') }}">

                            @error('kecepatan_travelling')
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Perlengkapan --}}
                <div>
                    <input type="text" name="perlengkapan" placeholder="Perlengkapan/Attachment" id="perlengkapan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('perlengkapan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('perlengkapan') }}">
                    @error('perlengkapan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Berat Kendaraan --}}
                <div>
                    <input type="number" step="any" name="berat_kendaraan" placeholder="Berat Kendaraan" id="berat_kendaraan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('berat_kendaraan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('berat_kendaraan') }}">
                    @error('berat_kendaraan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- foto_penggerak_utama --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Penggerak Utama (Engine)</h2>
                    <label for="foto_penggerak_utama" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_penggerak_utama-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_penggerak_utama[]" id="foto_penggerak_utama" accept="image/*" multiple onchange="previewImage(this, 'foto_penggerak_utama-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_penggerak_utama') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_penggerak_utama')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Merk/Type --}}
                <div>
                    <input type="text" name="merk_type" placeholder="Merk/Type" id="merk_type"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('merk_type') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('merk_type') }}">
                    @error('merk_type')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Nomor Seri --}}
                <div>
                    <input type="text" name="nomor_seri" placeholder="Nomor Seri" id="nomor_seri"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('nomor_seri') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('nomor_seri') }}">
                    @error('nomor_seri')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jumlah Silinder --}}
                <div>
                    <input type="text" name="jumlah_silinder" placeholder="Jumlah Silinder" id="jumlah_silinder"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('jumlah_silinder') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('jumlah_silinder') }}">
                    @error('jumlah_silinder')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Daya --}}
                <div>
                    <input type="text" name="daya" placeholder="Daya" id="daya"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('daya') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('daya') }}">
                    @error('daya')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tahun Pembuatan --}}
                <div>
                    <input type="text" name="tahun_pembuatan_mesin" placeholder="Tahun Pembuatan" id="tahun_pembuatan_mesin"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tahun_pembuatan_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tahun_pembuatan_mesin') }}">
                    @error('tahun_pembuatan_mesin')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Pabrik Pembuatan --}}
                <div>
                    <input type="text" name="pabrik_pembuatan_mesin" placeholder="Pabrik Pembuatan" id="pabrik_pembuatan_mesin"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('pabrik_pembuatan_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pabrik_pembuatan_mesin') }}">
                    @error('pabrik_pembuatan_mesin')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- foto_tekanan_roda --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Tekanan Roda (Tire Pressure)</h2>
                    <label for="foto_tekanan_roda" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_tekanan_roda-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_tekanan_roda[]" id="foto_tekanan_roda" accept="image/*" multiple onchange="previewImage(this, 'foto_tekanan_roda-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_tekanan_roda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_tekanan_roda')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Roda Penggerak --}}
                <div>
                    <input type="number" step="any" name="roda_penggerak" placeholder="Roda Penggerak" id="roda_penggerak"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('roda_penggerak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('roda_penggerak') }}">

                    @error('roda_penggerak')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Roda Kemudi --}}
                <div>
                    <input type="number" step="any" name="roda_kemudi" placeholder="Roda Kemudi" id="roda_kemudi"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('roda_kemudi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('roda_kemudi') }}">

                    @error('roda_kemudi')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_roda_penggerak --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Roda Penggerak (Drive Wheel)</h2>
                    <label for="foto_roda_penggerak" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_roda_penggerak-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_roda_penggerak[]" id="foto_roda_penggerak" accept="image/*" multiple onchange="previewImage(this, 'foto_roda_penggerak-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_roda_penggerak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_roda_penggerak')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Ukuran --}}
                <div>
                    <input type="text" name="ukuran" placeholder="Ukuran" id="ukuran"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('ukuran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('ukuran') }}">

                    @error('ukuran')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tipe --}}
                <div>
                    <input type="text" name="tipe" placeholder="Tipe" id="tipe"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tipe') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tipe') }}">

                    @error('tipe')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- foto_roda_kemudi --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Roda Kemudi (Steering Wheel)</h2>
                    <label for="foto_roda_kemudi" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_roda_kemudi-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_roda_kemudi[]" id="foto_roda_kemudi" accept="image/*" multiple onchange="previewImage(this, 'foto_roda_kemudi-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_roda_kemudi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_roda_kemudi')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Ukuran --}}
                <div>
                    <input type="text" name="ukuran2" placeholder="Ukuran" id="ukuran2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('ukuran2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('ukuran2') }}">

                    @error('ukuran2')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tipe --}}
                <div>
                    <input type="text" name="tipe2" placeholder="Tipe" id="tipe2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tipe2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tipe2') }}">

                    @error('tipe2')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- foto_pompa_hidrolik --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pompa Hidrolik</h2>
                    <label for="foto_pompa_hidrolik" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pompa_hidrolik-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pompa_hidrolik[]" id="foto_pompa_hidrolik" accept="image/*" multiple onchange="previewImage(this, 'foto_pompa_hidrolik-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pompa_hidrolik') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pompa_hidrolik')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Tipe Pompa --}}
                <div>
                    <input type="text" name="tipe_pompa" placeholder="Tipe" id="tipe_pompa"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tipe_pompa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tipe_pompa') }}">

                    @error('tipe_pompa')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Tekanan Pompa --}}
                <div>
                    <input type="text" name="tekanan_pompa" placeholder="Tekanan" id="tekanan_pompa"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tekanan_pompa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tekanan_pompa') }}">
                        
                        @error('tekanan_pompa')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Relief Valve Pompa --}}
                <div>
                    <input type="text" name="relief_valve_pompa" placeholder="Relief Valve" id="relief_valve_pompa"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('relief_valve_pompa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('relief_valve_pompa') }}">
                        
                    @error('relief_valve_pompa')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                    
                {{-- foto_pengujian --}}
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
                            <input type="number" step="any" name="swl_tinggi_angkat1" id="swl_tinggi_angkat1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat1') }}">
                            @error('swl_tinggi_angkat1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="beban_uji_load1" id="beban_uji_load1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load1') }}">
                            @error('beban_uji_load1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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
                            <input type="number" step="any" name="swl_tinggi_angkat2" id="swl_tinggi_angkat2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat2') }}">
                            @error('swl_tinggi_angkat2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="beban_uji_load2" id="beban_uji_load2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load2') }}">
                            @error('beban_uji_load2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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
                            <input type="number" step="any" name="swl_tinggi_angkat3" id="swl_tinggi_angkat3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat3') }}">
                            @error('swl_tinggi_angkat3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="beban_uji_load3" id="beban_uji_load3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load3') }}">
                            @error('beban_uji_load3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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



