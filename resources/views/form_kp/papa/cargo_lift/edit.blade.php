<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.papa.cargo_lift.update', $formKpCargoLift->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                                value="{{ old('tanggal_pemeriksaan', optional($formKpCargoLift->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                @if($formKpCargoLift->foto_informasi_umum)
                @php $oldFiles = json_decode($formKpCargoLift->foto_informasi_umum, true); @endphp
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpCargoLift->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpCargoLift->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpCargoLift->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpCargoLift->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat', $formKpCargoLift->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis--}}
            <div>
                <label for="jenis_alat" class="block text-sm font-medium text-gray-700">Jenis Alat</label>
                <input type="text" name="jenis_alat" placeholder="Jenis alat" id="jenis_alat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_alat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_alat', $formKpCargoLift->jenis_alat) }}">
                @error('jenis_alat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi--}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpCargoLift->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan--}}
            <div>
                <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan', $formKpCargoLift->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tinggi Angkat --}}
            <div class="grid grid-cols-2 gap-4">

                {{-- Left: Label --}}
                <div class="flex items-center">
                    <label class="block text-sm font-bold text-gray-700">
                        Tinggi Angkat
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">

                    {{-- Tinggi Angkat (Meter) --}}
                    <div>
                        <label for="tinggi_angkat_meter" class="block text-sm font-medium text-gray-700">Tinggi Angkat (Meter)</label>
                        <input type="number" step="any" name="tinggi_angkat_meter" placeholder="Meter" id="tinggi_angkat_meter"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tinggi_angkat_meter') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('tinggi_angkat_meter', $formKpCargoLift->tinggi_angkat_meter ?? '') }}">
                        @error('tinggi_angkat_meter')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tinggi Angkat (Lantai) --}}
                    <div>
                        <label for="tinggi_angkat_lantai" class="block text-sm font-medium text-gray-700">Tinggi Angkat (Lantai)</label>
                        <input type="number" step="any" name="tinggi_angkat_lantai" placeholder="Lantai" id="tinggi_angkat_lantai"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tinggi_angkat_lantai') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('tinggi_angkat_lantai', $formKpCargoLift->tinggi_angkat_lantai ?? '') }}">
                        @error('tinggi_angkat_lantai')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>


            {{-- Kecepatan Angkat --}}
            <div>
                <label for="kecepatan_angkat" class="block text-sm font-medium text-gray-700">Kecepatan Angkat</label>
                <input type="number" step="any" name="kecepatan_angkat" placeholder="Kecepatan Angkat" id="kecepatan_angkat"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('kecepatan_angkat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('kecepatan_angkat', $formKpCargoLift->kecepatan_angkat ?? '') }}">
                @error('kecepatan_angkat')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>


            {{-- Dimensi Pondasi --}}
            <div>
                <label for="dimensi_pondasi" class="block text-sm font-medium text-gray-700">Dimensi Pondasi</label>
                <input type="text" name="dimensi_pondasi" placeholder="Dimensi Pondasi" id="dimensi_pondasi"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('dimensi_pondasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('dimensi_pondasi', $formKpCargoLift->dimensi_pondasi ?? '') }}">
                @error('dimensi_pondasi')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>


            {{-- Dimensi Sangkar --}}
            <div>
                <label for="dimensi_sangkar" class="block text-sm font-medium text-gray-700">Dimensi Sangkar</label>
                <input type="text" name="dimensi_sangkar" placeholder="Dimensi Sangkar" id="dimensi_sangkar"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('dimensi_sangkar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('dimensi_sangkar', $formKpCargoLift->dimensi_sangkar ?? '') }}">
                @error('dimensi_sangkar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>


            {{-- Dimensi Ruang Luncur --}}
            <div>
                <label for="dimensi_ruang_luncur" class="block text-sm font-medium text-gray-700">Dimensi Ruang Luncur</label>
                <input type="text" name="dimensi_ruang_luncur" placeholder="Dimensi Ruang Luncur" id="dimensi_ruang_luncur"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('dimensi_ruang_luncur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('dimensi_ruang_luncur', $formKpCargoLift->dimensi_ruang_luncur ?? '') }}">
                @error('dimensi_ruang_luncur')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_rantai --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
                <label for="foto_rantai" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_rantai)
                @php $oldFiles = json_decode($formKpCargoLift->foto_rantai, true); @endphp
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
                <div id="foto_rantai-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_rantai[]"
                    id="foto_rantai"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_rantai-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_rantai') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

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
                        <img src="{{ asset('assets/image/papa/chain.png') }}" alt="Kecepatan Image" class="object-contain h-full rounded-md shadow-md">
                    </div>

                    <label class="block mt-2 text-sm font-medium text-gray-700">
                        Panjang 1 Meter Rantai
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">
                    @for ($i = 1; $i <= 6; $i++)
                        <div>
                            <input type="number" step="any" name="panjang_rantai{{ $i }}" placeholder="Panjang {{ $i }}" id="panjang_rantai{{ $i }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_rantai{{ $i }}') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_rantai'.$i, $formKpCargoLift->{'panjang_rantai'.$i}) }}">
                            @error('panjang_rantai'.$i) 
                                <div class="text-xs text-red-600">{{ $message }}</div> 
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>

            {{-- foto_wire_rope --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Wire Rope/Tali Kawat Baja/Sling</h2>
                <label for="foto_wire_rope" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_wire_rope)
                @php $oldFiles = json_decode($formKpCargoLift->foto_wire_rope, true); @endphp
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
                <div id="foto_wire_rope-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_wire_rope[]"
                    id="foto_wire_rope"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_wire_rope-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_wire_rope') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

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
                        <img src="{{ asset('assets/image/papa/wire.png') }}" alt="Kecepatan Image" class="object-contain h-full rounded-md shadow-md">
                    </div>

                    <label class="block mt-2 text-sm font-medium text-gray-700">
                        Panjang Wire Rope
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">
                    @for ($i = 1; $i <= 6; $i++)
                        <div>
                            <input type="number" step="any" name="panjang_wire_rope{{ $i }}" placeholder="W{{ $i }}" id="panjang_wire_rope{{ $i }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_wire_rope{{ $i }}') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_wire_rope'.$i, $formKpCargoLift->{'panjang_wire_rope'.$i}) }}">
                            @error('panjang_wire_rope'.$i) 
                                <div class="text-xs text-red-600">{{ $message }}</div> 
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>

            {{-- foto_hook --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Hook/Kait</h2>
                <label for="foto_hook" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_hook)
                @php $oldFiles = json_decode($formKpCargoLift->foto_hook, true); @endphp
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
                <div id="foto_hook-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_hook[]"
                    id="foto_hook"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_hook-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_hook') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

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
                        <img src="{{ asset('assets/image/papa/hook.png') }}" alt="Kecepatan Image" class="object-contain h-full rounded-md shadow-md">
                    </div>

                    <label class="block mt-2 text-sm font-medium text-gray-700">
                        Panjang Tali Kait
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">
                    @php
                        $hooks = ['A','Ai','Ha','B','Bi','Hb','W_C','D'];
                    @endphp

                    @foreach ($hooks as $hook)
                        <div>
                            <input type="number" step="any" name="panjang_hook{{ $hook }}" placeholder="Panjang Hook {{ $hook }}" id="panjang_hook{{ $hook }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_hook'.$hook) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_hook'.$hook, $formKpCargoLift->{'panjang_hook'.$hook}) }}">
                            @error('panjang_hook'.$hook)
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- foto_pulley --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pulley</h2>
                <label for="foto_pulley" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_pulley)
                @php $oldFiles = json_decode($formKpCargoLift->foto_pulley, true); @endphp
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
                <div id="foto_pulley-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_pulley[]"
                    id="foto_pulley"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pulley-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pulley') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

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
                        <img src="{{ asset('assets/image/papa/pulley.png') }}" alt="Kecepatan Image" class="object-contain h-full rounded-md shadow-md">
                    </div>

                    <label class="block mt-2 text-sm font-medium text-gray-700">
                        Panjang Pulley
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">
                    @php
                        $pulleys = ['A','B','C','D','E'];
                    @endphp

                    @foreach ($pulleys as $p)
                        <div>
                            <input type="number" step="any" name="panjang_pulley{{ $p }}" placeholder="{{ $p }}" id="panjang_pulley{{ $p }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_pulley'.$p) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('panjang_pulley'.$p, $formKpCargoLift->{'panjang_pulley'.$p}) }}">
                            @error('panjang_pulley'.$p)
                                <div class="text-xs text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- foto_performance --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Uji Penampilan/Peroformance</h2>
                <label for="foto_performance" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_performance)
                @php $oldFiles = json_decode($formKpCargoLift->foto_performance, true); @endphp
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
                <div id="foto_performance-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_performance[]"
                    id="foto_performance"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_performance-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_performance') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_performance')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Uji Performance --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-5 gap-4 min-w-[700px]">

                    {{-- Baris 1: Header --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hoisting: Naik/Turun *)</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Jenis Uji: Beban/Tanpa Beban*)</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Bobot Beban</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Indikasi Kerusakan / Kekurangan</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <input type="text" name="hoisting_naik_turun1" id="hoisting_naik_turun1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting_naik_turun1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting_naik_turun1', $formKpCargoLift->hoisting_naik_turun1 ?? '') }}">
                        @error('hoisting_naik_turun1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="jenis_uji1" id="jenis_uji1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('jenis_uji1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('jenis_uji1', $formKpCargoLift->jenis_uji1 ?? '') }}">
                        @error('jenis_uji1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="bobot_beban1" id="bobot_beban1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('bobot_beban1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('bobot_beban1', $formKpCargoLift->bobot_beban1 ?? '') }}">
                        @error('bobot_beban1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="indikasi_kerusakan1" id="indikasi_kerusakan1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('indikasi_kerusakan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('indikasi_kerusakan1', $formKpCargoLift->indikasi_kerusakan1 ?? '') }}">
                        @error('indikasi_kerusakan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil_performance1" id="hasil_performance1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil_performance1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil_performance1', $formKpCargoLift->hasil_performance1 ?? '') }}">
                        @error('hasil_performance1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <input type="text" name="hoisting_naik_turun2" id="hoisting_naik_turun2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting_naik_turun2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting_naik_turun2', $formKpCargoLift->hoisting_naik_turun2 ?? '') }}">
                        @error('hoisting_naik_turun2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="jenis_uji2" id="jenis_uji2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('jenis_uji2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('jenis_uji2', $formKpCargoLift->jenis_uji2 ?? '') }}">
                        @error('jenis_uji2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="bobot_beban2" id="bobot_beban2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('bobot_beban2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('bobot_beban2', $formKpCargoLift->bobot_beban2 ?? '') }}">
                        @error('bobot_beban2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="indikasi_kerusakan2" id="indikasi_kerusakan2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('indikasi_kerusakan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('indikasi_kerusakan2', $formKpCargoLift->indikasi_kerusakan2 ?? '') }}">
                        @error('indikasi_kerusakan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil_performance2" id="hasil_performance2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil_performance2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil_performance2', $formKpCargoLift->hasil_performance2 ?? '') }}">
                        @error('hasil_performance2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <input type="text" name="hoisting_naik_turun3" id="hoisting_naik_turun3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting_naik_turun3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting_naik_turun3', $formKpCargoLift->hoisting_naik_turun3 ?? '') }}">
                        @error('hoisting_naik_turun3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="jenis_uji3" id="jenis_uji3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('jenis_uji3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('jenis_uji3', $formKpCargoLift->jenis_uji3 ?? '') }}">
                        @error('jenis_uji3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="bobot_beban3" id="bobot_beban3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('bobot_beban3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('bobot_beban3', $formKpCargoLift->bobot_beban3 ?? '') }}">
                        @error('bobot_beban3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="indikasi_kerusakan3" id="indikasi_kerusakan3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('indikasi_kerusakan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('indikasi_kerusakan3', $formKpCargoLift->indikasi_kerusakan3 ?? '') }}">
                        @error('indikasi_kerusakan3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil_performance3" id="hasil_performance3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil_performance3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil_performance3', $formKpCargoLift->hasil_performance3 ?? '') }}">
                        @error('hasil_performance3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            {{-- foto_loadtest --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
                <label class="block mb-1 text-xs italic font-normal text-gray-700">*) Amati keseluruhan apakah terjadi crack, deformasi, bocor, putus, rusak, dll.</label>
                <label class="block mb-1 text-xs italic font-normal text-gray-700">*) Fungsi kerja komponen safety device/indicator, sistem mekanis, rem, tenaga penggerak & rangkaian kekuatan konstruksi</label>
                <label for="foto_loadtest" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_loadtest)
                @php $oldFiles = json_decode($formKpCargoLift->foto_loadtest, true); @endphp
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
                <div id="foto_loadtest-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_loadtest[]"
                    id="foto_loadtest"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_loadtest-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_loadtest') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_loadtest')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Uji Load Test --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">

                    {{-- Baris 1 (Header) --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Statis & Dinamis *)</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tinggi Angkat Hook</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">SWL x Beban Uji Load Chart</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hoisting</label>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <input type="text" name="statis_dinamis1" id="statis_dinamis1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('statis_dinamis1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('statis_dinamis1', $formKpCargoLift->statis_dinamis1 ?? '') }}">
                        @error('statis_dinamis1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="tinggi_angkat_hook1" id="tinggi_angkat_hook1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tinggi_angkat_hook1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('tinggi_angkat_hook1', $formKpCargoLift->tinggi_angkat_hook1 ?? '') }}">
                        @error('tinggi_angkat_hook1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="swl_beban_uji1" id="swl_beban_uji1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('swl_beban_uji1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('swl_beban_uji1', $formKpCargoLift->swl_beban_uji1 ?? '') }}">
                        @error('swl_beban_uji1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hoisting1" id="hoisting1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting1', $formKpCargoLift->hoisting1 ?? '') }}">
                        @error('hoisting1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil1" id="hasil1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil1', $formKpCargoLift->hasil1 ?? '') }}">
                        @error('hasil1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="keterangan1" id="keterangan1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('keterangan1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('keterangan1', $formKpCargoLift->keterangan1 ?? '') }}">
                        @error('keterangan1') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <input type="text" name="statis_dinamis2" id="statis_dinamis2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('statis_dinamis2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('statis_dinamis2', $formKpCargoLift->statis_dinamis2 ?? '') }}">
                        @error('statis_dinamis2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="tinggi_angkat_hook2" id="tinggi_angkat_hook2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tinggi_angkat_hook2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('tinggi_angkat_hook2', $formKpCargoLift->tinggi_angkat_hook2 ?? '') }}">
                        @error('tinggi_angkat_hook2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="swl_beban_uji2" id="swl_beban_uji2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('swl_beban_uji2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('swl_beban_uji2', $formKpCargoLift->swl_beban_uji2 ?? '') }}">
                        @error('swl_beban_uji2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hoisting2" id="hoisting2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting2', $formKpCargoLift->hoisting2 ?? '') }}">
                        @error('hoisting2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil2" id="hasil2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil2', $formKpCargoLift->hasil2 ?? '') }}">
                        @error('hasil2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="keterangan2" id="keterangan2"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('keterangan2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('keterangan2', $formKpCargoLift->keterangan2 ?? '') }}">
                        @error('keterangan2') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <input type="text" name="statis_dinamis3" id="statis_dinamis3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('statis_dinamis3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('statis_dinamis3', $formKpCargoLift->statis_dinamis3 ?? '') }}">
                        @error('statis_dinamis3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="tinggi_angkat_hook3" id="tinggi_angkat_hook3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('tinggi_angkat_hook3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('tinggi_angkat_hook3', $formKpCargoLift->tinggi_angkat_hook3 ?? '') }}">
                        @error('tinggi_angkat_hook3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="swl_beban_uji3" id="swl_beban_uji3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('swl_beban_uji3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('swl_beban_uji3', $formKpCargoLift->swl_beban_uji3 ?? '') }}">
                        @error('swl_beban_uji3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hoisting3" id="hoisting3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hoisting3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hoisting3', $formKpCargoLift->hoisting3 ?? '') }}">
                        @error('hoisting3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="hasil3" id="hasil3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('hasil3', $formKpCargoLift->hasil3 ?? '') }}">
                        @error('hasil3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <input type="text" name="keterangan3" id="keterangan3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('keterangan3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('keterangan3', $formKpCargoLift->keterangan3 ?? '') }}">
                        @error('keterangan3') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            {{-- foto_defleksi --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Defleksi</h2>
                <label for="foto_defleksi" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpCargoLift->foto_defleksi)
                @php $oldFiles = json_decode($formKpCargoLift->foto_defleksi, true); @endphp
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
                <div id="foto_defleksi-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_defleksi[]"
                    id="foto_defleksi"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_defleksi-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_defleksi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_defleksi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Defleksi --}}
            <div class="grid items-center grid-cols-3 gap-4">

                {{-- Baris 1: Label --}}
                @php
                    $labels = ['Posisi', 'Dengan Beban', 'Tanpa Beban'];
                @endphp
                @foreach ($labels as $label)
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">{{ $label }}</label>
                    </div>
                @endforeach

                {{-- Baris 2: Posisi Radio + Single Girder --}}
                <div>
                    @php $posisiOptions = [1,2,3]; @endphp
                    <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                        @foreach ($posisiOptions as $i)
                            <label class="flex-1 {{ $loop->last ? '' : 'border-r border-gray-400' }}">
                                <input type="radio" name="posisi_defleksi" value="{{ $i }}" class="hidden peer"
                                    {{ ($formKpCargoLift->posisi_defleksi ?? '') == $i ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    {{ $i }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('posisi_defleksi')
                        <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="single_girder_beban" class="block text-sm text-gray-700">Single Girder</label>
                    <input type="number" step="any" name="single_girder_beban" id="single_girder_beban"
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('single_girder_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ $formKpCargoLift->single_girder_beban ?? '' }}">
                    @error('single_girder_beban')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="number" step="any" name="single_girder_tanpa_beban" id="single_girder_tanpa_beban"
                        class="block w-full shadow-md px-3 py-2 mt-6 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('single_girder_tanpa_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ $formKpCargoLift->single_girder_tanpa_beban ?? '' }}">
                    @error('single_girder_tanpa_beban')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 3: Posisi Radio Dua + Double Girder --}}
                <div>
                    @php $posisiDuaOptions = [1,2,3,6,5,4]; @endphp
                    <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                        @foreach (array_slice($posisiDuaOptions, 0, 3) as $i)
                            <label class="flex-1 {{ $loop->last ? '' : 'border-r border-gray-400' }}">
                                <input type="radio" name="posisi_defleksi_dua" value="{{ $i }}" class="hidden peer"
                                    {{ ($formKpCargoLift->posisi_defleksi_dua ?? '') == $i ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    {{ $i }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <div class="flex overflow-hidden border border-gray-400 rounded-md">
                        @foreach (array_slice($posisiDuaOptions, 3) as $i)
                            <label class="flex-1 {{ $loop->last ? '' : 'border-r border-gray-400' }}">
                                <input type="radio" name="posisi_defleksi_dua" value="{{ $i }}" class="hidden peer"
                                    {{ ($formKpCargoLift->posisi_defleksi_dua ?? '') == $i ? 'checked' : '' }}>
                                <div class="py-2 text-center cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white">
                                    {{ $i }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('posisi_defleksi_dua')
                        <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="double_girder_beban" class="block text-sm text-gray-700">Double Girder</label>
                    @php $doubleGirderFields = ['double_girder_beban','double_girder_beban_dua']; @endphp
                    @foreach ($doubleGirderFields as $field)
                        <input type="number" step="any" name="{{ $field }}" id="{{ $field }}"
                            class="block w-full shadow-md px-3 py-2 mt-{{ $loop->first ? '1' : '2' }} border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error($field) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ $formKpCargoLift->$field ?? '' }}">
                        @error($field)
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    @endforeach
                </div>

                <div>
                    @php $doubleGirderTanpaFields = ['double_girder_tanpa_beban','double_girder_tanpa_beban_dua']; @endphp
                    @foreach ($doubleGirderTanpaFields as $field)
                        <input type="number" step="any" name="{{ $field }}" id="{{ $field }}"
                            class="block w-full shadow-md px-3 py-2 mt-{{ $loop->first ? '6' : '2' }} border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error($field) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ $formKpCargoLift->$field ?? '' }}">
                        @error($field)
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    @endforeach
                </div>
            </div>

            {{-- Hasil Uji --}}
            <div class="grid items-center grid-cols-2 gap-4">

                {{-- Pengujian NTD --}}
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">
                        Pengujian NTD : Tidak dilakukan / Dilakukan*) pada bagian:
                    </label>
                </div>
                <div>
                    <input 
                        type="text" 
                        name="pengujian_ntd" 
                        id="pengujian_ntd"
                        placeholder=""
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('pengujian_ntd') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('pengujian_ntd', $formKpCargoLift->pengujian_ntd ?? '') }}"
                    >
                    @error('pengujian_ntd')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Hasil --}}
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Hasil :</label>
                </div>
                <div>
                    <input 
                        type="text" 
                        name="hasil_uji" 
                        id="hasil_uji"
                        placeholder=""
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('hasil_uji') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('hasil_uji', $formKpCargoLift->hasil_uji ?? '') }}"
                    >
                    @error('hasil_uji')
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
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpCargoLift->catatan) }}</textarea>
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