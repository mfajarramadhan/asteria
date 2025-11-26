<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.ptp.motor_diesel.update', $formKpMotorDiesel->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                <div class="w-full md:w-[48%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan"
                            value="{{ old('tanggal_pemeriksaan', optional($formKpMotorDiesel->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpMotorDiesel->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpMotorDiesel->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpMotorDiesel->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpMotorDiesel->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpMotorDiesel->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpMotorDiesel->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- foto_mesin --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Engine</h2>
                <label for="foto_mesin" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpMotorDiesel->foto_mesin)
                @php $oldFiles = json_decode($formKpMotorDiesel->foto_mesin, true); @endphp
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
                <div id="foto_mesin-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_mesin[]"
                    id="foto_mesin"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_mesin-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_mesin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Daya Mesin --}}
            <div>
                <label for="daya_mesin" class="block text-sm font-medium text-gray-700">Daya Mesin</label>
                <input type="number" step="any" name="daya_mesin" placeholder="Daya" id="daya_mesin"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('daya_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('daya_mesin', $formKpMotorDiesel->daya_mesin) }}">
                @error('daya_mesin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jumlah Silinder --}}
            <div>
                <label for="jumlah_silinder" class="block text-sm font-medium text-gray-700">Jumlah Silinder</label>
                <input type="number" step="any" name="jumlah_silinder" placeholder="Jumlah Silinder" id="jumlah_silinder"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_silinder') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('jumlah_silinder', $formKpMotorDiesel->jumlah_silinder) }}">
                @error('jumlah_silinder')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Generator --}}
            {{-- foto_generator --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Generator</h2>
                <label for="foto_generator" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpMotorDiesel->foto_generator)
                    @php $oldFiles = json_decode($formKpMotorDiesel->foto_generator, true); @endphp
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
                <div id="foto_generator-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input 
                    type="file" 
                    name="foto_generator[]" 
                    id="foto_generator" 
                    accept="image/*" 
                    multiple
                    onchange="previewImageDynamic(this, 'foto_generator-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('foto_generator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_generator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror   
            </div>

            {{-- Pengukuran --}}
            {{-- foto_pengukuran --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran</h2>
                <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpMotorDiesel->foto_pengukuran)
                    @php $oldFiles = json_decode($formKpMotorDiesel->foto_pengukuran, true); @endphp
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
                <div id="foto_pengukuran-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input 
                    type="file" 
                    name="foto_pengukuran[]" 
                    id="foto_pengukuran" 
                    accept="image/*" 
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pengukuran-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('foto_pengukuran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pengukuran')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror   
            </div>

            {{-- Grounding 1 --}}
            <div>
                <label for="grounding1" class="block text-sm font-medium text-gray-700">Grounding 1</label>
                <input type="text" name="grounding1" placeholder="Grounding 1 (Hasil) - PLTD" id="grounding1"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('grounding1', $formKpMotorDiesel->grounding1) }}">
                @error('grounding1')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Grounding 2 --}}
            <div>
                <label for="grounding2" class="block text-sm font-medium text-gray-700">Grounding 2</label>
                <input type="text" name="grounding2" placeholder="Grounding 2 (Hasil) - Panel LVMDP" id="grounding2"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('grounding2', $formKpMotorDiesel->grounding2) }}">
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
                    <input type="text" name="pondasi" id="pondasi"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pondasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pondasi', $formKpMotorDiesel->pondasi) }}">
                    @error('pondasi')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 3 --}}
                <div>
                    <label for="rangka" class="block text-sm text-gray-700">Rangka</label>
                </div>
                <div>
                    <input type="text" name="rangka" id="rangka"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('rangka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('rangka', $formKpMotorDiesel->rangka) }}">
                    @error('rangka')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 4 --}}
                <div>
                    <label for="cover_kipas" class="block text-sm text-gray-700">Cover Kipas</label>
                </div>
                <div>
                    <input type="text" name="cover_kipas" id="cover_kipas"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('cover_kipas') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('cover_kipas', $formKpMotorDiesel->cover_kipas) }}">
                    @error('cover_kipas')
                    <div class="text-xs text-red-600">{{ $message }}</div>
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
                    <input type="text" name="pencahayaan_depan" id="pencahayaan_depan"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_depan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pencahayaan_depan', $formKpMotorDiesel->pencahayaan_depan) }}">
                    @error('pencahayaan_depan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 3 --}}
                <div>
                    <label for="pencahayaan_belakang" class="block text-sm text-gray-700">Bagian Belakang</label>
                </div>
                <div>
                    <input type="text" name="pencahayaan_belakang" id="pencahayaan_belakang"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pencahayaan_belakang', $formKpMotorDiesel->pencahayaan_belakang) }}">
                    @error('pencahayaan_belakang')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 4 --}}
                <div>
                    <label for="pencahayaan_tengah" class="block text-sm text-gray-700">Bagian Tengah</label>
                </div>
                <div>
                    <input type="text" name="pencahayaan_tengah" id="pencahayaan_tengah"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_tengah') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pencahayaan_tengah', $formKpMotorDiesel->pencahayaan_tengah) }}">
                    @error('pencahayaan_tengah')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 5 --}}
                <div>
                    <label for="pencahayaan_depan_panel" class="block text-sm text-gray-700">Depan Panel</label>
                </div>
                <div>
                    <input type="text" name="pencahayaan_depan_panel" id="pencahayaan_depan_panel"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pencahayaan_depan_panel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pencahayaan_depan_panel', $formKpMotorDiesel->pencahayaan_depan_panel) }}">
                    @error('pencahayaan_depan_panel')
                    <div class="text-xs text-red-600">{{ $message }}</div>
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
                    <input type="text" name="kebisingan_ruang_pltd" id="kebisingan_ruang_pltd"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_ruang_pltd') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('kebisingan_ruang_pltd', $formKpMotorDiesel->kebisingan_ruang_pltd) }}">
                    @error('kebisingan_ruang_pltd')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 3 --}}
                <div>
                    <label for="kebisingan_ruang_kontrol" class="block text-sm text-gray-700">Ruang Kontrol</label>
                </div>
                <div>
                    <input type="text" name="kebisingan_ruang_kontrol" id="kebisingan_ruang_kontrol"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_ruang_kontrol') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('kebisingan_ruang_kontrol', $formKpMotorDiesel->kebisingan_ruang_kontrol) }}">
                    @error('kebisingan_ruang_kontrol')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 4 --}}
                <div>
                    <label for="kebisingan_luar_ruang_pltd" class="block text-sm text-gray-700">Diluar Area PLTD</label>
                </div>
                <div>
                    <input type="text" name="kebisingan_luar_ruang_pltd" id="kebisingan_luar_ruang_pltd"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_luar_ruang_pltd') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('kebisingan_luar_ruang_pltd', $formKpMotorDiesel->kebisingan_luar_ruang_pltd) }}">
                    @error('kebisingan_luar_ruang_pltd')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 5 --}}
                <div>
                    <label for="kebisingan_area_kerja" class="block text-sm text-gray-700">Area Kerja</label>
                </div>
                <div>
                    <input type="text" name="kebisingan_area_kerja" id="kebisingan_area_kerja"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kebisingan_area_kerja') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('kebisingan_area_kerja', $formKpMotorDiesel->kebisingan_area_kerja) }}">
                    @error('kebisingan_area_kerja')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Pengujian --}}
            {{-- foto_pengujian --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengujian</h2>
                <label for="foto_pengujian" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpMotorDiesel->foto_pengujian)
                    @php $oldFiles = json_decode($formKpMotorDiesel->foto_pengujian, true); @endphp
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
                <div id="foto_pengujian-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input 
                    type="file" 
                    name="foto_pengujian[]" 
                    id="foto_pengujian" 
                    accept="image/*" 
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pengujian-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('foto_pengujian') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pengujian')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                @enderror   
            </div>

            {{-- Jenis Proteksi --}}
            <div class="grid items-center grid-cols-3 gap-4 px-4">

                {{-- Header --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Jenis Proteksi</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil Pengujian</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>

                {{-- Emergency Stop --}}
                <div>
                    <label for="emergency_stop" class="block text-sm text-gray-700">Emergency Stop</label>
                </div>

                <div>
                    <select name="emergency_stop" id="emergency_stop"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                        <option value="-" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == '-' ? 'selected' : '' }}>-</option>
                        <option value="Berfungsi" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                        <option value="Tidak Berfungsi" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>

                    </select>

                    @error('emergency_stop')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="emergency_stop_ket" id="emergency_stop_ket"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('emergency_stop_ket') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('emergency_stop_ket', $formKpMotorDiesel->emergency_stop_ket) }}">

                    @error('emergency_stop_ket')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpMotorDiesel->catatan) }}</textarea>
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