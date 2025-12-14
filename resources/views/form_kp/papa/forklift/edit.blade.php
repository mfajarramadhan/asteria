<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.papa.forklift.update', $formKpForklift->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                                value="{{ old('tanggal_pemeriksaan', optional($formKpForklift->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                @if($formKpForklift->foto_informasi_umum)
                @php $oldFiles = json_decode($formKpForklift->foto_informasi_umum, true); @endphp
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpForklift->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpForklift->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpForklift->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpForklift->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat', $formKpForklift->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis--}}
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" name="jenis" placeholder="Jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis', $formKpForklift->jenis) }}">
                @error('jenis')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi--}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpForklift->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan--}}
            <div>
                <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan', $formKpForklift->tahun_pembuatan) }}">
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

                {{-- foto lama --}}
                @if($formKpForklift->foto_kecepatan)
                @php $oldFiles = json_decode($formKpForklift->foto_kecepatan, true); @endphp
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
                <div id="foto_kecepatan-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_kecepatan[]"
                    id="foto_kecepatan"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_kecepatan-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_kecepatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Kecepatan Angkat --}}
            <div>
                <label for="kecepatan_angkat" class="block text-sm font-medium text-gray-700">Kecepatan Angkat</label>
                <input type="text" name="kecepatan_angkat" placeholder="Angkat/Lifting" id="kecepatan_angkat"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('kecepatan_angkat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('kecepatan_angkat', $formKpForklift->kecepatan_angkat ?? '') }}">
                @error('kecepatan_angkat')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kecepatan Ungkit --}}
            <div>
                <label for="kecepatan_ungkit" class="block text-sm font-medium text-gray-700">Kecepatan Ungkit</label>
                <input type="text" name="kecepatan_ungkit" placeholder="Ungkit/Tilting" id="kecepatan_ungkit"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('kecepatan_ungkit') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('kecepatan_ungkit', $formKpForklift->kecepatan_ungkit ?? '') }}">
                @error('kecepatan_ungkit')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kecepatan Jalan --}}
            <div>
                <label for="kecepatan_jalan" class="block text-sm font-medium text-gray-700">Kecepatan Jalan</label>
                <input type="text" name="kecepatan_jalan" placeholder="Jalan/Travelling" id="kecepatan_jalan"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('kecepatan_jalan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('kecepatan_jalan', $formKpForklift->kecepatan_jalan ?? '') }}">
                @error('kecepatan_jalan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_radius --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Radius Putaran</h2>
                <label for="foto_radius" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_radius)
                @php $oldFiles = json_decode($formKpForklift->foto_radius, true); @endphp
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
                <div id="foto_radius-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_radius[]"
                    id="foto_radius"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_radius-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_radius') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_radius')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   
            
            {{-- Radius Putaran Kiri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Radius Putaran Kiri</label>
                <input type="text" name="radius_putaran_kiri" placeholder="Kiri Max/Min" id="radius_putaran_kiri"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('radius_putaran_kiri') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ $formKpForklift->radius_putaran_kiri }}">
                @error('radius_putaran_kiri')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Radius Putaran Kanan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Radius Putaran Kanan</label>
                <input type="text" name="radius_putaran_kanan" placeholder="Kanan Max/Min" id="radius_putaran_kanan"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('radius_putaran_kanan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ $formKpForklift->radius_putaran_kanan }}">
                @error('radius_putaran_kanan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Penggerak --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Penggerak</label>
                <input type="text" name="penggerak" placeholder="Penggerak Utama" id="penggerak"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('penggerak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ $formKpForklift->penggerak }}">
                @error('penggerak')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Operator --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Operator</label>
                <input type="text" name="nama_operator" placeholder="Nama Operator" id="nama_operator"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('nama_operator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ $formKpForklift->nama_operator }}">
                @error('nama_operator')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sertifikat Operator SIO --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Sertifikat Operator (SIO)</label>
                <input type="text" name="sertifikat_operator_sio" placeholder="Sertifikat Operator (SIO)" id="sertifikat_operator_sio"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('sertifikat_operator_sio') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ $formKpForklift->sertifikat_operator_sio }}">
                @error('sertifikat_operator_sio')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_dimensi_forklift --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Forklift</h2>
                <label for="foto_dimensi_forklift" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_dimensi_forklift)
                @php $oldFiles = json_decode($formKpForklift->foto_dimensi_forklift, true); @endphp
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
                <div id="foto_dimensi_forklift-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_dimensi_forklift[]"
                    id="foto_dimensi_forklift"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_dimensi_forklift-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_dimensi_forklift')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Panjang Dimensi Forklift --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Panjang Dimensi Forklift</label>
                <input type="text" name="panjang_dimensi_forklift" placeholder="Panjang" id="panjang_dimensi_forklift"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('panjang_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('panjang_dimensi_forklift', $formKpForklift->panjang_dimensi_forklift) }}">
                @error('panjang_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lebar Dimensi Forklift --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lebar Dimensi Forklift</label>
                <input type="text" name="lebar_dimensi_forklift" placeholder="Lebar" id="lebar_dimensi_forklift"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('lebar_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('lebar_dimensi_forklift', $formKpForklift->lebar_dimensi_forklift) }}">
                @error('lebar_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Dimensi Forklift --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi Dimensi Forklift</label>
                <input type="text" name="tinggi_dimensi_forklift" placeholder="Tinggi" id="tinggi_dimensi_forklift"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tinggi_dimensi_forklift') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tinggi_dimensi_forklift', $formKpForklift->tinggi_dimensi_forklift) }}">
                @error('tinggi_dimensi_forklift')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_garpu --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Garpu/Fork</h2>
                <label for="foto_garpu" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_garpu)
                @php $oldFiles = json_decode($formKpForklift->foto_garpu, true); @endphp
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
                <div id="foto_garpu-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_garpu[]"
                    id="foto_garpu"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_garpu-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_garpu')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Tinggi Garpu --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi Garpu</label>
                <input type="text" name="tinggi_garpu" placeholder="Tinggi" id="tinggi_garpu"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tinggi_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tinggi_garpu', $formKpForklift->tinggi_garpu) }}">
                @error('tinggi_garpu')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lebar Garpu --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lebar Garpu</label>
                <input type="text" name="lebar_garpu" placeholder="Lebar" id="lebar_garpu"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('lebar_garpu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('lebar_garpu', $formKpForklift->lebar_garpu) }}">
                @error('lebar_garpu')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-3 gap-3">
                {{-- Tebal Garpu 1 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tebal Garpu 1</label>
                    <input type="text" name="tebal_garpu1" placeholder="Tebal 1" id="tebal_garpu1"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tebal_garpu1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu1', $formKpForklift->tebal_garpu1) }}">
                    @error('tebal_garpu1')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tebal Garpu 2 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tebal Garpu 2</label>
                    <input type="text" name="tebal_garpu2" placeholder="Tebal 2" id="tebal_garpu2"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tebal_garpu2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu2', $formKpForklift->tebal_garpu2) }}">
                    @error('tebal_garpu2')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tebal Garpu 3 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tebal Garpu 3</label>
                    <input type="text" name="tebal_garpu3" placeholder="Tebal 3" id="tebal_garpu3"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                        @error('tebal_garpu3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                        value="{{ old('tebal_garpu3', $formKpForklift->tebal_garpu3) }}">
                    @error('tebal_garpu3')
                        <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- foto_pagar --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pagar/Back Rest</h2>
                <label for="foto_pagar" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_pagar)
                @php $oldFiles = json_decode($formKpForklift->foto_pagar, true); @endphp
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
                <div id="foto_pagar-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_pagar[]"
                    id="foto_pagar"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pagar-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pagar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Tinggi Pagar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi Pagar</label>
                <input type="text" name="tinggi_pagar" placeholder="Tinggi" id="tinggi_pagar"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tinggi_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tinggi_pagar', $formKpForklift->tinggi_pagar) }}">
                @error('tinggi_pagar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lebar Pagar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lebar Pagar</label>
                <input type="text" name="lebar_pagar" placeholder="Lebar" id="lebar_pagar"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('lebar_pagar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('lebar_pagar', $formKpForklift->lebar_pagar) }}">
                @error('lebar_pagar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_mast --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Mast</h2>
                <label for="foto_mast" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_mast)
                @php $oldFiles = json_decode($formKpForklift->foto_mast, true); @endphp
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
                <div id="foto_mast-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_mast[]"
                    id="foto_mast"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_mast-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_mast')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Tinggi Mast --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi Mast</label>
                <input type="text" name="tinggi_mast" placeholder="Tinggi" id="tinggi_mast"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tinggi_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tinggi_mast', $formKpForklift->tinggi_mast) }}">
                @error('tinggi_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lebar Mast --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lebar Mast</label>
                <input type="text" name="lebar_mast" placeholder="Lebar" id="lebar_mast"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('lebar_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('lebar_mast', $formKpForklift->lebar_mast) }}">
                @error('lebar_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tebal Mast --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tebal Mast</label>
                <input type="text" name="tebal_mast" placeholder="Tebal" id="tebal_mast"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tebal_mast') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tebal_mast', $formKpForklift->tebal_mast) }}">
                @error('tebal_mast')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_torak --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Torak/Hidrolik</h2>
                <label for="foto_torak" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_torak)
                @php $oldFiles = json_decode($formKpForklift->foto_torak, true); @endphp
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
                <div id="foto_torak-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_torak[]"
                    id="foto_torak"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_torak-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_torak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_torak')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Torak Dalam --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Torak Dalam</label>
                <input type="text" name="torak_dalam" placeholder="Torak Dalam" id="torak_dalam"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('torak_dalam') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('torak_dalam', $formKpForklift->torak_dalam) }}">
                @error('torak_dalam')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Torak Luar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Torak Luar</label>
                <input type="text" name="torak_luar" placeholder="Torak Luar" id="torak_luar"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('torak_luar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('torak_luar', $formKpForklift->torak_luar) }}">
                @error('torak_luar')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Torak --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi Torak</label>
                <input type="text" name="tinggi_torak" placeholder="Tinggi Torak" id="tinggi_torak"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('tinggi_torak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tinggi_torak', $formKpForklift->tinggi_torak) }}">
                @error('tinggi_torak')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_jarak_antarroda --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Jarak Antar Roda</h2>
                <label for="foto_jarak_antarroda" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_jarak_antarroda)
                @php $oldFiles = json_decode($formKpForklift->foto_jarak_antarroda, true); @endphp
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
                <div id="foto_jarak_antarroda-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_jarak_antarroda[]"
                    id="foto_jarak_antarroda"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_jarak_antarroda-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_jarak_antarroda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_jarak_antarroda')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Jarak Roda Depan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jarak Roda Depan</label>
                <input type="text" name="jarak_roda_depan" placeholder="Bagian Depan" id="jarak_roda_depan"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('jarak_roda_depan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('jarak_roda_depan', $formKpForklift->jarak_roda_depan) }}">
                @error('jarak_roda_depan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jarak Roda Belakang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jarak Roda Belakang</label>
                <input type="text" name="jarak_roda_belakang" placeholder="Bagian Belakang" id="jarak_roda_belakang"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('jarak_roda_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('jarak_roda_belakang', $formKpForklift->jarak_roda_belakang) }}">
                @error('jarak_roda_belakang')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jarak As Roda Depan - Belakang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jarak As Roda Depan - Belakang</label>
                <input type="text" name="jarak_as_roda_depan_belakang" placeholder="Jarak As Roda Depan-Belakang" id="jarak_as_roda_depan_belakang"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                    @error('jarak_as_roda_depan_belakang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('jarak_as_roda_depan_belakang', $formKpForklift->jarak_as_roda_depan_belakang) }}">
                @error('jarak_as_roda_depan_belakang')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_load_test --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
                <label for="foto_load_test" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpForklift->foto_load_test)
                @php $oldFiles = json_decode($formKpForklift->foto_load_test, true); @endphp
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
                <div id="foto_load_test-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_load_test[]"
                    id="foto_load_test"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_load_test-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_load_test') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_load_test')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Pengujian --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">

                    {{-- Label Kolom --}}
                    @php
                        $labels = [
                            'Swl Tinggi Angkat',
                            'Beban Uji Load Chard',
                            'Travelling/ Kecepatan',
                            'Gerakan (mm)',
                            'Hasil',
                            'Keterangan'
                        ];

                        $rows = [1,2,3];

                        $fields = [
                            'tinggi_angkat_hook',
                            'beban_uji_load',
                            'travelling_kecepatan',
                            'gerakan',
                            'hasil',
                            'keterangan'
                        ];
                    @endphp

                    @foreach ($labels as $label)
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">{{ $label }}</label>
                        </div>
                    @endforeach

                    {{-- Baris Input --}}
                    @foreach ($rows as $row)
                        @foreach ($fields as $field)

                            @php
                                $type = $field === 'keterangan' ? 'text' : 'number';
                                $step = $type === 'number' ? 'step=any' : '';
                                $name = $field . $row;
                                $value = $formKpForklift->$name ?? '';
                            @endphp

                            <div>
                                <input type="{{ $type }}" {{ $step }}
                                    name="{{ $name }}" id="{{ $name }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                                    focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                    @error($name) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                    value="{{ old($name, $value) }}">

                                @error($name)
                                    <div class="text-xs text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                        @endforeach
                    @endforeach

                </div>
            </div>
        
            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpForklift->catatan) }}</textarea>
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