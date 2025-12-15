<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.eskalator.elevator.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
            @csrf

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                {{-- Tanggal Pemeriksaan 1 --}}
                <div class="w-full md:w-[50%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tanggal_pemeriksaan') }}">
                    </div>
                    @error('tanggal_pemeriksaan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            {{-- Foto Informasi Umum --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Foto (Opsional)</h2>
                <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_informasi_umum[]" id="foto_informasi_umum" accept="image/*" multiple onchange="previewImage(this, 'foto_informasi_umum-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_informasi_umum') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

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
                <label class="block text-sm font-medium text-gray-700">Kapasitas Angkut</label>
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
                <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat') }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis Elevator --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Elevator</label>
                <input type="text" name="jenis_elevator" placeholder="Jenis Elevator" id="jenis_elevator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_elevator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_elevator') }}">
                @error('jenis_elevator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi Elevator --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi_elevator" placeholder="Lokasi Elevator" id="lokasi_elevator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi_elevator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi_elevator') }}">
                @error('lokasi_elevator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan') }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Asal Negara Pembuat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Asal Negara Pembuat</label>
                <input type="text" name="negara_tahun_pembuat" placeholder="Asal Negara Pembuat" id="negara_tahun_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('negara_tahun_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('negara_tahun_pembuat') }}">
                @error('negara_tahun_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jumlah Lantai Pemberhentian --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Lantai Pemberhentian</label>
                <input type="text" name="jumlah_lantai_pemberhentian" placeholder="Jumlah Lantai Pemberhentian" id="jumlah_lantai_pemberhentian" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_lantai_pemberhentian') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jumlah_lantai_pemberhentian') }}">
                @error('jumlah_lantai_pemberhentian')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kecepatan Elevator --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kecepatan Elevator</label>
                <input type="text" name="kecepatan_elevator" placeholder="Kecepatan Elevator" id="kecepatan_elevator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecepatan_elevator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kecepatan_elevator') }}">
                @error('kecepatan_elevator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Foto Mesin --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">A. Mesin</h2>
                <div id="foto_mesin-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_mesin[]" id="foto_mesin" accept="image/*" multiple onchange="previewImage(this, 'foto_mesin-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_mesin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_mesin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'dudukan_mesin' => ['label' => 'Dudukan Mesin', 'desc' => 'Pastikan dudukan mesin terpasang kokoh dan tidak mengalami getaran berlebih.'],
                        'rem_mekanik' => ['label' => 'Rem Mekanik', 'desc' => 'Periksa fungsi rem mekanik agar dapat menghentikan mesin dengan aman.'],
                        'rem_electric' => ['label' => 'Rem Electric (Brake Switch)', 'desc' => 'Uji sistem rem elektrik berfungsi dengan baik saat tombol darurat ditekan.'],
                        'konstruksi_kamar' => ['label' => 'Konstruksi Kamar Mesin', 'desc' => 'Pastikan struktur kamar mesin kokoh, bebas korosi, dan sesuai desain teknis.'],
                        'ruang_bebas_kamar' => ['label' => 'Ruang Bebas Kamar Mesin', 'desc' => 'Pastikan ruang di sekitar mesin cukup untuk perawatan dan pergerakan teknisi.'],
                        'penerangan_kamar_mesin' => ['label' => 'Penerangan Kamar Mesin', 'desc' => 'Pastikan pencahayaan di kamar mesin cukup terang untuk inspeksi.'],
                        'ventilasi_pendingin' => ['label' => 'Ventilasi/Pendingin Ruangan', 'desc' => 'Periksa sistem ventilasi atau pendingin agar suhu mesin tetap stabil.'],
                        'pintu_kamar_mesin' => ['label' => 'Pintu Kamar Mesin', 'desc' => 'Pastikan pintu kamar mesin mudah diakses dan terkunci dengan aman.'],
                        'posisi_panel' => ['label' => 'Posisi Panel Hubung Bagi Listrik', 'desc' => 'Panel listrik harus terletak di tempat yang mudah dijangkau dan terlindung.'],
                        'alat_pelindung' => ['label' => 'Alat Pelindung Benda Berputar', 'desc' => 'Pastikan semua bagian berputar dilengkapi pelindung untuk menghindari cedera.'],
                        'pelindung_lubang_talibaja' => ['label' => 'Pelindung Lubang Tali Baja/Sabuk Penggantung', 'desc' => 'Pastikan lubang tali baja memiliki pelindung yang aman dari benda asing.'],
                        'tangga_kamar_mesin' => ['label' => 'Tangga Menuju Kamar Mesin', 'desc' => 'Tangga menuju kamar mesin harus kokoh dan memiliki pegangan yang aman.'],
                        'perbedaan_ketinggian' => ['label' => 'Terdapat Perbedaan Ketinggian Lantai Di Kamar Mesin > 500 mm', 'desc' => 'Periksa dan beri tanda pada area kamar mesin yang memiliki perbedaan lantai signifikan.'],
                        'alat_pemadam_ringan' => ['label' => 'Tersedia Alat Pemadam Api Ringan', 'desc' => 'Pastikan tersedia APAR dalam kondisi baik di sekitar kamar mesin.'],
                        'elevator_tanpa_kamar' => ['label' => 'Elevator Yang Tidak Memiliki Kamar Mesin (Roomless)', 'desc' => 'Periksa komponen utama elevator roomless terpasang dengan aman sesuai standar.'],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>

                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tali Sabuk Penggantung --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">B. Tali/Sabuk Penggantung</h2>
                <div id="foto_tali_penggantung-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_tali_penggantung[]" id="foto_tali_penggantung" accept="image/*" multiple onchange="previewImage(this, 'foto_tali_penggantung-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_tali_penggantung') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_tali_penggantung')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'tali_sabuk1' => [
                        'label' => 'Tali/Sabuk Penggantung 1',
                        'desc' => 'Periksa kondisi tali atau sabuk penggantung pertama agar tidak terdapat keretakan, keausan, atau karat.'
                        ],
                        'tali_sabuk2' => [
                        'label' => 'Tali/Sabuk Penggantung 2',
                        'desc' => 'Pastikan tali atau sabuk penggantung kedua dalam kondisi baik dan memiliki tegangan seimbang.'
                        ],
                        'nilai_faktor_keamanan' => [
                        'label' => 'Nilai Faktor Keamanan Tali/Sabuk Penggantung',
                        'desc' => 'Pastikan nilai faktor keamanan sesuai standar pabrikan dan hasil uji terbaru.'
                        ],
                        'tali_penggantung_bobot_imbang' => [
                        'label' => 'Tali Penggantung Kereta Jenis Tali Dengan Bobot Imbang',
                        'desc' => 'Periksa kesesuaian tegangan pada tali penggantung agar beban seimbang antara kereta dan counterweight.'
                        ],
                        'tali_penggantung_tanpa_bobot' => [
                        'label' => 'Tali Penggantung Kereta Tanpa Bobot Imbang',
                        'desc' => 'Pastikan sistem penyeimbang bekerja dengan baik meskipun tanpa bobot imbang.'
                        ],
                        'sabuk' => [
                        'label' => 'Sabuk',
                        'desc' => 'Pastikan sabuk tidak aus, retak, atau melar dan sesuai dengan kapasitas beban elevator.'
                        ],
                        'pengaman_tanpa_bobot' => [
                        'label' => 'Alat Pengaman Pada Elevator Tanpa Bobot Imbang Apabila Alat Penggantung Kereta Penarik Menjadi Kendur',
                        'desc' => 'Pastikan alat pengaman aktif bekerja otomatis ketika tali atau sabuk penggantung mengendur.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>

                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Teromol --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">C. Teromol</h2>
                <div id="foto_teromol-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_teromol[]" id="foto_teromol" accept="image/*" multiple onchange="previewImage(this, 'foto_teromol-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_teromol') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_teromol')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'alur_teromol' => [
                        'label' => 'Alur Teromol',
                        'desc' => 'Pastikan alur teromol bersih, tidak aus, dan mampu menjaga posisi tali tetap stabil saat beroperasi.'
                        ],
                        'diameter_teromol_penumpang' => [
                        'label' => 'Diameter Teromol Penumpang',
                        'desc' => 'Ukur diameter teromol penumpang dan pastikan sesuai standar agar gaya gesek dan kecepatan tetap aman.'
                        ],
                        'diameter_teromol_governor' => [
                        'label' => 'Diameter Teromol Governor',
                        'desc' => 'Periksa diameter teromol governor untuk memastikan sensor kecepatan dan sistem pengaman bekerja optimal.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Bangunan Ruang Luncur, Ruang Atas dan Lekuk Dasar --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">D. Bangunan Ruang Luncur, Ruang Atas dan Lekuk Dasar</h2>
                <div id="foto_bangun_ruang_luncur-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_bangun_ruang_luncur[]" id="foto_bangun_ruang_luncur" accept="image/*" multiple onchange="previewImage(this, 'foto_bangun_ruang_luncur-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_bangun_ruang_luncur') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_bangun_ruang_luncur')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'konstruksi_ruangLuncur' => [
                        'label' => 'Konstruksi Ruang Luncur, Ruang Atas, dan Lekuk Dasar',
                        'desc' => 'Pastikan struktur ruang luncur, ruang atas, dan lekuk dasar sesuai standar kekuatan dan keamanan.'
                        ],
                        'dinding_ruangLuncur' => [
                        'label' => 'Dinding Ruang Luncur, Ruang Atas dan Lekuk Dasar (Elevator panorama)',
                        'desc' => 'Periksa kondisi dan ketebalan dinding, terutama untuk elevator panorama.'
                        ],
                        'landasan_jalur' => [
                        'label' => 'Landasan Jalur Kereta/Elevator Miring',
                        'desc' => 'Pastikan landasan jalur kuat, sejajar, dan bebas dari deformasi.'
                        ],
                        'penerangan_ruangLuncur' => [
                        'label' => 'Penerangan Ruang Luncur, Ruang Atas, dan Lekuk Dasar',
                        'desc' => 'Pastikan sistem penerangan mencukupi seluruh area ruang luncur dan ruang atas.'
                        ],
                        'pintu_darurat' => [
                        'label' => 'Pintu Darurat (Non Stop)',
                        'desc' => 'Pastikan pintu darurat mudah diakses dan berfungsi baik.'
                        ],
                        'ukuran_pintu_darurat' => [
                        'label' => 'Ukuran Pintu Darurat',
                        'desc' => 'Pastikan ukuran pintu sesuai standar untuk evakuasi aman.'
                        ],
                        'saklar_pengaman_pintu' => [
                        'label' => 'Saklar Pengaman Pintu Darurat',
                        'desc' => 'Pastikan saklar pengaman berfungsi untuk memutus daya jika pintu terbuka.'
                        ],
                        'jembatan_bantu' => [
                        'label' => 'Jembatan Bantu Dari Pintu Darurat',
                        'desc' => 'Periksa keberadaan dan kekokohan jembatan bantu untuk akses darurat.'
                        ],
                        'ruangBebas_atasSangkar' => [
                        'label' => 'Ruang Bebas Di Atas Sangkar',
                        'desc' => 'Pastikan ruang bebas di atas sangkar mencukupi untuk perawatan.'
                        ],
                        'ruangBebas_lekukDasar' => [
                        'label' => 'Ruang Bebas Lekuk Dasar',
                        'desc' => 'Pastikan ruang di lekuk dasar bebas dari hambatan atau genangan.'
                        ],
                        'tangga_lekukDasar' => [
                        'label' => 'Tangga Lekuk Dasar',
                        'desc' => 'Pastikan tangga tersedia dan kuat untuk akses teknisi.'
                        ],
                        'syarat_lekukDasar' => [
                        'label' => 'Syarat Lekuk Dasar yang Dibawahnya Bukan Langsung Tanah',
                        'desc' => 'Pastikan konstruksi lekuk dasar sesuai syarat keamanan bangunan.'
                        ],
                        'akses_lekukDasar' => [
                        'label' => 'Akses Menuju Lekuk Dasar',
                        'desc' => 'Pastikan tersedia akses aman menuju lekuk dasar.'
                        ],
                        'lekukDasar_antar2_elevator' => [
                        'label' => 'Lekuk Dasar Antar 2 Elevator',
                        'desc' => 'Pastikan area antar dua elevator memiliki sekat dan jalur aman.'
                        ],
                        'daun_pintu_ruang_luncur' => [
                        'label' => 'Daun Pintu Ruang Luncur',
                        'desc' => 'Pastikan daun pintu kuat, mudah dioperasikan, dan memiliki sistem pengunci.'
                        ],
                        'interlock_ruang_luncur' => [
                        'label' => 'Interlock/Kunci Kait Pintu Ruang Luncur',
                        'desc' => 'Pastikan interlock berfungsi mencegah pintu terbuka saat elevator bergerak.'
                        ],
                        'kerataan_lantai' => [
                        'label' => 'Kerataan Lantai',
                        'desc' => 'Pastikan permukaan lantai elevator rata dengan lantai bangunan.'
                        ],
                        'sekat_ruang_luncur_2sangkar' => [
                        'label' => 'Sekat Ruang Luncur (2 Sangkar)',
                        'desc' => 'Pastikan terdapat sekat pemisah aman antar dua sangkar.'
                        ],
                        'elevator_miring' => [
                        'label' => 'Elevator Miring',
                        'desc' => 'Pastikan kemiringan elevator sesuai desain teknis dan aman bagi pengguna.'
                        ],
                        ];
                        @endphp

                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Kereta --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">E. Kereta</h2>
                <div id="foto_komponen_kereta-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_komponen_kereta[]" id="foto_komponen_kereta" accept="image/*" multiple onchange="previewImage(this, 'foto_komponen_kereta-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_komponen_kereta') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_komponen_kereta')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'kerangka' => [
                        'label' => 'Kerangka',
                        'desc' => 'Pastikan kerangka kereta atau sangkar lift memiliki kekuatan dan kestabilan sesuai standar desain.'
                        ],
                        'badan_kereta' => [
                        'label' => 'Badan Kereta',
                        'desc' => 'Periksa kondisi badan kereta, pastikan tidak ada kerusakan struktural atau deformasi.'
                        ],
                        'tinggi_dinding' => [
                        'label' => 'Tinggi Dinding',
                        'desc' => 'Ukur tinggi dinding kabin dan pastikan sesuai dengan spesifikasi rancangan.'
                        ],
                        'luas_lantai' => [
                        'label' => 'Luas Lantai',
                        'desc' => 'Pastikan luas lantai mencukupi kapasitas penumpang dan sesuai dengan daya angkut lift.'
                        ],
                        'perluasan_luas_kereta' => [
                        'label' => 'Perluasan Luas Kereta',
                        'desc' => 'Periksa apakah terdapat perluasan ruang yang memengaruhi dimensi dan keseimbangan kabin.'
                        ],
                        'pintu_kereta' => [
                        'label' => 'Pintu Kereta',
                        'desc' => 'Pastikan pintu berfungsi baik, membuka dan menutup tanpa hambatan.'
                        ],
                        'ukuran' => [
                        'label' => 'Ukuran',
                        'desc' => 'Verifikasi ukuran keseluruhan kabin agar sesuai dengan rancangan teknis.'
                        ],
                        'kunci_kait' => [
                        'label' => 'Kunci Kait dan Saklar Pengaman',
                        'desc' => 'Pastikan kunci kait berfungsi untuk mengamankan pintu selama operasi.'
                        ],
                        'celah_antar_pintu' => [
                        'label' => 'Celah Antar Ambang Pintu Kereta dengan Ruang Luncur',
                        'desc' => 'Periksa jarak antar daun pintu agar tidak menimbulkan risiko jepit.'
                        ],
                        'sisi_luar_kereta' => [
                        'label' => 'Sisi Luar Kereta dengan Ruang Balok Luncur',
                        'desc' => 'Pastikan sisi luar kabin bersih, kokoh, dan bebas keretakan.'
                        ],
                        'alarm_bell' => [
                        'label' => 'Alarm Bell',
                        'desc' => 'Periksa fungsi alarm darurat agar dapat digunakan saat keadaan darurat.'
                        ],
                        'sumber_tenaga_cadangan' => [
                        'label' => 'Sumber Tenaga Cadangan (ARD)',
                        'desc' => 'Pastikan sistem tenaga cadangan aktif dan mampu menopang fungsi dasar lift saat mati listrik.'
                        ],
                        'intercom' => [
                        'label' => 'Intercom',
                        'desc' => 'Pastikan intercom dapat digunakan untuk komunikasi antara pengguna dan petugas.'
                        ],
                        'ventilasi' => [
                        'label' => 'Ventilasi',
                        'desc' => 'Pastikan ventilasi berfungsi baik untuk sirkulasi udara dalam kabin.'
                        ],
                        'penerangan_darurat' => [
                        'label' => 'Penerangan Darurat',
                        'desc' => 'Periksa sistem penerangan darurat agar tetap menyala saat listrik utama padam.'
                        ],
                        'panel_operasi' => [
                        'label' => 'Panel Operasi',
                        'desc' => 'Pastikan semua tombol dan indikator pada panel operasi berfungsi dengan baik.'
                        ],
                        'penunjuk_posisi_sangkar' => [
                        'label' => 'Penunjuk Posisi Sangkar',
                        'desc' => 'Pastikan indikator posisi sangkar bekerja akurat di setiap lantai.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Syarat Panel Operasi --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Syarat Panel Operasi</h2>
            </div>


            <div class="overflow-x-auto"><table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'nama_pembuat' => [
                        'label' => 'Nama Pembuat',
                        'desc' => 'Pastikan nama pabrikan pembuat lift tertera dengan jelas pada panel operasi.'
                        ],
                        'kapasitas_beban' => [
                        'label' => 'Kapasitas Beban',
                        'desc' => 'Periksa apakah informasi kapasitas beban (dalam kg dan jumlah orang) tercantum dengan jelas.'
                        ],
                        'rambu_dilarang_merokok' => [
                        'label' => 'Rambu Dilarang Merokok',
                        'desc' => 'Pastikan terdapat rambu larangan merokok yang terlihat jelas di dalam kabin atau pada panel.'
                        ],
                        'indikasi_beban_lebih' => [
                        'label' => 'Indikasi Beban Lebih',
                        'desc' => 'Verifikasi fungsi indikator beban lebih, seperti alarm suara atau lampu, berfungsi saat kapasitas terlampaui.'
                        ],
                        'tombol_buka_tutup' => [
                        'label' => 'Tombol Buka dan Tutup',
                        'desc' => 'Uji fungsi tombol buka dan tutup pintu, pastikan responsif dan bekerja dengan baik.'
                        ],
                        'tombol_lantai_pemberhentian' => [
                        'label' => 'Tombol Lantai Pemberhentian',
                        'desc' => 'Periksa semua tombol pilihan lantai, pastikan berfungsi untuk mendaftarkan panggilan dan lampu indikator menyala.'
                        ],
                        'tombol_bell_alarm' => [
                        'label' => 'Tombol Bell Alarm',
                        'desc' => 'Pastikan tombol alarm darurat berfungsi dan mengeluarkan suara yang jelas saat ditekan.'
                        ],
                        'intercom_dua_arah' => [
                        'label' => 'Intercom Dua Arah',
                        'desc' => 'Uji sistem intercom untuk memastikan komunikasi dua arah antara kabin dan ruang mesin atau pos keamanan berjalan lancar.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'kekuatan_atap_kereta' => [
                        'label' => 'Kekuatan Atap Kereta',
                        'desc' => 'Pastikan atap kereta memiliki struktur yang kokoh, mampu menahan beban sesuai standar, dan tidak ada kerusakan atau deformasi.'
                        ],
                        'syarat_pintu_darurat' => [
                        'label' => 'Syarat Pintu Darurat Atap Kereta',
                        'desc' => 'Verifikasi bahwa pintu darurat di atap dapat diakses, dibuka dengan mudah dari dalam dan luar, serta memenuhi standar keselamatan.'
                        ],
                        'syarat_pintu_darurat_samping' => [
                        'label' => 'Syarat Pintu Darurat Samping Kereta',
                        'desc' => 'Periksa kondisi pintu darurat samping, pastikan mekanisme pembukaan berfungsi baik dan tidak terhalang.'
                        ],
                        'pagar_pengaman' => [
                        'label' => 'Pagar Pengaman Atap Kereta',
                        'desc' => 'Pastikan pagar pengaman di atap kereta terpasang dengan kuat dan memiliki tinggi yang memadai untuk mencegah jatuh.'
                        ],
                        'ukuran_pagar' => [
                        'label' => 'Ukuran Pagar Pengaman dengan Celah 300 – 850 mm',
                        'desc' => 'Ukur celah vertikal pada pagar pengaman, pastikan berada dalam rentang 300 mm hingga 850 mm sesuai regulasi.'
                        ],
                        'ukuran_pagar_pengaman' => [
                        'label' => 'Ukuran Pagar Pengaman dengan Celah Lebih dari 850 mm',
                        'desc' => 'Jika ada celah lebih dari 850 mm, pastikan ada pengaman tambahan untuk mencegah risiko bahaya.'
                        ],
                        'penerangan_atap' => [
                        'label' => 'Penerangan Atap Kereta',
                        'desc' => 'Periksa fungsi lampu penerangan di area atap kereta, pastikan memberikan pencahayaan yang cukup untuk inspeksi atau evakuasi.'
                        ],
                        'tombol_operasi_manual' => [
                        'label' => 'Tombol Operasi Manual',
                        'desc' => 'Uji tombol operasi manual di atap kereta, pastikan berfungsi untuk menggerakkan lift dalam mode inspeksi.'
                        ],
                        'syarat_interior_kereta' => [
                        'label' => 'Syarat Interior Kereta',
                        'desc' => 'Pastikan kondisi interior kereta, termasuk dinding, lantai, dan langit-langit, dalam keadaan baik, bersih, dan tidak ada bagian yang tajam atau rusak.'
                        ],
                        ];
                        @endphp

                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Governor dan Rem Pengaman Kereta --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">F. Governor dan Rem Pengaman Kereta</h2>
                <div id="foto_governor_rem-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_governor_rem[]" id="foto_governor_rem" accept="image/*" multiple onchange="previewImage(this, 'foto_governor_rem-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_governor_rem') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_governor_rem')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'penjepit_tali' => [
                        'label' => 'Penjepit Tali/Sabuk Governor',
                        'desc' => 'Periksa kondisi fisik penjepit tali atau sabuk governor dari keausan, korosi, atau kerusakan.'
                        ],
                        'saklar_governor' => [
                        'label' => 'Saklar Governor',
                        'desc' => 'Pastikan saklar governor berfungsi dengan baik untuk memutus daya motor saat terjadi kecepatan berlebih.'
                        ],
                        'fungsi_kecepatan_rem' => [
                        'label' => 'Fungsi Kecepatan Rem Pengaman Kereta',
                        'desc' => 'Uji fungsi rem pengaman untuk memastikan dapat menghentikan kereta pada kecepatan yang ditentukan.'
                        ],
                        'rem_pengaman' => [
                        'label' => 'Rem Pengaman',
                        'desc' => 'Verifikasi kondisi mekanis rem pengaman, pastikan tidak ada komponen yang aus atau macet.'
                        ],
                        'bentuk_rem_pengaman' => [
                        'label' => 'Bentuk Rem Pengaman',
                        'desc' => 'Pastikan bentuk dan tipe rem pengaman (misal: blok, fleksibel) sesuai dengan spesifikasi teknis lift.'
                        ],
                        'rem_pengaman_berangsur' => [
                        'label' => 'Rem Pengaman Berangsur',
                        'desc' => 'Untuk tipe berangsur, pastikan mekanisme pengereman bekerja secara halus dan progresif.'
                        ],
                        'rem_pengaman_mendadak' => [
                        'label' => 'Rem Pengaman Mendadak',
                        'desc' => 'Untuk tipe mendadak, pastikan rem dapat mencengkeram rel pemandu secara instan saat diaktifkan.'
                        ],
                        'syarat_rem_pengaman' => [
                        'label' => 'Syarat Rem Pengaman',
                        'desc' => 'Pastikan semua komponen rem pengaman memenuhi syarat keselamatan dan standar yang berlaku.'
                        ],
                        'kecepatan_kereta' => [
                        'label' => 'Kecepatan Kereta ≥ 60 m/menit',
                        'desc' => 'Verifikasi bahwa sistem pengaman dirancang sesuai untuk kecepatan kereta 60 m/menit atau lebih.'
                        ],
                        'saklar_Pengaman' => [
                        'label' => 'Saklar Pengaman Lintas Batas',
                        'desc' => 'Pastikan saklar batas atas dan bawah berfungsi untuk mencegah kereta bergerak melewati lantai teratas atau terbawah.'
                        ],
                        'alat_pembatas' => [
                        'label' => 'Alat Pembatas Beban Lebih',
                        'desc' => 'Uji alat pembatas beban (overload device) untuk memastikan lift tidak bergerak saat beban melebihi kapasitas.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Bobot Imbang, Rel Pemandu dan Peredam--}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">G. Bobot Imbang, Rel Pemandu dan Peredam</h2>
                <div id="foto_bobot_imbang-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_bobot_imbang[]" id="foto_bobot_imbang" accept="image/*" multiple onchange="previewImage(this, 'foto_bobot_imbang-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_bobot_imbang') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_bobot_imbang')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                        'bahan_dipergunakan' => [
                        'label' => 'Bahan yang dipergunakan',
                        'desc' => 'Verifikasi bahwa material untuk bobot imbang, rel pemandu, dan peredam sesuai dengan spesifikasi teknis dan standar keselamatan.'
                        ],
                        'pemasangan_sekat' => [
                        'label' => 'Pemasang sekat pengaman bobot imbang setinggi 2500 mm',
                        'desc' => 'Pastikan sekat pengaman untuk bobot imbang terpasang dengan benar dan memiliki ketinggian minimal 2500 mm dari dasar pit.'
                        ],
                        'konstruksi_rel' => [
                        'label' => 'Konstruksi rel pemandu kereta dan bobot imbang',
                        'desc' => 'Periksa kekuatan dan kelurusan konstruksi rel pemandu, pastikan tidak ada deformasi atau sambungan yang longgar.'
                        ],
                        'jenis_peredam' => [
                        'label' => 'Jenis Peredam',
                        'desc' => 'Identifikasi jenis peredam yang digunakan (misalnya, peredam hidrolik atau pegas) dan pastikan sesuai dengan desain lift.'
                        ],
                        'fungsi_peredam' => [
                        'label' => 'Fungsi Peredam',
                        'desc' => 'Uji fungsi peredam untuk memastikan dapat menyerap benturan dan menghentikan kereta atau bobot imbang secara aman.'
                        ],
                        'saklar_pengaman_kereta' => [
                        'label' => 'Saklar Pengaman untuk Kereta Kecepatan 90 m / menit atau Lebih',
                        'desc' => 'Pastikan saklar pengaman pada peredam berfungsi untuk memutus sirkuit jika peredam tertekan, khususnya untuk lift berkecepatan tinggi.'
                        ],
                        ];
                        @endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Instalasi Listrik--}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">H. Instalasi Listrik</h2>
                <div id="foto_instalasi_listrik-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="foto_instalasi_listrik[]" id="foto_instalasi_listrik" accept="image/*" multiple onchange="previewImage(this, 'foto_instalasi_listrik-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_instalasi_listrik') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_instalasi_listrik')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
$items = [
    'standar_rangkaian' => [
        'label' => 'Standar Rangkaian Instalasi Listrik, Perlengkapan dan Pengaman',
        'desc' => 'Periksa kesesuaian seluruh instalasi listrik dengan standar teknis, pastikan semua perlengkapan dan pengaman terpasang sesuai regulasi dan berfungsi dengan baik.'
    ],
    'panel_listrik' => [
        'label' => 'Panel Listrik',
        'desc' => 'Verifikasi kondisi panel listrik, pastikan semua komponen internal terpasang rapi, aman, dan tidak ada kerusakan pada sambungan atau kabel.'
    ],
    'catu_daya_ard' => [
        'label' => 'Catu Daya Pengganti Listrik Otomatis (ARD)',
        'desc' => 'Periksa ARD untuk memastikan daya cadangan otomatis berfungsi jika terjadi pemadaman, serta kapasitas dan koneksi sesuai kebutuhan sistem.'
    ],
    'kabel_grounding' => [
        'label' => 'Kabel Grounding',
        'desc' => 'Pastikan semua kabel grounding terpasang dengan benar, memiliki resistansi rendah, dan melindungi sistem listrik dari gangguan atau bahaya kebakaran.'
    ],
    'alarm_kebakaran' => [
        'label' => 'Alarm Kebakaran',
        'desc' => 'Uji fungsi alarm kebakaran untuk memastikan dapat mendeteksi asap atau panas secara tepat dan memberikan peringatan sesuai standar keselamatan.'
    ],
];
@endphp

                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
            $items = [
                'catu_daya_cadangan' => [
                    'label' => 'Catu Daya Cadangan',
                    'desc' => 'Pastikan tersedia catu daya cadangan yang mampu menjaga pengoperasian elevator saat listrik utama terputus.'
                ],
                'pengoperasian_khusus' => [
                    'label' => 'Pengoperasian Khusus',
                    'desc' => 'Verifikasi sistem pengoperasian khusus berfungsi sesuai prosedur darurat.'
                ],
                'saklar_kebakaran' => [
                    'label' => 'Saklar Kebakaran',
                    'desc' => 'Pastikan saklar kebakaran terpasang, mudah diakses, dan bekerja sesuai standar keselamatan.'
                ],
                'label_elevator_kebakaran' => [
                    'label' => 'Label “Elevator Penanggulangan Kebakaran”',
                    'desc' => 'Periksa keberadaan dan keterbacaan label elevator penanggulangan kebakaran.'
                ],
                'ketahanan_instalasi_api' => [
                    'label' => 'Ketahanan Instalasi Listrik Terhadap Api',
                    'desc' => 'Pastikan instalasi listrik memiliki ketahanan terhadap paparan api sesuai standar.'
                ],
                'dinding_luncur' => [
                    'label' => 'Dinding Luncur',
                    'desc' => 'Pastikan dinding luncur terpasang dengan baik dan berfungsi sebagaimana mestinya.'
                ],
                'ukuran_sangkar' => [
                    'label' => 'Ukuran Sangkar',
                    'desc' => 'Verifikasi ukuran sangkar elevator sesuai dengan ketentuan teknis dan kapasitas.'
                ],
                'ukuran_pintu_kereta' => [
                    'label' => 'Ukuran Pintu Kereta',
                    'desc' => 'Pastikan ukuran pintu kereta memenuhi standar keselamatan dan akses evakuasi.'
                ],
                'waktu_tempuh' => [
                    'label' => 'Waktu Tempuh',
                    'desc' => 'Periksa waktu tempuh elevator agar sesuai dengan spesifikasi dan kebutuhan darurat.'
                ],
                'lantai_evakuasi' => [
                    'label' => 'Lantai Evakuasi',
                    'desc' => 'Pastikan elevator berhenti di lantai evakuasi yang telah ditentukan saat kondisi darurat.'
                ],
            ];
            @endphp



                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                {{-- Elevator untuk Penanggulangan Kebakaran --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Elevator untuk Penanggulangan Kebakaran</h2>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
$items = [
    'standar_rangkaian' => [
        'label' => 'Standar Rangkaian Instalasi Listrik, Perlengkapan dan Pengaman',
        'desc' => 'Pastikan instalasi listrik sesuai standar dan perlengkapan pengaman terpasang dengan baik.'
    ],
    'panel_listrik' => [
        'label' => 'Panel Listrik',
        'desc' => 'Periksa panel, sambungan, dan komponen agar aman dan berfungsi normal.'
    ],
    'catu_daya_ard' => [
        'label' => 'Catu Daya Pengganti Listrik Otomatis (ARD)',
        'desc' => 'Pastikan ARD bekerja otomatis saat listrik padam dan kapasitasnya memadai.'
    ],
    'kabel_grounding' => [
        'label' => 'Kabel Grounding',
        'desc' => 'Cek kabel grounding agar melindungi sistem listrik dari gangguan dan bahaya.'
    ],
    'alarm_kebakaran' => [
        'label' => 'Alarm Kebakaran',
        'desc' => 'Uji alarm untuk mendeteksi asap/panas dan memberi peringatan tepat waktu.'
    ],
];
@endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                {{-- Elevator untuk Disabilitas --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Elevator untuk Disabilitas</h2>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
$items = [
    'panel_operasi_disabilitas' => [
        'label' => 'Panel Operasi Disabilitas',
        'desc' => 'Periksa panel operasi untuk memastikan berfungsi dengan baik, mudah diakses, dan sesuai standar keselamatan.'
    ],
    'tinggi_panel_operasi' => [
        'label' => 'Tinggi Panel Operasi',
        'desc' => 'Pastikan tinggi panel operasi sesuai ketentuan agar dapat dijangkau oleh seluruh pengguna, termasuk penyandang disabilitas.'
    ],
    'waktu_bukaan_pintu' => [
        'label' => 'Waktu Bukaan Pintu',
        'desc' => 'Periksa waktu bukaan pintu agar cukup untuk keluar masuk penumpang dengan aman.'
    ],
    'lebar_bukaan_pintu' => [
        'label' => 'Ukuran Lebar Bukaan Pintu',
        'desc' => 'Pastikan lebar bukaan pintu memenuhi standar aksesibilitas dan keselamatan.'
    ],
    'informasi_operasi' => [
        'label' => 'Informasi Operasi',
        'desc' => 'Periksa ketersediaan dan keterbacaan informasi operasi elevator bagi pengguna.'
    ],
    'label_operator_disabilitas' => [
        'label' => 'Label "Operator Disabilitas"',
        'desc' => 'Pastikan label operator disabilitas terpasang dengan jelas dan mudah dikenali.'
    ],
];

@endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                {{-- Sensor Gempa --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Sensor Gempa</h2>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
$items = [
    'sensor_gempa_lebih_10lt_40m' => [
        'label' => 'Lebih dari 10 lt. / 40 meter',
        'desc' => 'Pastikan elevator dengan ketinggian lebih dari 10 lantai atau 40 meter dilengkkapi sensor gempa sesuai ketentuan.'
    ],
    'fungsi_input_signal_sensor_gempa' => [
        'label' => 'Fungsi Input Signal Sensor Gempa',
        'desc' => 'Uji fungsi input signal sensor gempa untuk memastikan sistem merespons dengan benar saat terjadi getaran gempa.'
    ],
];

@endphp


                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            {{-- Nama komponen + tooltip tanda tanya --}}
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button"
                                        onclick="toggleTooltip('{{ $name }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold">
                                        ?
                                    </button>
                                    <div id="tooltip-{{ $name }}"
                                        class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            {{-- Radio Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi"
                                    {{ old($name) == 'Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak Memenuhi --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                    {{ old($name) == 'Tidak Memenuhi' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan"
                                    placeholder="Keterangan"
                                    value="{{ old($name . '_keterangan') }}"
                                    class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tombol Simpan --}}
            <button
                class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Simpan
            </button>


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




                function toggleTooltip(id) {
                    const tooltip = document.getElementById(`tooltip-${id}`);
                    tooltip.classList.toggle('hidden');
                    setTimeout(() => tooltip.classList.add('hidden'), 4000); // sembunyikan otomatis setelah 4 detik
                }
            </script>
</x-layout>