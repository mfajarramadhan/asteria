<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.papa.wheel_loader.update', $formKpWheelLoader->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                            value="{{ old('tanggal_pemeriksaan', optional($formKpWheelLoader->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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

            {{-- foto_informasi_umum --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
                <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpWheelLoader->foto_informasi_umum)
                @php $oldFiles = json_decode($formKpWheelLoader->foto_informasi_umum, true); @endphp
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpWheelLoader->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpWheelLoader->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpWheelLoader->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpWheelLoader->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpWheelLoader->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            {{-- Jenis--}}
            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" name="jenis" placeholder="Jenis" id="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis', $formKpWheelLoader->jenis) }}">
                @error('jenis')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi--}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpWheelLoader->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan--}}
            <div>
                <label for="tahun_pembuatan" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan', $formKpWheelLoader->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Panjang Keseluruhan --}}
            <div>
                <label for="panjang_keseluruhan" class="block text-sm font-medium text-gray-700">Panjang Keseluruhan</label>
                <input type="number" step="any" name="panjang_keseluruhan" placeholder="Panjang Keseluruhan" id="panjang_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('panjang_keseluruhan', $formKpWheelLoader->panjang_keseluruhan) }}">
                @error('panjang_keseluruhan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Keseluruhan --}}
            <div>
                <label for="tinggi_keseluruhan" class="block text-sm font-medium text-gray-700">Tinggi Keseluruhan</label>
                <input type="number" step="any" name="tinggi_keseluruhan" placeholder="Tinggi Keseluruhan" id="tinggi_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_keseluruhan', $formKpWheelLoader->tinggi_keseluruhan) }}">
                @error('tinggi_keseluruhan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lebar Keseluruhan --}}
            <div>
                <label for="lebar_keseluruhan" class="block text-sm font-medium text-gray-700">Lebar Keseluruhan</label>
                <input type="number" step="any" name="lebar_keseluruhan" placeholder="Lebar Keseluruhan" id="lebar_keseluruhan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lebar_keseluruhan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lebar_keseluruhan', $formKpWheelLoader->lebar_keseluruhan) }}">
                @error('lebar_keseluruhan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jarak Track Roda --}}
            <div>
                <label for="jarak_track_roda" class="block text-sm font-medium text-gray-700">Jarak Track Roda</label>
                <input type="number" step="any" name="jarak_track_roda" placeholder="Jarak Track Roda" id="jarak_track_roda" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_track_roda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_track_roda', $formKpWheelLoader->jarak_track_roda) }}">
                @error('jarak_track_roda')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ukuran Lebar Roda --}}
            <div>
                <label for="ukuran_lebar_roda" class="block text-sm font-medium text-gray-700">Ukuran Lebar Roda</label>
                <input type="number" step="any" name="ukuran_lebar_roda" placeholder="Ukuran Lebar Roda" id="ukuran_lebar_roda" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ukuran_lebar_roda') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('ukuran_lebar_roda', $formKpWheelLoader->ukuran_lebar_roda) }}">
                @error('ukuran_lebar_roda')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kecepatan Maks Travelling --}}
            <div>
                <label for="kecepatan_maks_travelling" class="block text-sm font-medium text-gray-700">Kecepatan Maks Travelling</label>
                <input type="number" step="any" name="kecepatan_maks_travelling" placeholder="Kecepatan Maks Travelling" id="kecepatan_maks_travelling" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_maks_travelling') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_maks_travelling', $formKpWheelLoader->kecepatan_maks_travelling) }}">
                @error('kecepatan_maks_travelling')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kecepatan Mundur --}}
            <div>
                <label for="kecepatan_mundur" class="block text-sm font-medium text-gray-700">Kecepatan Mundur</label>
                <input type="number" step="any" name="kecepatan_mundur" placeholder="Kecepatan Mundur" id="kecepatan_mundur" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_mundur', $formKpWheelLoader->kecepatan_mundur) }}">
                @error('kecepatan_mundur')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Rem --}}
            <div class="grid grid-cols-2 gap-4 pt-4">
                {{-- Left: Label --}}
                <div class="flex items-center">
                    <label class="block text-sm font-medium text-gray-700">
                        Rem
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">

                    {{-- Input 1 --}}
                    <div>
                        <input type="text" name="rem_macam"
                            placeholder="Macam" id="rem_macam"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('rem_macam') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('rem_macam', $formKpWheelLoader->rem_macam) }}">

                        @error('rem_macam')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input 2 --}}
                    <div>
                        <input type="text" name="rem_type"
                            placeholder="Type" id="rem_type"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('rem_type') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('rem_type', $formKpWheelLoader->rem_type) }}">

                        @error('rem_type')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Radius Putaran --}}
            <div class="grid grid-cols-2 gap-4 pt-4">
                {{-- Left: Label --}}
                <div class="flex items-center">
                    <label class="block text-sm font-medium text-gray-700">
                        Radius Putaran
                    </label>
                </div>

                {{-- Right: Input --}}
                <div class="space-y-4">
                    {{-- Input 1 --}}
                    <div>
                        <input type="number" step="any" name="radius_putaran_kiri"
                            placeholder="Macam" id="radius_putaran_kiri"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('radius_putaran_kiri') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('radius_putaran_kiri', $formKpWheelLoader->radius_putaran_kiri) }}">

                        @error('radius_putaran_kiri')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input 2 --}}
                    <div>
                        <input type="number" step="any" name="radius_putaran_kanan"
                            placeholder="Type" id="radius_putaran_kanan"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                            @error('radius_putaran_kanan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('radius_putaran_kanan', $formKpWheelLoader->radius_putaran_kanan) }}">

                        @error('radius_putaran_kanan')
                            <div class="text-xs text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- foto_mesin --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Engine</h2>
                <label for="foto_mesin" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpWheelLoader->foto_mesin)
                @php $oldFiles = json_decode($formKpWheelLoader->foto_mesin, true); @endphp
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

            {{-- Tipe Mesin --}}
            <div>
                <input type="text" name="tipe_mesin" placeholder="Tipe Mesin" id="tipe_mesin"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tipe_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tipe_mesin', $formKpWheelLoader->tipe_mesin) }}">
                @error('tipe_mesin')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nomor Seri --}}
            <div>
                <input type="text" name="nomor_seri" placeholder="Nomor Seri" id="nomor_seri"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nomor_seri') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('nomor_seri', $formKpWheelLoader->nomor_seri) }}">
                @error('nomor_seri')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jumlah Silinder --}}
            <div>
                <input type="number" name="jumlah_silinder" placeholder="Jumlah Silinder" id="jumlah_silinder"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_silinder') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('jumlah_silinder', $formKpWheelLoader->jumlah_silinder) }}">
                @error('jumlah_silinder')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Daya Bersih --}}
            <div>
                <input type="number" step="any" name="daya_bersih" placeholder="Daya Bersih" id="daya_bersih"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('daya_bersih') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('daya_bersih', $formKpWheelLoader->daya_bersih) }}">
                @error('daya_bersih')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Merek --}}
            <div>
                <input type="text" name="merek" placeholder="Merek" id="merek"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('merek') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('merek', $formKpWheelLoader->merek) }}">
                @error('merek')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tahun Pembuatan --}}
            <div>
                <input type="text" name="tahun_pembuatan_mesin" placeholder="Tahun Pembuatan" id="tahun_pembuatan_mesin"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('tahun_pembuatan_mesin', $formKpWheelLoader->tahun_pembuatan_mesin) }}">
                @error('tahun_pembuatan_mesin')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pabrik Pembuat Mesin --}}
            <div>
                <input type="text" name="pabrik_pembuat_mesin" placeholder="Pabrik Pembuat Mesin"
                    id="pabrik_pembuat_mesin"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('pabrik_pembuat_mesin', $formKpWheelLoader->pabrik_pembuat_mesin) }}">
                @error('pabrik_pembuat_mesin')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- foto_pompa_hydraulik --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pompa Hydraulik</h2>
                <label for="foto_pompa_hydraulik" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpWheelLoader->foto_pompa_hydraulik)
                @php $oldFiles = json_decode($formKpWheelLoader->foto_pompa_hydraulik, true); @endphp
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
                <div id="foto_pompa_hydraulik-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_pompa_hydraulik[]"
                    id="foto_pompa_hydraulik"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pompa_hydraulik-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pompa_hydraulik') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pompa_hydraulik')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>   

            {{-- Pompa Hydraulik Type --}}
            <div>
                <input type="text" name="pompa_hydraulik_type" placeholder="Type" id="pompa_hydraulik_type"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pompa_hydraulik_type') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('pompa_hydraulik_type', $formKpWheelLoader->pompa_hydraulik_type) }}">
                @error('pompa_hydraulik_type')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pompa Hydraulik Tekanan --}}
            <div>
                <input type="text" name="pompa_hydraulik_tekanan" placeholder="Tekanan" id="pompa_hydraulik_tekanan"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pompa_hydraulik_tekanan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                    value="{{ old('pompa_hydraulik_tekanan', $formKpWheelLoader->pompa_hydraulik_tekanan) }}">
                @error('pompa_hydraulik_tekanan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- foto_pengujian --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pengujian</h2>
                <label for="foto_pengujian" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpWheelLoader->foto_pengujian)
                @php $oldFiles = json_decode($formKpWheelLoader->foto_pengujian, true); @endphp
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

            {{-- Pengujian --}}
                <div class="w-full py-2 overflow-x-auto">
                    <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">
                        {{-- Baris 1 --}}
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Fungsi</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Kecepatan</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Gerakan (mm)</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Beban</label>
                        </div>

                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Hasil</label>
                        </div>
                        
                        <div class="text-center">
                            <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                        </div>

                        {{-- Baris 2 --}}
                        <div class="text-left">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Travelling</label>
                        </div>

                        <div>
                            <input type="text" name="fungsi_travelling_kecepatan" id="fungsi_travelling_kecepatan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('fungsi_travelling_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('fungsi_travelling_kecepatan', $formKpWheelLoader->fungsi_travelling_kecepatan) }}">
                            @error('fungsi_travelling_kecepatan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex gap-1">
                            <input type="text" name="travelling_gerakan_maju" id="travelling_gerakan_maju" placeholder="Maju"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('travelling_gerakan_maju') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('travelling_gerakan_maju', $formKpWheelLoader->travelling_gerakan_maju) }}">
                            @error('travelling_gerakan_maju') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

                            <input type="text" name="travelling_gerakan_mundur" id="travelling_gerakan_mundur" placeholder="Mundur"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('travelling_gerakan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('travelling_gerakan_mundur', $formKpWheelLoader->travelling_gerakan_mundur) }}">
                            @error('travelling_gerakan_mundur') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="travelling_beban" id="travelling_beban"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('travelling_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('travelling_beban', $formKpWheelLoader->travelling_beban) }}">
                            @error('travelling_beban') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="travelling_hasil" id="travelling_hasil"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('travelling_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('travelling_hasil', $formKpWheelLoader->travelling_hasil) }}">
                            @error('travelling_hasil') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="travelling_keterangan" id="travelling_keterangan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('travelling_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('travelling_keterangan', $formKpWheelLoader->travelling_keterangan) }}">
                            @error('travelling_keterangan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>


                        {{-- Baris 3 --}}
                        <div class="text-left">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Belok</label>
                        </div>

                        <div>
                            <input type="text" name="fungsi_belok_kecepatan" id="fungsi_belok_kecepatan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('fungsi_belok_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('fungsi_belok_kecepatan', $formKpWheelLoader->fungsi_belok_kecepatan) }}">
                            @error('fungsi_belok_kecepatan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex gap-1">
                            <input type="text" name="belok_gerakan_maju" id="belok_gerakan_maju" placeholder="Maju"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('belok_gerakan_maju') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('belok_gerakan_maju', $formKpWheelLoader->belok_gerakan_maju) }}">
                            @error('belok_gerakan_maju') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

                            <input type="text" name="belok_gerakan_mundur" id="belok_gerakan_mundur" placeholder="Mundur"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('belok_gerakan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('belok_gerakan_mundur', $formKpWheelLoader->belok_gerakan_mundur) }}">
                            @error('belok_gerakan_mundur') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="belok_beban" id="belok_beban"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('belok_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('belok_beban', $formKpWheelLoader->belok_beban) }}">
                            @error('belok_beban') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="belok_hasil" id="belok_hasil"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('belok_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('belok_hasil', $formKpWheelLoader->belok_hasil) }}">
                            @error('belok_hasil') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="belok_keterangan" id="belok_keterangan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('belok_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('belok_keterangan', $formKpWheelLoader->belok_keterangan) }}">
                            @error('belok_keterangan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 4 --}}
                        <div class="text-left">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Lengan (boom)</label>
                        </div>

                        <div>
                            <input type="text" name="fungsi_lengan_kecepatan" id="fungsi_lengan_kecepatan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('fungsi_lengan_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('fungsi_lengan_kecepatan', $formKpWheelLoader->fungsi_lengan_kecepatan) }}">
                            @error('fungsi_lengan_kecepatan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex gap-1">
                            <input type="text" name="lengan_gerakan_maju" id="lengan_gerakan_maju" placeholder="Maju"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('lengan_gerakan_maju') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('lengan_gerakan_maju', $formKpWheelLoader->lengan_gerakan_maju) }}">
                            @error('lengan_gerakan_maju') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

                            <input type="text" name="lengan_gerakan_mundur" id="lengan_gerakan_mundur" placeholder="Mundur"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('lengan_gerakan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('lengan_gerakan_mundur', $formKpWheelLoader->lengan_gerakan_mundur) }}">
                            @error('lengan_gerakan_mundur') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="lengan_beban" id="lengan_beban"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('lengan_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('lengan_beban', $formKpWheelLoader->lengan_beban) }}">
                            @error('lengan_beban') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="lengan_hasil" id="lengan_hasil"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('lengan_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('lengan_hasil', $formKpWheelLoader->lengan_hasil) }}">
                            @error('lengan_hasil') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="lengan_keterangan" id="lengan_keterangan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('lengan_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('lengan_keterangan', $formKpWheelLoader->lengan_keterangan) }}">
                            @error('lengan_keterangan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 5 --}}
                        <div class="text-left">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Bak (bucket)</label>
                        </div>

                        <div>
                            <input type="text" name="fungsi_bucket_kecepatan" id="fungsi_bucket_kecepatan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('fungsi_bucket_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('fungsi_bucket_kecepatan', $formKpWheelLoader->fungsi_bucket_kecepatan) }}">
                            @error('fungsi_bucket_kecepatan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex gap-1">
                            <input type="text" name="bucket_gerakan_maju" id="bucket_gerakan_maju" placeholder="Maju"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bucket_gerakan_maju') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bucket_gerakan_maju', $formKpWheelLoader->bucket_gerakan_maju) }}">
                            @error('bucket_gerakan_maju') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

                            <input type="text" name="bucket_gerakan_mundur" id="bucket_gerakan_mundur" placeholder="Mundur"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bucket_gerakan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bucket_gerakan_mundur', $formKpWheelLoader->bucket_gerakan_mundur) }}">
                            @error('bucket_gerakan_mundur') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="bucket_beban" id="bucket_beban"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bucket_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bucket_beban', $formKpWheelLoader->bucket_beban) }}">
                            @error('bucket_beban') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="bucket_hasil" id="bucket_hasil"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bucket_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bucket_hasil', $formKpWheelLoader->bucket_hasil) }}">
                            @error('bucket_hasil') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="bucket_keterangan" id="bucket_keterangan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('bucket_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('bucket_keterangan', $formKpWheelLoader->bucket_keterangan) }}">
                            @error('bucket_keterangan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris 6 --}}
                        <div class="text-left">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Gerakan Mengangkut (loading)</label>
                        </div>

                        <div>
                            <input type="text" name="fungsi_loading_kecepatan" id="fungsi_loading_kecepatan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('fungsi_loading_kecepatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('fungsi_loading_kecepatan', $formKpWheelLoader->fungsi_loading_kecepatan) }}">
                            @error('fungsi_loading_kecepatan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex gap-1">
                            <input type="text" name="loading_gerakan_maju" id="loading_gerakan_maju" placeholder="Maju"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('loading_gerakan_maju') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('loading_gerakan_maju', $formKpWheelLoader->loading_gerakan_maju) }}">
                            @error('loading_gerakan_maju') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

                            <input type="text" name="loading_gerakan_mundur" id="loading_gerakan_mundur" placeholder="Mundur"
                                class="block w-full text-center px-2 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('loading_gerakan_mundur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('loading_gerakan_mundur', $formKpWheelLoader->loading_gerakan_mundur) }}">
                            @error('loading_gerakan_mundur') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="loading_beban" id="loading_beban"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('loading_beban') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('loading_beban', $formKpWheelLoader->loading_beban) }}">
                            @error('loading_beban') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="loading_hasil" id="loading_hasil"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('loading_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('loading_hasil', $formKpWheelLoader->loading_hasil) }}">
                            @error('loading_hasil') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input type="text" name="loading_keterangan" id="loading_keterangan"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                @error('loading_keterangan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                                value="{{ old('loading_keterangan', $formKpWheelLoader->loading_keterangan) }}">
                            @error('loading_keterangan') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpWheelLoader->catatan) }}</textarea>
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