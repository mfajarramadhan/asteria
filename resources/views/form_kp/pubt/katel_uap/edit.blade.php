<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.katel_uap.update', $formKpKatelUap->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                                value="{{ old('tanggal_pemeriksaan', optional($formKpKatelUap->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                    <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpKatelUap->jobOrderTool->jobOrder->nama_perusahaan }}">
                </div>
                
                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpKatelUap->jobOrderTool->kapasitas }}">
                </div>
                
                {{-- Model/Tipe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpKatelUap->jobOrderTool->model }}">
                </div>
                
                {{-- No.Seri --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpKatelUap->jobOrderTool->no_seri }}">
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                    <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpKatelUap->pabrik_pembuat) }}">
                    @error('pabrik_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_informasi_umum --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Informasi Umum</h2>
                    <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                    {{-- foto lama --}}
                    @if($formKpKatelUap->foto_informasi_umum)
                        @php $oldFiles = json_decode($formKpKatelUap->foto_informasi_umum, true); @endphp
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

                {{-- Jenis Alat --}}
                <div>
                    <label for="panjang_pipa" class="block text-sm font-medium text-gray-700">Jenis Alat</label>
                    <input type="text" name="jenis_alat" placeholder="Jenis Alat" id="jenis_alat"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('jenis_alat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('jenis_alat', $formKpKatelUap->jenis_alat) }}">
                    @error('jenis_alat')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tempat --}}
                <div>
                    <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                    <input type="text" name="tempat" placeholder="Tempat"
                        id="tempat"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('tempat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tempat', $formKpKatelUap->tempat) }}">
                    @error('tempat')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun Pembuatan --}}
                <div>
                    <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                    <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan"
                        id="tahun_pembuatan"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tahun_pembuatan', $formKpKatelUap->tahun_pembuatan) }}">
                    @error('tahun_pembuatan')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tekanan Desain --}}
                <div>
                    <label for="panjang_pipa" class="block text-sm font-medium text-gray-700">Tekanan Desain</label>
                    <input type="number" step="any" name="tekanan_desain" placeholder="Tekanan Desain" id="tekanan_desain"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('tekanan_desain') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tekanan_desain', $formKpKatelUap->tekanan_desain) }}">
                    @error('tekanan_desain')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tekanan Kerja --}}
                <div>
                    <label for="panjang_pipa" class="block text-sm font-medium text-gray-700">Tekanan Kerja</label>
                    <input type="number" step="any" name="tekanan_kerja" placeholder="Tekanan Kerja" id="tekanan_kerja"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('tekanan_kerja') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tekanan_kerja', $formKpKatelUap->tekanan_kerja) }}">
                    @error('tekanan_kerja')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kapasitas Uap --}}
                <div>
                    <label for="kapasitas_uap" class="block text-sm font-medium text-gray-700">Kapasitas Uap</label>
                    <input type="text" name="kapasitas_uap" placeholder="Tekanan Kerja" id="kapasitas_uap"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('kapasitas_uap') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('kapasitas_uap', $formKpKatelUap->kapasitas_uap) }}">
                    @error('kapasitas_uap')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Luas Pemanasan --}}
                <div>
                    <label for="luas_pemanasan" class="block text-sm font-medium text-gray-700">Luas Pemanasan</label>
                    <input type="number" step="any" name="luas_pemanasan" placeholder="Luas Pemanasan" id="luas_pemanasan"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('luas_pemanasan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('luas_pemanasan', $formKpKatelUap->luas_pemanasan) }}">
                    @error('luas_pemanasan')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Work Temperature --}}
                <div>
                    <label for="work_temperature" class="block text-sm font-medium text-gray-700">Work Temperature</label>
                    <input type="number" step="any" name="work_temperature" placeholder="Work Temperature" id="work_temperature"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('work_temperature') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('work_temperature', $formKpKatelUap->work_temperature) }}">
                    @error('work_temperature')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bahan Bakar --}}
                <div>
                    <label for="bahan_bakar" class="block text-sm font-medium text-gray-700">Bahan Bakar</label>
                    <input type="text" name="bahan_bakar" placeholder="Bahan Bakar" id="bahan_bakar"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('bahan_bakar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('bahan_bakar', $formKpKatelUap->bahan_bakar) }}">
                    @error('bahan_bakar')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('lokasi', $formKpKatelUap->lokasi) }}">
                    @error('lokasi')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Foto foto_safety_valve --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Safety Device</h2>
                    <label for="foto_safety_valve" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)<label>

                    {{-- foto lama --}}
                    @if($formKpKatelUap->foto_safety_valve)
                        @php $oldFiles = json_decode($formKpKatelUap->foto_safety_valve, true); @endphp
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
                    <div id="foto_safety_valve-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_safety_valve[]" 
                        id="foto_safety_valve" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_safety_valve-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_safety_valve') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_safety_valve')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Safety Valve --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Membuka</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Menutup</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="safety_valve1_membuka" class="block text-sm text-gray-700">Safety Valve 1</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="safety_valve1_membuka" id="safety_valve1_membuka"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve1_membuka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_valve1_membuka', $formKpKatelUap->safety_valve1_membuka) }}">
                        @error('safety_valve1_membuka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="safety_valve1_menutup" id="safety_valve1_menutup"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve1_menutup') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_valve1_menutup', $formKpKatelUap->safety_valve1_menutup) }}">
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
                        <input type="number" step="any" name="safety_valve2_membuka" id="safety_valve2_membuka"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve2_membuka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_valve2_membuka', $formKpKatelUap->safety_valve2_membuka) }}">
                        @error('safety_valve2_membuka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="safety_valve2_menutup" id="safety_valve2_menutup"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('safety_valve2_menutup') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('safety_valve2_menutup', $formKpKatelUap->safety_valve2_menutup) }}">
                        @error('safety_valve2_menutup')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Safety Valve --}}
                <div>
                    <textarea name="catatan_safety_valve" id="catatan_safety_valve" placeholder="Catatan Safety Valve" rows="2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('catatan_safety_valve') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_safety_valve', $formKpKatelUap->catatan_safety_valve) }}</textarea>
                    @error('catatan_safety_valve')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Foto foto_pressure_switch --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pressure Switch</h2>
                    <label for="foto_pressure_switch" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                    {{-- foto lama --}}
                    @if($formKpKatelUap->foto_pressure_switch)
                        @php $oldFiles = json_decode($formKpKatelUap->foto_pressure_switch, true); @endphp
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
                    <div id="foto_pressure_switch-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_pressure_switch[]" 
                        id="foto_pressure_switch" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_pressure_switch-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_pressure_switch')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Pressure Switch --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Deskripsi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tekanan Setting</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="pressure_switch_on_set" class="block text-sm text-gray-700">Pressure Switch On</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_on_set" id="pressure_switch_on_set"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_on_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_on_set', $formKpKatelUap->pressure_switch_on_set) }}">
                        @error('pressure_switch_on_set')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_on_hasil" id="pressure_switch_on_hasil"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_on_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_on_hasil', $formKpKatelUap->pressure_switch_on_hasil) }}">
                        @error('pressure_switch_on_hasil')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="pressure_switch_off_set" class="block text-sm text-gray-700">Pressure Switch Off</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_off_set" id="pressure_switch_off_set"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_off_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_off_set', $formKpKatelUap->pressure_switch_off_set) }}">
                        @error('pressure_switch_off_set')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_off_hasil" id="pressure_switch_off_hasil"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_off_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_off_hasil', $formKpKatelUap->pressure_switch_off_hasil) }}">
                        @error('pressure_switch_off_hasil')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Pressure Switch --}}
                <div>
                    <textarea name="catatan_pressure_switch" id="catatan_pressure_switch" placeholder="Catatan Pressure Switch" rows="2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('catatan_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_pressure_switch', $formKpKatelUap->catatan_pressure_switch) }}</textarea>
                    @error('catatan_pressure_switch')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpKatelUap->catatan) }}</textarea>
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
        </script>
</x-layout>
