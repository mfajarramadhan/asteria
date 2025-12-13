<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.listrik.instalasi_penyalur_petir.update', $formKpInstalasiPenyalurPetir->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                                value="{{ old('tanggal_pemeriksaan', optional($formKpInstalasiPenyalurPetir->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                @if($formKpInstalasiPenyalurPetir->foto_informasi_umum)
                @php $oldFiles = json_decode($formKpInstalasiPenyalurPetir->foto_informasi_umum, true); @endphp
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiPenyalurPetir->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiPenyalurPetir->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiPenyalurPetir->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpInstalasiPenyalurPetir->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat', $formKpInstalasiPenyalurPetir->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis--}}
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" name="jenis" placeholder="Jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis', $formKpInstalasiPenyalurPetir->jenis) }}">
                @error('jenis')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi--}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpInstalasiPenyalurPetir->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan--}}
            <div>
                <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan', $formKpInstalasiPenyalurPetir->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Air Terminal 1 --}}
            <div>
                <label for="air_terminal1" class="block text-sm font-medium text-gray-700">Air Terminal</label>
                <input type="text" name="air_terminal1" placeholder="Air Terminal" id="air_terminal1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('air_terminal1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('air_terminal1', $formKpInstalasiPenyalurPetir->air_terminal1) }}">
                @error('air_terminal1')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Air Terminal 2 --}}
            <div>
                <label for="air_terminal2" class="block text-sm font-medium text-gray-700">Jenis Air Terminal</label>
                <input type="text" name="air_terminal2" placeholder="Jenis Air Terminal" id="air_terminal2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('air_terminal2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('air_terminal2', $formKpInstalasiPenyalurPetir->air_terminal2) }}">
                @error('air_terminal2')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jarak Radius Proteksi --}}
            <div>
                <label for="jarak_radius_proteksi" class="block text-sm font-medium text-gray-700">Jarak / Radius Proteksi</label>
                <input type="text" name="jarak_radius_proteksi" placeholder="Jarak/Radius Proteksi" id="jarak_radius_proteksi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_radius_proteksi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_radius_proteksi', $formKpInstalasiPenyalurPetir->jarak_radius_proteksi) }}">
                @error('jarak_radius_proteksi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tinggi Tiang --}}
            <div>
                <label for="tinggi_tiang" class="block text-sm font-medium text-gray-700">Tinggi Tiang</label>
                <input type="text" name="tinggi_tiang" placeholder="Tinggi Tiang" id="tinggi_tiang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_tiang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_tiang', $formKpInstalasiPenyalurPetir->tinggi_tiang) }}">
                @error('tinggi_tiang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jumlah dan Jarak --}}
            <div>
                <label for="jumlah_dan_jarak" class="block text-sm font-medium text-gray-700">Jumlah dan Jarak</label>
                <input type="text" name="jumlah_dan_jarak" placeholder="Jumlah dan Jarak" id="jumlah_dan_jarak" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_dan_jarak') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jumlah_dan_jarak', $formKpInstalasiPenyalurPetir->jumlah_dan_jarak) }}">
                @error('jumlah_dan_jarak')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Keadaan Visual Air --}}
            <div>
                <label for="keadaan_visual_air" class="block text-sm font-medium text-gray-700">Keadaan Visual Air</label>
                <input type="text" name="keadaan_visual_air" placeholder="Keadaan Visual Air" id="keadaan_visual_air" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keadaan_visual_air') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('keadaan_visual_air', $formKpInstalasiPenyalurPetir->keadaan_visual_air) }}">
                @error('keadaan_visual_air')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Down Conductor --}}
            <div>
                <label for="down_conductor" class="block text-sm font-medium text-gray-700">Down Conductor</label>
                <input type="text" name="down_conductor" placeholder="Down Conductor" id="down_conductor" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('down_conductor') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('down_conductor', $formKpInstalasiPenyalurPetir->down_conductor) }}">
                @error('down_conductor')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jumlah Down Conductor --}}
            <div>
                <label for="jumlah_down_conductor" class="block text-sm font-medium text-gray-700">Jumlah Down Conductor</label>
                <input type="text" name="jumlah_down_conductor" placeholder="Jumlah Down Conductor" id="jumlah_down_conductor" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_down_conductor') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jumlah_down_conductor', $formKpInstalasiPenyalurPetir->jumlah_down_conductor) }}">
                @error('jumlah_down_conductor')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jarak Antar Kaki Penerima --}}
            <div>
                <label for="jarak_antar_kaki_penerima" class="block text-sm font-medium text-gray-700">Jarak Antar Kaki Penerima</label>
                <input type="text" name="jarak_antar_kaki_penerima" placeholder="Jarak Antar Kaki Penerima" id="jarak_antar_kaki_penerima" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_antar_kaki_penerima') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_antar_kaki_penerima', $formKpInstalasiPenyalurPetir->jarak_antar_kaki_penerima) }}">
                @error('jarak_antar_kaki_penerima')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Titik Percabangan --}}
            <div>
                <label for="titik_percabangan" class="block text-sm font-medium text-gray-700">Titik Percabangan</label>
                <input type="text" name="titik_percabangan" placeholder="Titik Percabangan" id="titik_percabangan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('titik_percabangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('titik_percabangan', $formKpInstalasiPenyalurPetir->titik_percabangan) }}">
                @error('titik_percabangan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Luas Penampang --}}
            <div>
                <label for="luas_penampang" class="block text-sm font-medium text-gray-700">Luas Penampang</label>
                <input type="text" name="luas_penampang" placeholder="Luas Penampang" id="luas_penampang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('luas_penampang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('luas_penampang', $formKpInstalasiPenyalurPetir->luas_penampang) }}">
                @error('luas_penampang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Tebal Penampang --}}
            <div>
                <label for="tebal_penampang" class="block text-sm font-medium text-gray-700">Tebal Penampang</label>
                <input type="text" name="tebal_penampang" placeholder="Tebal Penampang" id="tebal_penampang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_penampang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_penampang', $formKpInstalasiPenyalurPetir->tebal_penampang) }}">
                @error('tebal_penampang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Jarak Antar Penghantar --}}
            <div>
                <label for="jarak_antar_penghantar" class="block text-sm font-medium text-gray-700">Jarak Antar Penghantar</label>
                <input type="text" name="jarak_antar_penghantar" placeholder="Jarak Antar Penghantar" id="jarak_antar_penghantar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_antar_penghantar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_antar_penghantar', $formKpInstalasiPenyalurPetir->jarak_antar_penghantar) }}">
                @error('jarak_antar_penghantar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Jenis Penghantar --}}
            <div>
                <label for="jenis_penghantar" class="block text-sm font-medium text-gray-700">Jenis Penghantar</label>
                <input type="text" name="jenis_penghantar" placeholder="Jenis Penghantar" id="jenis_penghantar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_penghantar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_penghantar', $formKpInstalasiPenyalurPetir->jenis_penghantar) }}">
                @error('jenis_penghantar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Tinggi Bangunan --}}
            <div>
                <label for="tinggi_bangunan" class="block text-sm font-medium text-gray-700">Tinggi Bangunan</label>
                <input type="text" name="tinggi_bangunan" placeholder="Tinggi Bangunan" id="tinggi_bangunan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_bangunan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_bangunan', $formKpInstalasiPenyalurPetir->tinggi_bangunan) }}">
                @error('tinggi_bangunan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Luas Bangunan --}}
            <div>
                <label for="luas_bangunan" class="block text-sm font-medium text-gray-700">Luas Bangunan</label>
                <input type="text" name="luas_bangunan" placeholder="Luas Bangunan" id="luas_bangunan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('luas_bangunan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('luas_bangunan', $formKpInstalasiPenyalurPetir->luas_bangunan) }}">
                @error('luas_bangunan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Earth Electrode --}}
            <div>
                <label for="earth_electrode" class="block text-sm font-medium text-gray-700">Earth Electrode</label>
                <input type="text" name="earth_electrode" placeholder="Earth Electrode" id="earth_electrode" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('earth_electrode') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('earth_electrode', $formKpInstalasiPenyalurPetir->earth_electrode) }}">
                @error('earth_electrode')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Batang Pita Mesh --}}
            <div>
                <label for="batang_pita_mesh" class="block text-sm font-medium text-gray-700">(Batang/Rod, Pita, Mesh)</label>
                <input type="text" name="batang_pita_mesh" placeholder="(Batang/Rod, Pita, Mesh)" id="batang_pita_mesh" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('batang_pita_mesh') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('batang_pita_mesh', $formKpInstalasiPenyalurPetir->batang_pita_mesh) }}">
                @error('batang_pita_mesh')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Diameter Penampang --}}
            <div>
                <label for="diameter_penampang" class="block text-sm font-medium text-gray-700">Diameter Penampang</label>
                <input type="text" name="diameter_penampang" placeholder="Diameter Penampang" id="diameter_penampang" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('diameter_penampang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('diameter_penampang', $formKpInstalasiPenyalurPetir->diameter_penampang) }}">
                @error('diameter_penampang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Kedalaman Elektroda --}}
            <div>
                <label for="kedalaman_elektroda" class="block text-sm font-medium text-gray-700">Kedalaman Elektroda</label>
                <input type="text" name="kedalaman_elektroda" placeholder="Kedalaman Elektroda" id="kedalaman_elektroda" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kedalaman_elektroda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kedalaman_elektroda', $formKpInstalasiPenyalurPetir->kedalaman_elektroda) }}">
                @error('kedalaman_elektroda')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
            </div>

            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpInstalasiPenyalurPetir->catatan) }}</textarea>
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