<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.papa.crane.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
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
                    <input type="text" name="jenis_alat" placeholder="Jenis Alat" id="jenis_alat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_alat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_alat') }}">
                    @error('jenis_alat')
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

                {{-- Tinggi Angkat Maksimum --}}
                <div>
                    <input type="number" step="any" name="tinggi_angkat_maksimum" placeholder="Tinggi Angkat Maksimum" id="tinggi_angkat_maksimum" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_angkat_maksimum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_angkat_maksimum') }}">
                    @error('tinggi_angkat_maksimum')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Kecepatan Hosting --}}
                <div>
                    <input type="number" step="any" name="kecepatan_hosting" placeholder="Kecepatan Hosting" id="kecepatan_hosting" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_hosting') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_hosting') }}">
                    @error('kecepatan_hosting')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Kecepatan Treversing --}}
                <div>
                    <input type="number" step="any" name="kecepatan_treversing" placeholder="Kecepatan Treversing" id="kecepatan_treversing" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_treversing') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_treversing') }}">
                    @error('kecepatan_treversing')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Kecepatan Travelling --}}
                <div>
                    <input type="number" step="any" name="kecepatan_travelling" placeholder="Kecepatan Travelling" id="kecepatan_travelling" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_travelling') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_travelling') }}">
                    @error('kecepatan_travelling')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang Span --}}
                <div>
                    <input type="number" step="any" name="panjang_span" placeholder="Panjang Span" id="panjang_span" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_span') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('panjang_span') }}">
                    @error('panjang_span')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- foto_rantai --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
                    <label for="foto_rantai" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_rantai-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_rantai[]" id="foto_rantai" accept="image/*" multiple onchange="previewImage(this, 'foto_rantai-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_rantai') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_rantai')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Left: Image --}}
                    <div class="flex flex-col items-start justify-start">
                        <div class="flex justify-start w-full">
                            <img src="{{ asset('assets/image/papa/chain.png') }}"
                                alt="Kecepatan Image"
                                class="object-contain h-full rounded-md shadow-md">
                        </div>

                        <label class="block mt-2 text-sm font-medium text-gray-700">
                            Panjang 1 Meter Rantai
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        <div>
                            <input type="number" step="any" name="panjang_rantai1" placeholder="Panjang 1" id="panjang_rantai1"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai1') }}">
                            @error('panjang_rantai1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_rantai2" placeholder="Panjang 2" id="panjang_rantai2"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai2') }}">
                            @error('panjang_rantai2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_rantai3" placeholder="Panjang 3" id="panjang_rantai3"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai3') }}">
                            @error('panjang_rantai3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_rantai4" placeholder="Panjang 4" id="panjang_rantai4"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai4') }}">
                            @error('panjang_rantai4') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_rantai5" placeholder="Panjang 5" id="panjang_rantai5"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai5') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai5') }}">
                            @error('panjang_rantai5') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_rantai6" placeholder="Panjang 6" id="panjang_rantai6"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai6') }}">
                            @error('panjang_rantai6') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                {{-- foto_wire_rope --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Wire Rope/Tali Kawat Baja/Sling</h2>
                    <label for="foto_wire_rope" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_wire_rope-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_wire_rope[]" id="foto_wire_rope" accept="image/*" multiple onchange="previewImage(this, 'foto_wire_rope-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_wire_rope') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_wire_rope')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Left: Image --}}
                    <div class="flex flex-col items-start justify-start">
                        <div class="flex justify-start w-full">
                            <img src="{{ asset('assets/image/papa/wire.png') }}"
                                alt="Kecepatan Image"
                                class="object-contain h-full rounded-md shadow-md">
                        </div>

                        <label class="block mt-2 text-sm font-medium text-gray-700">
                            Panjang Wire Rope
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        <div>
                            <input type="number" step="any" name="panjang_wire_rope1" placeholder="W1" id="panjang_wire_rope1"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope1') }}">
                            @error('panjang_wire_rope1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_wire_rope2" placeholder="W2" id="panjang_wire_rope2"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope2') }}">
                            @error('panjang_wire_rope2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_wire_rope3" placeholder="W3" id="panjang_wire_rope3"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope3') }}">
                            @error('panjang_wire_rope3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_wire_rope4" placeholder="W4" id="panjang_wire_rope4"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope4') }}">
                            @error('panjang_wire_rope4') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_wire_rope5" placeholder="W5" id="panjang_wire_rope5"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope5') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope5') }}">
                            @error('panjang_wire_rope5') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_wire_rope6" placeholder="W6" id="panjang_wire_rope6"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope6') }}">
                            @error('panjang_wire_rope6') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                {{-- foto_hook --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Hook/Kait</h2>
                    <label for="foto_hook" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_hook-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_hook[]" id="foto_hook" accept="image/*" multiple onchange="previewImage(this, 'foto_hook-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_hook') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_hook')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Left: Image --}}
                    <div class="flex flex-col items-start justify-start">
                        <div class="flex justify-start w-full">
                            <img src="{{ asset('assets/image/papa/hook.png') }}"
                                alt="Kecepatan Image"
                                class="object-contain h-full rounded-md shadow-md">
                        </div>

                        <label class="block mt-2 text-sm font-medium text-gray-700">
                            Panjang Tali Kait
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        <div>
                            <input type="number" step="any" name="panjang_hookA" placeholder="Panjang Hook A" id="panjang_hookA"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookA') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookA') }}">
                            @error('panjang_hookA') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookAi" placeholder="Panjang Hook Ai" id="panjang_hookAi"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookAi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookAi') }}">
                            @error('panjang_hookAi') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookHa" placeholder="Panjang Hook Ha" id="panjang_hookHa"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookHa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookHa') }}">
                            @error('panjang_hookHa') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookB" placeholder="Panjang Hook B" id="panjang_hookB"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookB') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookB') }}">
                            @error('panjang_hookB') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookBi" placeholder="Panjang Hook Bi" id="panjang_hookBi"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookBi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookBi') }}">
                            @error('panjang_hookBi') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookHb" placeholder="Panjang Hook Hb" id="panjang_hookHb"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookHb') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookHb') }}">
                            @error('panjang_hookHb') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookW_C" placeholder="Panjang Hook W/C" id="panjang_hookW_C"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookW_C') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookW_C') }}">
                            @error('panjang_hookW_C') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_hookD" placeholder="Panjang Hook D" id="panjang_hookD"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hookD') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hookD') }}">
                            @error('panjang_hookD') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- foto_pulley --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pulley</h2>
                    <label for="foto_pulley" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pulley-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pulley[]" id="foto_pulley" accept="image/*" multiple onchange="previewImage(this, 'foto_pulley-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pulley') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pulley')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Left: Image --}}
                    <div class="flex flex-col items-start justify-start">
                        <div class="flex justify-start w-full">
                            <img src="{{ asset('assets/image/papa/pulley.png') }}"
                                alt="Kecepatan Image"
                                class="object-contain h-full rounded-md shadow-md">
                        </div>

                        <label class="block mt-2 text-sm font-medium text-gray-700">
                            Panjang Pulley
                        </label>
                    </div>

                    {{-- Right: Input --}}
                    <div class="space-y-4">
                        <div>
                            <input type="number" step="any" name="panjang_pulleyA" placeholder="A" id="panjang_pulleyA"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulleyA') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulleyA') }}">
                            @error('panjang_pulleyA') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_pulleyB" placeholder="B" id="panjang_pulleyB"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulleyB') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulleyB') }}">
                            @error('panjang_pulleyB') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_pulleyC" placeholder="C" id="panjang_pulleyC"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulleyC') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulleyC') }}">
                            @error('panjang_pulleyC') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_pulleyD" placeholder="D" id="panjang_pulleyD"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulleyD') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulleyD') }}">
                            @error('panjang_pulleyD') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="panjang_pulleyE" placeholder="E" id="panjang_pulleyE"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulleyE') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulleyE') }}">
                            @error('panjang_pulleyE') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>
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
                    <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Swl Tinggi Angkat Hook</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Beban Uji Load Chard</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Travelling</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Traversing</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil</label>
                        </div>
                        
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <input type="number" step="any" name="swl_tinggi_angkat_hook1" id="swl_tinggi_angkat_hook1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat_hook1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat_hook1') }}">
                            @error('swl_tinggi_angkat_hook1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="beban_uji_load_chard1" id="beban_uji_load_chard1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard1') }}">
                            @error('beban_uji_load_chard1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="travelling1" id="travelling1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling1') }}">
                            @error('travelling1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="number" step="any" name="traversing1" id="traversing1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('traversing1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('traversing1') }}">
                            @error('traversing1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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
                            <input type="number" step="any" name="swl_tinggi_angkat_hook2" id="swl_tinggi_angkat_hook2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat_hook2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat_hook2') }}">
                            @error('swl_tinggi_angkat_hook2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="beban_uji_load_chard2" id="beban_uji_load_chard2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard2') }}">
                            @error('beban_uji_load_chard2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="travelling2" id="travelling2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling2') }}">
                            @error('travelling2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="traversing2" id="traversing2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('traversing2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('traversing2') }}">
                            @error('traversing2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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
                            <input type="number" step="any" name="swl_tinggi_angkat_hook3" id="swl_tinggi_angkat_hook3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('swl_tinggi_angkat_hook3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('swl_tinggi_angkat_hook3') }}">
                            @error('swl_tinggi_angkat_hook3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="beban_uji_load_chard3" id="beban_uji_load_chard3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('beban_uji_load_chard3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('beban_uji_load_chard3') }}">
                            @error('beban_uji_load_chard3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="travelling3" id="travelling3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('travelling3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('travelling3') }}">
                            @error('travelling3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" step="any" name="traversing3" id="traversing3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('traversing3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('traversing3') }}">
                            @error('traversing3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
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

                {{-- foto_defleksi --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Defleksi</h2>
                    <label for="foto_defleksi" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_defleksi-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_defleksi[]" id="foto_defleksi" accept="image/*" multiple onchange="previewImage(this, 'foto_defleksi-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_defleksi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_defleksi')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Defleksi --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Posisi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Dengan Beban</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tanpa Beban</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                            <!-- Option 1 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi" value="1" class="hidden peer"
                                    {{ old('posisi_defleksi') == 1 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    1
                                </div>
                            </label>

                            <!-- Option 2 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi" value="2" class="hidden peer"
                                    {{ old('posisi_defleksi') == 2 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    2
                                </div>
                            </label>

                            <!-- Option 3 -->
                            <label class="flex-1">
                                <input type="radio" name="posisi_defleksi" value="3" class="hidden peer"
                                    {{ old('posisi_defleksi') == 3 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    3
                                </div>
                            </label>
                        </div>

                        @error('posisi_defleksi')
                            <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="single_girder_beban" class="block text-sm text-gray-700">Single Girder</label>
                        <input type="number" step="any" name="single_girder_beban" placeholder="" id="single_girder_beban" class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('single_girder_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('single_girder_beban') }}">
                        @error('single_girder_beban')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        {{-- <label for="pressure_switch_on_set" class="block text-sm text-gray-700"></label> --}}
                        <input type="number" step="any" name="single_girder_tanpa_beban" placeholder="" id="single_girder_tanpa_beban" class="block w-full shadow-md px-3 py-2 mt-6 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('single_girder_tanpa_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('single_girder_tanpa_beban') }}">
                        @error('single_girder_tanpa_beban')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div class="inline-block">

                        <!-- Row 1 -->
                        <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                            <!-- 1 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi_dua" value="1" class="hidden peer"
                                    {{ old('posisi_defleksi_dua') == 1 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    1
                                </div>
                            </label>

                            <!-- 2 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi_dua" value="2" class="hidden peer"
                                    {{ old('posisi_defleksi_dua') == 2 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    2
                                </div>
                            </label>

                            <!-- 3 -->
                            <label class="flex-1">
                                <input type="radio" name="posisi_defleksi_dua" value="3" class="hidden peer"
                                    {{ old('posisi_defleksi_dua') == 3 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    3
                                </div>
                            </label>
                        </div>

                        <!-- Row 2 (rapat dengan baris 1) -->
                        <div class="flex overflow-hidden border border-gray-400 rounded-md">
                            
                            <!-- 6 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi_dua" value="6" class="hidden peer"
                                {{ old('posisi_defleksi_dua') == 6 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    6
                                </div>
                            </label>
                            
                            <!-- 5 -->
                            <label class="flex-1 border-r border-gray-400">
                                <input type="radio" name="posisi_defleksi_dua" value="5" class="hidden peer"
                                {{ old('posisi_defleksi_dua') == 5 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    5
                                </div>
                            </label>
                            
                            <!-- 4 -->
                            <label class="flex-1">
                                <input type="radio" name="posisi_defleksi_dua" value="4" class="hidden peer"
                                    {{ old('posisi_defleksi_dua') == 4 ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    4
                                </div>
                            </label>
                        </div>

                        @error('posisi_defleksi_dua')
                            <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="pressure_switch_on_set" class="block text-sm text-gray-700">Double Girder</label>
                        <input type="number" step="any" name="double_girder_beban" placeholder="" id="double_girder_beban" class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('double_girder_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('double_girder_beban') }}">
                        @error('double_girder_beban')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="number" step="any" name="double_girder_beban_dua" placeholder="" id="double_girder_beban_dua" class="block w-full shadow-md px-3 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('double_girder_beban_dua') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('double_girder_beban_dua') }}">
                        @error('double_girder_beban_dua')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="number" step="any" name="double_girder_tanpa_beban" placeholder="" id="double_girder_tanpa_beban" class="block w-full shadow-md px-3 py-2 mt-6 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('double_girder_tanpa_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('double_girder_tanpa_beban') }}">
                        @error('double_girder_tanpa_beban')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="number" step="any" name="double_girder_tanpa_beban_dua" placeholder="" id="double_girder_tanpa_beban_dua" class="block w-full shadow-md px-3 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('double_girder_tanpa_beban_dua') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('double_girder_tanpa_beban_dua') }}">
                        @error('double_girder_tanpa_beban_dua')
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



