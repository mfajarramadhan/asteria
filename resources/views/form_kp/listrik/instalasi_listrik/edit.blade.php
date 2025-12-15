<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.listrik.instalasi_listrik.update', $formKpInstalasiListrik->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <div>
                <label for="tanggal_pemeriksaan" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                <div class="flex flex-wrap justify-between w-full gap-y-4">
                    <div class="w-full md:w-[48%]">
                        <div class="relative">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan"
                                value="{{ old('tanggal_pemeriksaan', optional($formKpInstalasiListrik->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
            </div>

            {{-- foto_informasi_umum --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
                <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpInstalasiListrik->foto_informasi_umum)
                @php $oldFiles = json_decode($formKpInstalasiListrik->foto_informasi_umum, true); @endphp
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

                {{-- preview baru --}}
                <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_informasi_umum[]"
                    id="foto_informasi_umum"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_informasi_umum-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_informasi_umum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_informasi_umum')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiListrik->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiListrik->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiListrik->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiListrik->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat', $formKpInstalasiListrik->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis--}}
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" name="jenis" placeholder="Jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis', $formKpInstalasiListrik->jenis) }}">
                @error('jenis')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi--}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpInstalasiListrik->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan--}}
            <div>
                <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan', $formKpInstalasiListrik->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Daya Terpasang --}}
            <div>
                <label for="daya_terpasang" class="block text-sm font-medium text-gray-700">Daya Terpasang</label>
                <input type="number" step="any" name="daya_terpasang" placeholder="Daya Terpasang" id="daya_terpasang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('daya_terpasang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('daya_terpasang', $formKpInstalasiListrik->daya_terpasang) }}">
                @error('daya_terpasang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Untuk Tenaga --}}
            <div>
                <label for="untuk_tenaga" class="block text-sm font-medium text-gray-700">Untuk Tenaga</label>
                <input type="text" name="untuk_tenaga" placeholder="Untuk Tenaga" id="untuk_tenaga" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('untuk_tenaga') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('untuk_tenaga', $formKpInstalasiListrik->untuk_tenaga) }}">
                @error('untuk_tenaga')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Untuk Instalaltir --}}
            <div>
                <label for="untuk_instalaltir" class="block text-sm font-medium text-gray-700">Untuk Instalaltir</label>
                <input type="text" name="untuk_instalaltir" placeholder="Untuk Instalaltir" id="untuk_instalaltir" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('untuk_instalaltir') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('untuk_instalaltir', $formKpInstalasiListrik->untuk_instalaltir) }}">
                @error('untuk_instalaltir')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Ampere MCB --}}
            <div>
                <label for="ampere_mcb" class="block text-sm font-medium text-gray-700">Ampere MCB</label>
                <input type="number" step="any" name="ampere_mcb" placeholder="Ampere MCB" id="ampere_mcb" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ampere_mcb') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ampere_mcb', $formKpInstalasiListrik->ampere_mcb) }}">
                @error('ampere_mcb')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Sumber Daya Listrik --}}
            <div>
                <label for="sumber_daya_listrik" class="block text-sm font-medium text-gray-700">Sumber Daya Listrik</label>
                <input type="text" name="sumber_daya_listrik" placeholder="Sumber Daya Listrik" id="sumber_daya_listrik" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('sumber_daya_listrik') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('sumber_daya_listrik', $formKpInstalasiListrik->sumber_daya_listrik) }}">
                @error('sumber_daya_listrik')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pemasangan --}}
            <div>
                <label for="tahun_pemasangan" class="block text-sm font-medium text-gray-700">Tahun Pemasangan</label>
                <input type="text" name="tahun_pemasangan" placeholder="Tahun Pemasangan" id="tahun_pemasangan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pemasangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pemasangan', $formKpInstalasiListrik->tahun_pemasangan) }}">
                @error('tahun_pemasangan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Pondasi --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Pondasi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris 2 - Konstruksi --}}
                    <div>
                        <label for="konstruksi_hasil" class="block text-sm text-gray-700">Konstruksi</label>
                    </div>
                    
                    <div>
                        <select name="konstruksi_hasil" id="konstruksi_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('konstruksi_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('konstruksi_hasil', $formKpInstalasiListrik->konstruksi_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('konstruksi_hasil', $formKpInstalasiListrik->konstruksi_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('konstruksi_hasil', $formKpInstalasiListrik->konstruksi_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                        @error('konstruksi_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="konstruksi_keterangan" placeholder="Keterangan" id="konstruksi_keterangan"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('konstruksi_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('konstruksi_keterangan', $formKpInstalasiListrik->konstruksi_keterangan) }}">
                        @error('konstruksi_keterangan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="konstruksi_foto[]" 
                            id="konstruksi_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            // Decode JSON ke array
                            $name = 'konstruksi_foto';
                            $foto = json_decode($formKpInstalasiListrik->konstruksi_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                    type="button" 
                                    onclick="openModal('{{ $name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Konstruksi</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris 3 - Baut Pengikat --}}
                    <div>
                        <label for="baut_pengikat_hasil" class="block text-sm text-gray-700">Baut Pengikat</label>
                    </div>
                    
                    <div>
                        <select name="baut_pengikat_hasil" id="baut_pengikat_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('baut_pengikat_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('baut_pengikat_hasil', $formKpInstalasiListrik->baut_pengikat_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('baut_pengikat_hasil', $formKpInstalasiListrik->baut_pengikat_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('baut_pengikat_hasil', $formKpInstalasiListrik->baut_pengikat_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                        @error('baut_pengikat_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="text" name="baut_pengikat_keterangan" placeholder="Keterangan" id="baut_pengikat_keterangan"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('baut_pengikat_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('baut_pengikat_keterangan', $formKpInstalasiListrik->baut_pengikat_keterangan) }}">
                        @error('baut_pengikat_keterangan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="baut_pengikat_foto[]" 
                            id="baut_pengikat_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            // Decode JSON ke array supaya foreach tidak error
                            $name = 'baut_pengikat_foto';
                            $foto = json_decode($formKpInstalasiListrik->baut_pengikat_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                    type="button" 
                                    onclick="openModal('{{ $name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Baut Pengikat</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>


            {{-- Pembumian --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Pembumian</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris 2 - Kabel --}}
                    <div>
                        <label for="kabel_hasil" class="block text-sm text-gray-700">Kabel</label>
                    </div>

                    <div>
                        <select name="kabel_hasil" id="kabel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('kabel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kabel_hasil', $formKpInstalasiListrik->kabel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Ada" {{ old('kabel_hasil', $formKpInstalasiListrik->kabel_hasil) == 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak Ada" {{ old('kabel_hasil', $formKpInstalasiListrik->kabel_hasil) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                        @error('kabel_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="kabel_keterangan" placeholder="Keterangan" id="kabel_keterangan"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('kabel_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('kabel_keterangan', $formKpInstalasiListrik->kabel_keterangan) }}">
                        @error('kabel_keterangan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kabel_foto[]" 
                            id="kabel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kabel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kabel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                    type="button" 
                                    onclick="openModal('{{ $name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kabel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                
                    {{-- Baris 2 - Plat Tembaga --}}
                    <div>
                        <label for="plat_tembaga_hasil" class="block text-sm text-gray-700">Plat Tembaga</label>
                    </div>

                    <div>
                        <select name="plat_tembaga_hasil" id="plat_tembaga_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('plat_tembaga_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('plat_tembaga_hasil', $formKpInstalasiListrik->plat_tembaga_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Ada" {{ old('plat_tembaga_hasil', $formKpInstalasiListrik->plat_tembaga_hasil) == 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak Ada" {{ old('plat_tembaga_hasil', $formKpInstalasiListrik->plat_tembaga_hasil) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                        @error('plat_tembaga_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="plat_tembaga_keterangan" placeholder="Keterangan" id="plat_tembaga_keterangan"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('plat_tembaga_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('plat_tembaga_keterangan', $formKpInstalasiListrik->plat_tembaga_keterangan) }}">
                        @error('plat_tembaga_keterangan')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="plat_tembaga_foto[]" 
                            id="plat_tembaga_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'plat_tembaga_foto';
                            $foto = json_decode($formKpInstalasiListrik->plat_tembaga_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                    type="button" 
                                    onclick="openModal('{{ $name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Plat Tembaga</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris 3 - Baut Pengikat --}}
                    <div>
                        <label for="baut_pengikat_hasil2" class="block text-sm text-gray-700">Baut Pengikat</label>
                    </div>

                    <div>
                        <select name="baut_pengikat_hasil2" id="baut_pengikat_hasil2"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('baut_pengikat_hasil2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                            <option value="-" {{ old('baut_pengikat_hasil2', $formKpInstalasiListrik->baut_pengikat_hasil2) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('baut_pengikat_hasil2', $formKpInstalasiListrik->baut_pengikat_hasil2) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('baut_pengikat_hasil2', $formKpInstalasiListrik->baut_pengikat_hasil2) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>

                        </select>

                        @error('baut_pengikat_hasil2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="baut_pengikat_keterangan2" placeholder="Keterangan" id="baut_pengikat_keterangan2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('baut_pengikat_keterangan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('baut_pengikat_keterangan2', $formKpInstalasiListrik->baut_pengikat_keterangan2) }}">

                        @error('baut_pengikat_keterangan2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="baut_pengikat_foto2[]" 
                            id="baut_pengikat_foto2" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'baut_pengikat_foto2';
                            $foto = json_decode($formKpInstalasiListrik->baut_pengikat_foto2, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                    type="button" 
                                    onclick="openModal('{{ $name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Baut Pengikat 2</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Tempat/Ruang Transformator (Trafo) --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tempat/Ruang Transformator (Trafo)</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris 2 - Pembatas --}}
                    <div>
                        <label for="pembatas_hasil" class="block text-sm text-gray-700">Pembatas</label>
                    </div>

                    <div>
                        <select name="pembatas_hasil" id="pembatas_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pembatas_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('pembatas_hasil', $formKpInstalasiListrik->pembatas_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('pembatas_hasil', $formKpInstalasiListrik->pembatas_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('pembatas_hasil', $formKpInstalasiListrik->pembatas_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="pembatas_keterangan" placeholder="Keterangan"
                            value="{{ old('pembatas_keterangan', $formKpInstalasiListrik->pembatas_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="pembatas_foto[]" 
                            id="pembatas_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'pembatas_foto';
                            $foto = json_decode($formKpInstalasiListrik->pembatas_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Pembatas</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
       
                    
                    {{-- Baris - Tanda Peringatan --}}
                    <div>
                        <label for="tanda_peringatan_hasil" class="block text-sm text-gray-700">Tanda Peringatan</label>
                    </div>

                    <div>
                        <select name="tanda_peringatan_hasil" id="tanda_peringatan_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('tanda_peringatan_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('tanda_peringatan_hasil', $formKpInstalasiListrik->tanda_peringatan_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('tanda_peringatan_hasil', $formKpInstalasiListrik->tanda_peringatan_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('tanda_peringatan_hasil', $formKpInstalasiListrik->tanda_peringatan_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="tanda_peringatan_keterangan" placeholder="Keterangan"
                            value="{{ old('tanda_peringatan_keterangan', $formKpInstalasiListrik->tanda_peringatan_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="tanda_peringatan_foto[]" 
                            id="tanda_peringatan_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'tanda_peringatan_foto';
                            $foto = json_decode($formKpInstalasiListrik->tanda_peringatan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Tanda Peringatan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - APAR --}}
                    <div>
                        <label for="apar_hasil" class="block text-sm text-gray-700">APAR</label>
                    </div>

                    <div>
                        <select name="apar_hasil" id="apar_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('apar_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('apar_hasil', $formKpInstalasiListrik->apar_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('apar_hasil', $formKpInstalasiListrik->apar_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('apar_hasil', $formKpInstalasiListrik->apar_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="apar_keterangan" placeholder="Keterangan"
                            value="{{ old('apar_keterangan', $formKpInstalasiListrik->apar_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="apar_foto[]" 
                            id="apar_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'apar_foto';
                            $foto = json_decode($formKpInstalasiListrik->apar_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto APAR</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Oil Gauge --}}
                    <div>
                        <label for="oil_gauge_hasil" class="block text-sm text-gray-700">Oil Gauge</label>
                    </div>

                    <div>
                        <select name="oil_gauge_hasil" id="oil_gauge_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('oil_gauge_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('oil_gauge_hasil', $formKpInstalasiListrik->oil_gauge_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('oil_gauge_hasil', $formKpInstalasiListrik->oil_gauge_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('oil_gauge_hasil', $formKpInstalasiListrik->oil_gauge_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="oil_gauge_keterangan" placeholder="Keterangan"
                            value="{{ old('oil_gauge_keterangan', $formKpInstalasiListrik->oil_gauge_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="oil_gauge_foto[]" 
                            id="oil_gauge_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'oil_gauge_foto';
                            $foto = json_decode($formKpInstalasiListrik->oil_gauge_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Oil Gauge</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Thermal Gauge --}}
                    <div>
                        <label for="thermal_gauge_hasil" class="block text-sm text-gray-700">Thermal Gauge</label>
                    </div>

                    <div>
                        <select name="thermal_gauge_hasil" id="thermal_gauge_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('thermal_gauge_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('thermal_gauge_hasil', $formKpInstalasiListrik->thermal_gauge_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('thermal_gauge_hasil', $formKpInstalasiListrik->thermal_gauge_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('thermal_gauge_hasil', $formKpInstalasiListrik->thermal_gauge_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="thermal_gauge_keterangan" placeholder="Keterangan"
                            value="{{ old('thermal_gauge_keterangan', $formKpInstalasiListrik->thermal_gauge_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="thermal_gauge_foto[]" 
                            id="thermal_gauge_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'thermal_gauge_foto';
                            $foto = json_decode($formKpInstalasiListrik->thermal_gauge_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Thermal Gauge</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Panel: Tampak Depan --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Panel: Tampak Depan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Lampu Indikator --}}
                    <div>
                        <label for="lampu_indikator_hasil" class="block text-sm text-gray-700">Lampu Indikator</label>
                    </div>

                    <div>
                        <select name="lampu_indikator_hasil" id="lampu_indikator_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('lampu_indikator_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('lampu_indikator_hasil', $formKpInstalasiListrik->lampu_indikator_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('lampu_indikator_hasil', $formKpInstalasiListrik->lampu_indikator_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('lampu_indikator_hasil', $formKpInstalasiListrik->lampu_indikator_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="lampu_indikator_keterangan" placeholder="Keterangan"
                            value="{{ old('lampu_indikator_keterangan', $formKpInstalasiListrik->lampu_indikator_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="lampu_indikator_foto[]" 
                            id="lampu_indikator_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'lampu_indikator_foto';
                            $foto = json_decode($formKpInstalasiListrik->lampu_indikator_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Lampu Indikator</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Alat Ukur --}}
                    <div>
                        <label for="alat_ukur_hasil" class="block text-sm text-gray-700">Alat Ukur</label>
                    </div>

                    <div>
                        <select name="alat_ukur_hasil" id="alat_ukur_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('alat_ukur_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('alat_ukur_hasil', $formKpInstalasiListrik->alat_ukur_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('alat_ukur_hasil', $formKpInstalasiListrik->alat_ukur_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('alat_ukur_hasil', $formKpInstalasiListrik->alat_ukur_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="alat_ukur_keterangan" placeholder="Keterangan"
                            value="{{ old('alat_ukur_keterangan', $formKpInstalasiListrik->alat_ukur_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="alat_ukur_foto[]" 
                            id="alat_ukur_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'alat_ukur_foto';
                            $foto = json_decode($formKpInstalasiListrik->alat_ukur_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Alat Ukur</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Tanda Pintu Panel --}}
                    <div>
                        <label for="tanda_pintu_panel_hasil" class="block text-sm text-gray-700">Tanda Pintu Panel</label>
                    </div>

                    <div>
                        <select name="tanda_pintu_panel_hasil" id="tanda_pintu_panel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('tanda_pintu_panel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('tanda_pintu_panel_hasil', $formKpInstalasiListrik->tanda_pintu_panel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('tanda_pintu_panel_hasil', $formKpInstalasiListrik->tanda_pintu_panel_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('tanda_pintu_panel_hasil', $formKpInstalasiListrik->tanda_pintu_panel_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="tanda_pintu_panel_keterangan" placeholder="Keterangan"
                            value="{{ old('tanda_pintu_panel_keterangan', $formKpInstalasiListrik->tanda_pintu_panel_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="tanda_pintu_panel_foto[]" 
                            id="tanda_pintu_panel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'tanda_pintu_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->tanda_pintu_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Tanda Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kunci Pintu Panel --}}
                    <div>
                        <label for="kunci_pintu_panel_hasil" class="block text-sm text-gray-700">Kunci Pintu Panel</label>
                    </div>

                    <div>
                        <select name="kunci_pintu_panel_hasil" id="kunci_pintu_panel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('kunci_pintu_panel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kunci_pintu_panel_hasil', $formKpInstalasiListrik->kunci_pintu_panel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('kunci_pintu_panel_hasil', $formKpInstalasiListrik->kunci_pintu_panel_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('kunci_pintu_panel_hasil', $formKpInstalasiListrik->kunci_pintu_panel_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="kunci_pintu_panel_keterangan" placeholder="Keterangan"
                            value="{{ old('kunci_pintu_panel_keterangan', $formKpInstalasiListrik->kunci_pintu_panel_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kunci_pintu_panel_foto[]" 
                            id="kunci_pintu_panel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kunci_pintu_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kunci_pintu_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kunci Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif


                </div>
            </div>

            {{-- Panel: Tampak Dalam --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Panel: Tampak Dalam</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Cover Pelindung --}}
                    <div>
                        <label for="cover_pelindung_hasil" class="block text-sm text-gray-700">Cover pelindung tegangan sentuh langung</label>
                    </div>

                    <div>
                        <select name="cover_pelindung_hasil" id="cover_pelindung_hasil"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="-" {{ old('cover_pelindung_hasil', $formKpInstalasiListrik->cover_pelindung_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('cover_pelindung_hasil', $formKpInstalasiListrik->cover_pelindung_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('cover_pelindung_hasil', $formKpInstalasiListrik->cover_pelindung_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="cover_pelindung_keterangan" placeholder="Keterangan"
                            value="{{ old('cover_pelindung_keterangan', $formKpInstalasiListrik->cover_pelindung_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        <input type="file"
                            name="cover_pelindung_foto[]"
                            id="cover_pelindung_foto"
                            accept="image/*"
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        @php
                            $name = 'cover_pelindung_foto';
                            $foto = json_decode($formKpInstalasiListrik->cover_pelindung_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Cover Pelindung</h2>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>
                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">Tutup</button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Gambar Single Line --}}
                    <div>
                        <label for="gambar_single_line_hasil" class="block text-sm text-gray-700">Gambar single line diagram dan kartu riwayat perawatan</label>
                    </div>

                    <div>
                        <select name="gambar_single_line_hasil" id="gambar_single_line_hasil"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="-" {{ old('gambar_single_line_hasil', $formKpInstalasiListrik->gambar_single_line_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('gambar_single_line_hasil', $formKpInstalasiListrik->gambar_single_line_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('gambar_single_line_hasil', $formKpInstalasiListrik->gambar_single_line_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="gambar_single_line_keterangan" placeholder="Keterangan"
                            value="{{ old('gambar_single_line_keterangan', $formKpInstalasiListrik->gambar_single_line_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        <input type="file"
                            name="gambar_single_line_foto[]"
                            id="gambar_single_line_foto"
                            accept="image/*"
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        @php
                            $name = 'gambar_single_line_foto';
                            $foto = json_decode($formKpInstalasiListrik->gambar_single_line_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Gambar Single Line</h2>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>
                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">Tutup</button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kabel Bonding --}}
                    <div>
                        <label for="kabel_bonding_hasil" class="block text-sm text-gray-700">Kabel bonding pengaman sentuh tidak langsung</label>
                    </div>

                    <div>
                        <select name="kabel_bonding_hasil" id="kabel_bonding_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('kabel_bonding_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kabel_bonding_hasil', $formKpInstalasiListrik->kabel_bonding_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('kabel_bonding_hasil', $formKpInstalasiListrik->kabel_bonding_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('kabel_bonding_hasil', $formKpInstalasiListrik->kabel_bonding_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="kabel_bonding_keterangan" placeholder="Keterangan"
                            value="{{ old('kabel_bonding_keterangan', $formKpInstalasiListrik->kabel_bonding_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kabel_bonding_foto[]" 
                            id="kabel_bonding_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kabel_bonding_foto';
                            $foto = json_decode($formKpInstalasiListrik->kabel_bonding_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kabel Bonding</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Label --}}
                    <div>
                        <label for="label_hasil" class="block text-sm text-gray-700">Labeling</label>
                    </div>

                    <div>
                        <select name="label_hasil" id="label_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('label_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('label_hasil', $formKpInstalasiListrik->label_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('label_hasil', $formKpInstalasiListrik->label_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('label_hasil', $formKpInstalasiListrik->label_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="label_keterangan" placeholder="Keterangan"
                            value="{{ old('label_keterangan', $formKpInstalasiListrik->label_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="label_foto[]" 
                            id="label_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'label_foto';
                            $foto = json_decode($formKpInstalasiListrik->label_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Label</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kode Warna Kabel --}}
                    <div>
                        <label for="kode_warna_kabel_hasil" class="block text-sm text-gray-700">Kode Warna Kabel</label>
                    </div>

                    <div>
                        <select name="kode_warna_kabel_hasil" id="kode_warna_kabel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('kode_warna_kabel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kode_warna_kabel_hasil', $formKpInstalasiListrik->kode_warna_kabel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('kode_warna_kabel_hasil', $formKpInstalasiListrik->kode_warna_kabel_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('kode_warna_kabel_hasil', $formKpInstalasiListrik->kode_warna_kabel_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="kode_warna_kabel_keterangan" placeholder="Keterangan"
                            value="{{ old('kode_warna_kabel_keterangan', $formKpInstalasiListrik->kode_warna_kabel_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kode_warna_kabel_foto[]" 
                            id="kode_warna_kabel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kode_warna_kabel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kode_warna_kabel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kode Warna Kabel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kebersihan Panel --}}
                    <div>
                        <label for="kebersihan_panel_hasil" class="block text-sm text-gray-700">Kebersihan Panel</label>
                    </div>

                    <div>
                        <select name="kebersihan_panel_hasil" id="kebersihan_panel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('kebersihan_panel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kebersihan_panel_hasil', $formKpInstalasiListrik->kebersihan_panel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('kebersihan_panel_hasil', $formKpInstalasiListrik->kebersihan_panel_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('kebersihan_panel_hasil', $formKpInstalasiListrik->kebersihan_panel_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="kebersihan_panel_keterangan" placeholder="Keterangan"
                            value="{{ old('kebersihan_panel_keterangan', $formKpInstalasiListrik->kebersihan_panel_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kebersihan_panel_foto[]" 
                            id="kebersihan_panel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kebersihan_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kebersihan_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kebersihan Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kerapian Instalasi --}}
                    <div>
                        <label for="kerapian_instalasi_hasil" class="block text-sm text-gray-700">Kerapian Instalasi</label>
                    </div>

                    <div>
                        <select name="kerapian_instalasi_hasil" id="kerapian_instalasi_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('kerapian_instalasi_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('kerapian_instalasi_hasil', $formKpInstalasiListrik->kerapian_instalasi_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('kerapian_instalasi_hasil', $formKpInstalasiListrik->kerapian_instalasi_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('kerapian_instalasi_hasil', $formKpInstalasiListrik->kerapian_instalasi_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="kerapian_instalasi_keterangan" placeholder="Keterangan"
                            value="{{ old('kerapian_instalasi_keterangan', $formKpInstalasiListrik->kerapian_instalasi_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="kerapian_instalasi_foto[]" 
                            id="kerapian_instalasi_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'kerapian_instalasi_foto';
                            $foto = json_decode($formKpInstalasiListrik->kerapian_instalasi_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Kerapian Instalasi</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Daerah Kerja --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Daerah Kerja</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Jarak Bagian Depan --}}
                    <div>
                        <label for="jarak_depan_hasil" class="block text-sm text-gray-700">Jarak Bagian Depan</label>
                    </div>

                    <div>
                        <select name="jarak_depan_hasil" id="jarak_depan_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('jarak_depan_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('jarak_depan_hasil', $formKpInstalasiListrik->jarak_depan_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('jarak_depan_hasil', $formKpInstalasiListrik->jarak_depan_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('jarak_depan_hasil', $formKpInstalasiListrik->jarak_depan_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="jarak_depan_keterangan" placeholder="Keterangan"
                            value="{{ old('jarak_depan_keterangan', $formKpInstalasiListrik->jarak_depan_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="jarak_depan_foto[]" 
                            id="jarak_depan_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'jarak_depan_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_depan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Depan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Jarak Bagian Samping --}}
                    <div>
                        <label for="jarak_samping_hasil" class="block text-sm text-gray-700">Jarak Bagian Samping</label>
                    </div>

                    <div>
                        <select name="jarak_samping_hasil" id="jarak_samping_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('jarak_samping_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('jarak_samping_hasil', $formKpInstalasiListrik->jarak_samping_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('jarak_samping_hasil', $formKpInstalasiListrik->jarak_samping_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('jarak_samping_hasil', $formKpInstalasiListrik->jarak_samping_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="jarak_samping_keterangan" placeholder="Keterangan"
                            value="{{ old('jarak_samping_keterangan', $formKpInstalasiListrik->jarak_samping_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="jarak_samping_foto[]" 
                            id="jarak_samping_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'jarak_samping_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_samping_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Samping</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Jarak Bagian Belakang --}}
                    <div>
                        <label for="jarak_belakang_hasil" class="block text-sm text-gray-700">Jarak Bagian Belakang</label>
                    </div>

                    <div>
                        <select name="jarak_belakang_hasil" id="jarak_belakang_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('jarak_belakang_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('jarak_belakang_hasil', $formKpInstalasiListrik->jarak_belakang_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('jarak_belakang_hasil', $formKpInstalasiListrik->jarak_belakang_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('jarak_belakang_hasil', $formKpInstalasiListrik->jarak_belakang_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="jarak_belakang_keterangan" placeholder="Keterangan"
                            value="{{ old('jarak_belakang_keterangan', $formKpInstalasiListrik->jarak_belakang_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="jarak_belakang_foto[]" 
                            id="jarak_belakang_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'jarak_belakang_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_belakang_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Belakang</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Bebas Buka Pintu Panel --}}
                    <div>
                        <label for="bebas_buka_panel_hasil" class="block text-sm text-gray-700">Bebas Buka Pintu Panel</label>
                    </div>

                    <div>
                        <select name="bebas_buka_panel_hasil" id="bebas_buka_panel_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('bebas_buka_panel_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('bebas_buka_panel_hasil', $formKpInstalasiListrik->bebas_buka_panel_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('bebas_buka_panel_hasil', $formKpInstalasiListrik->bebas_buka_panel_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('bebas_buka_panel_hasil', $formKpInstalasiListrik->bebas_buka_panel_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="bebas_buka_panel_keterangan" placeholder="Keterangan"
                            value="{{ old('bebas_buka_panel_keterangan', $formKpInstalasiListrik->bebas_buka_panel_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="bebas_buka_panel_foto[]" 
                            id="bebas_buka_panel_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'bebas_buka_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->bebas_buka_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Bebas Buka Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Pencahayaan --}}
                    <div>
                        <label for="pencahayaan_hasil" class="block text-sm text-gray-700">Pencahayaan</label>
                    </div>

                    <div>
                        <select name="pencahayaan_hasil" id="pencahayaan_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pencahayaan_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('pencahayaan_hasil', $formKpInstalasiListrik->pencahayaan_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('pencahayaan_hasil', $formKpInstalasiListrik->pencahayaan_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('pencahayaan_hasil', $formKpInstalasiListrik->pencahayaan_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="pencahayaan_keterangan" placeholder="Keterangan"
                            value="{{ old('pencahayaan_keterangan', $formKpInstalasiListrik->pencahayaan_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="pencahayaan_foto[]" 
                            id="pencahayaan_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'pencahayaan_foto';
                            $foto = json_decode($formKpInstalasiListrik->pencahayaan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Pencahayaan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Barang Tidak Terpakai --}}
                    <div>
                        <label for="barang_tidak_pakai_hasil" class="block text-sm text-gray-700">Barang-barang yang tidak terpakai</label>
                    </div>

                    <div>
                        <select name="barang_tidak_pakai_hasil" id="barang_tidak_pakai_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('barang_tidak_pakai_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('barang_tidak_pakai_hasil', $formKpInstalasiListrik->barang_tidak_pakai_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('barang_tidak_pakai_hasil', $formKpInstalasiListrik->barang_tidak_pakai_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('barang_tidak_pakai_hasil', $formKpInstalasiListrik->barang_tidak_pakai_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="barang_tidak_pakai_keterangan" placeholder="Keterangan"
                            value="{{ old('barang_tidak_pakai_keterangan', $formKpInstalasiListrik->barang_tidak_pakai_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="barang_tidak_pakai_foto[]" 
                            id="barang_tidak_pakai_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'barang_tidak_pakai_foto';
                            $foto = json_decode($formKpInstalasiListrik->barang_tidak_pakai_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Barang Tidak Terpakai</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Ventilasi --}}
                    <div>
                        <label for="ventilasi_hasil" class="block text-sm text-gray-700">Ventilasi</label>
                    </div>

                    <div>
                        <select name="ventilasi_hasil" id="ventilasi_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('ventilasi_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('ventilasi_hasil', $formKpInstalasiListrik->ventilasi_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('ventilasi_hasil', $formKpInstalasiListrik->ventilasi_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('ventilasi_hasil', $formKpInstalasiListrik->ventilasi_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="ventilasi_keterangan" placeholder="Keterangan"
                            value="{{ old('ventilasi_keterangan', $formKpInstalasiListrik->ventilasi_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="ventilasi_foto[]" 
                            id="ventilasi_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'ventilasi_foto';
                            $foto = json_decode($formKpInstalasiListrik->ventilasi_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Ventilasi</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Saluran Uap --}}
                    <div>
                        <label for="saluran_uap_hasil" class="block text-sm text-gray-700">
                            Tidak dekat saluran uap, gas, air dan saluran yang tidak ada hubungan dengan PHBK
                        </label>
                    </div>

                    <div>
                        <select name="saluran_uap_hasil" id="saluran_uap_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('saluran_uap_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                            <option value="-" {{ old('saluran_uap_hasil', $formKpInstalasiListrik->saluran_uap_hasil) == '-' ? 'selected' : '' }}>-</option>
                            <option value="Sesuai" {{ old('saluran_uap_hasil', $formKpInstalasiListrik->saluran_uap_hasil) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('saluran_uap_hasil', $formKpInstalasiListrik->saluran_uap_hasil) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="saluran_uap_keterangan" placeholder="Keterangan"
                            value="{{ old('saluran_uap_keterangan', $formKpInstalasiListrik->saluran_uap_keterangan) }}"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md">
                    </div>

                    <div class="flex items-center justify-between w-full gap-3">

                        {{-- Input File --}}
                        <input type="file" 
                            name="saluran_uap_foto[]" 
                            id="saluran_uap_foto" 
                            accept="image/*" 
                            multiple
                            class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max">

                        {{-- Tombol Lihat Foto --}}
                        @php
                            $name = 'saluran_uap_foto';
                            $foto = json_decode($formKpInstalasiListrik->saluran_uap_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all duration-500 rounded-full group item-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Saluran Uap</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            {{-- dimensi_foto --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Dimensi</h2>
                <label for="dimensi_foto" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpInstalasiListrik->dimensi_foto)
                @php $oldFiles = json_decode($formKpInstalasiListrik->dimensi_foto, true); @endphp
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

                {{-- preview baru --}}
                <div id="dimensi_foto-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="dimensi_foto[]"
                    id="dimensi_foto"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'dimensi_foto-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('dimensi_foto') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('dimensi_foto')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Pondasi --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-3 gap-4 pt-6 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Item Test</label>
                        </div>
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran (cm)</label>
                        </div>
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Standar SNI</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <label for="jarak_bagian_depan" class="block text-sm text-gray-700">Jarak bagian depan</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="jarak_bagian_depan" placeholder="Aktual (cm)" id="jarak_bagian_depan" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('jarak_bagian_depan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('jarak_bagian_depan', $formKpInstalasiListrik->jarak_bagian_depan) }}">
                            @error('jarak_bagian_depan')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="jarak_bagian_depan" class="block text-sm text-gray-700">Min 75 cm</label>
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <label for="jarak_bagian_samping" class="block text-sm text-gray-700">Jarak bagian samping</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="jarak_bagian_samping" placeholder="Aktual (cm)" id="jarak_bagian_samping" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('jarak_bagian_samping') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('jarak_bagian_samping', $formKpInstalasiListrik->jarak_bagian_samping) }}">
                            @error('jarak_bagian_samping')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="jarak_bagian_samping" class="block text-sm text-gray-700">Min 150 cm</label>
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <label for="jarak_bagian_belakang_tr" class="block text-sm text-gray-700">Jarak bagian belakang (TR)</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="jarak_bagian_belakang_tr" placeholder="Aktual (cm)" id="jarak_bagian_belakang_tr" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('jarak_bagian_belakang_tr') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('jarak_bagian_belakang_tr', $formKpInstalasiListrik->jarak_bagian_belakang_tr) }}">
                            @error('jarak_bagian_belakang_tr')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="jarak_bagian_belakang_tr" class="block text-sm text-gray-700">TR Min 75 cm</label>
                        </div>

                        {{-- Baris 5 --}}
                        <div>
                            <label for="jarak_bagian_belakang_tm" class="block text-sm text-gray-700">Jarak bagian belakang (TM)</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="jarak_bagian_belakang_tm" placeholder="Aktual (cm)" id="jarak_bagian_belakang_tm" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('jarak_bagian_belakang_tm') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('jarak_bagian_belakang_tm', $formKpInstalasiListrik->jarak_bagian_belakang_tm) }}">
                            @error('jarak_bagian_belakang_tm')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="jarak_bagian_belakang_tm" class="block text-sm text-gray-700">TM Min 100 cm</label>
                        </div>

                        {{-- Baris 6 --}}
                        <div>
                            <label for="jarak_antar_panel" class="block text-sm text-gray-700">Jarak antar panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="jarak_antar_panel" placeholder="Aktual (cm)" id="jarak_antar_panel" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('jarak_antar_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('jarak_antar_panel', $formKpInstalasiListrik->jarak_antar_panel) }}">
                            @error('jarak_antar_panel')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="jarak_antar_panel" class="block text-sm text-gray-700">Min 150 cm</label>
                        </div>

                        {{-- Baris 7 --}}
                        <div>
                            <label for="lebar_pintu_masuk" class="block text-sm text-gray-700">Lebar pintu masuk</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="lebar_pintu_masuk" placeholder="Aktual (cm)" id="lebar_pintu_masuk" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('lebar_pintu_masuk') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('lebar_pintu_masuk', $formKpInstalasiListrik->lebar_pintu_masuk) }}">
                            @error('lebar_pintu_masuk')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="lebar_pintu_masuk" class="block text-sm text-gray-700">Min 75 cm</label>
                        </div>

                        {{-- Baris 8 --}}
                        <div>
                            <label for="tinggi_panel" class="block text-sm text-gray-700">Tinggi panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="tinggi_panel" placeholder="Aktual (cm)" id="tinggi_panel" 
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('tinggi_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('tinggi_panel', $formKpInstalasiListrik->tinggi_panel) }}">
                            @error('tinggi_panel')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <label for="tinggi_panel" class="block text-sm text-gray-700">Min 200 cm</label>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" placeholder="Keterangan" rows="1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('keterangan', $formKpInstalasiListrik->keterangan) }}</textarea>
                    @error('keterangan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- pembumian_foto --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Dimensi</h2>
                    <label for="pembumian_foto" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                    {{-- foto lama --}}
                    @if($formKpInstalasiListrik->pembumian_foto)
                    @php $oldFiles = json_decode($formKpInstalasiListrik->pembumian_foto, true); @endphp
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

                    {{-- preview baru --}}
                    <div id="pembumian_foto-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input
                        type="file"
                        name="pembumian_foto[]"
                        id="pembumian_foto"
                        accept="image/*"
                        multiple
                        onchange="previewImageDynamic(this, 'pembumian_foto-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('pembumian_foto') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('pembumian_foto')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Pembumian --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Item Test</label>
                        </div>
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <label for="trafo1" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo1" placeholder="Aktual (cm)" id="trafo1"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo1', $formKpInstalasiListrik->trafo1) }}">
                            @error('trafo1')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <label for="trafo2" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo2" placeholder="Aktual (cm)" id="trafo2"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo2', $formKpInstalasiListrik->trafo2) }}">
                            @error('trafo2')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <label for="trafo3" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo3" placeholder="Aktual (cm)" id="trafo3"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo3', $formKpInstalasiListrik->trafo3) }}">
                            @error('trafo3')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 5 --}}
                        <div>
                            <label for="panel" class="block text-sm text-gray-700">Panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="panel" placeholder="Aktual (cm)" id="panel"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panel', $formKpInstalasiListrik->panel) }}">
                            @error('panel')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 6 --}}
                        <div>
                            <label for="bonding_panel" class="block text-sm text-gray-700">Bonding Panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="bonding_panel" placeholder="Aktual (cm)" id="bonding_panel"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bonding_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bonding_panel', $formKpInstalasiListrik->bonding_panel) }}">
                            @error('bonding_panel')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan2" id="keterangan2" placeholder="Keterangan2" rows="1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('keterangan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('keterangan2', $formKpInstalasiListrik->keterangan2) }}</textarea>
                    @error('keterangan2')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- pencahayaan_foto2 --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Pencahayaan</h2>
                    <label for="pencahayaan_foto2" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                    {{-- foto lama --}}
                    @if($formKpInstalasiListrik->pencahayaan_foto2)
                    @php $oldFiles = json_decode($formKpInstalasiListrik->pencahayaan_foto2, true); @endphp
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

                    {{-- preview baru --}}
                    <div id="pencahayaan_foto2-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input
                        type="file"
                        name="pencahayaan_foto2[]"
                        id="pencahayaan_foto2"
                        accept="image/*"
                        multiple
                        onchange="previewImageDynamic(this, 'pencahayaan_foto2-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('pencahayaan_foto2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('pencahayaan_foto2')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>                

                {{-- Pencahayaan --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Item Test</label>
                        </div>
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <label for="area_depan_panel" class="block text-sm text-gray-700">Area Depan Panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="area_depan_panel" placeholder="Aktual (cm)" id="area_depan_panel"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('area_depan_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('area_depan_panel', $formKpInstalasiListrik->area_depan_panel) }}">
                            @error('area_depan_panel')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <label for="area_blikg_panel" class="block text-sm text-gray-700">Area Belakang Panel</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="area_blikg_panel" placeholder="Aktual (cm)" id="area_blikg_panel"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('area_blikg_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('area_blikg_panel', $formKpInstalasiListrik->area_blikg_panel) }}">
                            @error('area_blikg_panel')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <label for="area_trafo" class="block text-sm text-gray-700">Area Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="area_trafo" placeholder="Aktual (cm)" id="area_trafo"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('area_trafo') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('area_trafo', $formKpInstalasiListrik->area_trafo) }}">
                            @error('area_trafo')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan3" id="keterangan3" placeholder="Keterangan3" rows="1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('keterangan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('keterangan3', $formKpInstalasiListrik->keterangan3) }}</textarea>
                    @error('keterangan3')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- thermography_foto --}}
                <div>
                    <h2 class="block mb-1 text-base font-bold text-gray-700">Thermography</h2>
                    <label for="thermography_foto" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                    {{-- foto lama --}}
                    @if($formKpInstalasiListrik->thermography_foto)
                    @php $oldFiles = json_decode($formKpInstalasiListrik->thermography_foto, true); @endphp
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

                    {{-- preview baru --}}
                    <div id="thermography_foto-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input
                        type="file"
                        name="thermography_foto[]"
                        id="thermography_foto"
                        accept="image/*"
                        multiple
                        onchange="previewImageDynamic(this, 'thermography_foto-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('thermography_foto') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('thermography_foto')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>     
                
                {{-- Thermography --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Item Test</label>
                        </div>
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div>
                            <label for="trafo1_thermal" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo1_thermal" placeholder="Aktual (cm)" id="trafo1_thermal"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo1_thermal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo1_thermal', $formKpInstalasiListrik->trafo1_thermal) }}">
                            @error('trafo1_thermal')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 3 --}}
                        <div>
                            <label for="trafo2_thermal" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo2_thermal" placeholder="Aktual (cm)" id="trafo2_thermal"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo2_thermal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo2_thermal', $formKpInstalasiListrik->trafo2_thermal) }}">
                            @error('trafo2_thermal')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div>
                            <label for="trafo3_thermal" class="block text-sm text-gray-700">Trafo</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="trafo3_thermal" placeholder="Aktual (cm)" id="trafo3_thermal"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('trafo3_thermal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('trafo3_thermal', $formKpInstalasiListrik->trafo3_thermal) }}">
                            @error('trafo3_thermal')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 5 --}}
                        <div>
                            <label for="circuit_breaker_utama" class="block text-sm text-gray-700">Circuit Breaker Utama</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="circuit_breaker_utama" placeholder="Aktual (cm)" id="circuit_breaker_utama"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('circuit_breaker_utama') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('circuit_breaker_utama', $formKpInstalasiListrik->circuit_breaker_utama) }}">
                            @error('circuit_breaker_utama')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 6 --}}
                        <div>
                            <label for="circuit_breaker_distribusi" class="block text-sm text-gray-700">Circuit Breaker Distribusi</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="circuit_breaker_distribusi" placeholder="Aktual (cm)" id="circuit_breaker_distribusi"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('circuit_breaker_distribusi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('circuit_breaker_distribusi', $formKpInstalasiListrik->circuit_breaker_distribusi) }}">
                            @error('circuit_breaker_distribusi')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris 7 --}}
                        <div>
                            <label for="busbar" class="block text-sm text-gray-700">Busbar</label>
                        </div>

                        <div>
                            <input type="number" step="any" name="busbar" placeholder="Aktual (cm)" id="busbar"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('busbar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('busbar', $formKpInstalasiListrik->busbar) }}">
                            @error('busbar')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keterangan--}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan4" id="keterangan4" placeholder="Keterangan" rows="1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('keterangan4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('keterangan4', $formKpInstalasiListrik->keterangan4) }}</textarea>
                    @error('keterangan4')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpInstalasiListrik->catatan) }}</textarea>
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
        // Add preview image upload
        function previewImageDynamic(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = ''; // Kosongkan preview sebelumnya

            if (inputElement.files && inputElement.files.length > 0) {
                Array.from(inputElement.files).forEach((file) => {
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
                            // Jika semua preview dihapus, kosongkan input
                            if (previewContainer.children.length === 0) {
                                inputElement.value = "";
                            }
                        };

                        wrapper.appendChild(img);
                        wrapper.appendChild(btn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        // Modal
        function openModal(name) {
            const modal = document.getElementById("modal_" + name);
            modal.classList.remove("hidden");

            // tutup modal saat klik area luar
            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    closeModal(name);
                }
            });
        }

        function closeModal(name) {
            const modal = document.getElementById("modal_" + name);
            modal.classList.add("hidden");
        }
    </script>
</x-layout>