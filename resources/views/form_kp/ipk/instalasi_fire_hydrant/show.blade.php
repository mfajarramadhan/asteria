<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md space-y-4">
        {{-- Informasi Umum --}}
        <h2 class="block text-sm font-bold text-gray-700">Informasi Pemeriksaan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm">Tanggal Pemeriksaan</p>
                <p class="font-semibold">{{ $data->tanggal_pemeriksaan ?? '-' }}</p>
            </div>
            {{-- Nama Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpEskalator->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
                </div>
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpEskalator->jobOrderTool->kapasitas ?? '-' }}
                </div>
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpEskalator->jobOrderTool->model ?? '-' }}
                </div>
            </div>

            {{-- No. Seri/Unit --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpEskalator->jobOrderTool->no_seri ?? '-' }}
                </div>
            </div>
            {{-- Pabrik Pembuat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpEskalator->pabrik_pembuat ?? '-' }}
                </div>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Jenis Elevator</p>
                <p class="font-semibold">{{ $data->jenis_elevator ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Negara/Tahun Pembuat</p>
                <p class="font-semibold">{{ $data->negara_tahun_pembuat ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Jumlah Lantai Pemberhentian</p>
                <p class="font-semibold">{{ $data->jumlah_lantai_pemberhentian ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Kecepatan Elevator</p>
                <p class="font-semibold">{{ $data->kecepatan_elevator ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Lokasi Elevator</p>
                <p class="font-semibold">{{ $data->lokasi_elevator ?? '-' }}</p>
            </div>
        </div>

        {{-- Foto Mesin --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">A. Mesin</h2>
            @if ($data->foto_mesin)
            <div class="flex flex-wrap gap-2">
                @foreach (json_decode($data->foto_mesin) as $foto)
                <img src="{{ asset('storage/' . $foto) }}" class="max-h-32 rounded border">
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-sm">Tidak ada foto yang diunggah.</p>
            @endif
        </div>

        {{-- Tabel Komponen Mesin --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-2 border">Komponen</th>
                        <th class="px-3 py-2 text-center border">Status</th>
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

                    @foreach ($items as $name => $dataItem)
                    <tr class="relative">
                        <td class="px-3 py-2 border font-medium w-[50%]">
                            <div class="flex items-center justify-between gap-2">
                                {{ $dataItem['label'] }}
                                <button type="button" onclick="toggleTooltip('{{ $name }}')" class="text-blue-600 hover:text-blue-800 font-bold">?</button>
                                <div id="tooltip-{{ $name }}" class="absolute hidden bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs rounded px-2 py-1 shadow-lg z-10">
                                    {{ $dataItem['desc'] }}
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <span class="{{ $data->$name == 'Memenuhi' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ ucfirst($data->$name ?? '-') }}
                            </span>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $data->{$name . '_keterangan'} ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- B. Tali/Sabuk Penggantung --}}
    <div class="mt-6">
        <h2 class="block mb-1 text-sm font-bold text-gray-700">B. Tali/Sabuk Penggantung</h2>

        {{-- Foto --}}
        <div class="mb-3">
            <h3 class="text-sm font-semibold text-gray-600">Foto Dokumentasi</h3>
            <div class="flex flex-wrap gap-3 mt-2">
                @forelse ($data->foto_tali_penggantung ?? [] as $foto)
                <img src="{{ asset('storage/' . $foto) }}" alt="Foto Tali/Sabuk" class="object-cover w-32 h-32 rounded-lg border border-gray-300 shadow-sm">
                @empty
                <p class="text-sm text-gray-500">Tidak ada foto tersedia.</p>
                @endforelse
            </div>
        </div>

        {{-- Tabel Pemeriksaan --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-2 border">Komponen</th>
                        <th class="px-3 py-2 text-center border">Status</th>
                        <th class="px-3 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items = [
                    'tali_sabuk1' => 'Tali/Sabuk Penggantung 1',
                    'tali_sabuk2' => 'Tali/Sabuk Penggantung 2',
                    'nilai_faktor_keamanan' => 'Nilai Faktor Keamanan Tali/Sabuk Penggantung',
                    'tali_penggantung_bobot_imbang' => 'Tali Penggantung Kereta Jenis Tali Dengan Bobot Imbang',
                    'tali_penggantung_tanpa_bobot' => 'Tali Penggantung Kereta Tanpa Bobot Imbang',
                    'sabuk' => 'Sabuk',
                    'pengaman_tanpa_bobot' => 'Alat Pengaman Pada Elevator Tanpa Bobot Imbang Apabila Alat Penggantung Kereta Penarik Menjadi Kendur',
                    ];
                    @endphp

                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <span class="font-semibold {{ $data->$name === 'Memenuhi' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $data->$name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-3 py-2 border">{{ $data->{$name . '_keterangan'} ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- C. Teromol --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">C. Teromol</h2>

        {{-- Preview Foto Teromol --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @if($data->foto_teromol)
            @foreach($data->foto_teromol as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Teromol">
            @endforeach
            @else
            <span class="text-gray-500 text-sm">Tidak ada foto teromol</span>
            @endif
        </div>
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
                'alur_teromol' => 'Alur Teromol',
                'diameter_teromol_penumpang' => 'Diameter Teromol Penumpang',
                'diameter_teromol_governor' => 'Diameter Teromol Governor',
                ];
                @endphp

                @foreach($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- D. Bangunan Ruang Luncur, Ruang Atas dan Lekuk Dasar --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">D. Bangunan Ruang Luncur, Ruang Atas dan Lekuk Dasar</h2>

        {{-- Preview Foto Bangunan Ruang Luncur --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @if($data->foto_bangun_ruang_luncur)
            @foreach($data->foto_bangun_ruang_luncur as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Bangunan Ruang Luncur">
            @endforeach
            @else
            <span class="text-gray-500 text-sm">Tidak ada foto bangunan ruang luncur</span>
            @endif
        </div>
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
                'konstruksi_ruangLuncur' => 'Konstruksi Ruang Luncur, Ruang Atas, dan Lekuk Dasar',
                'dinding_ruangLuncur' => 'Dinding Ruang Luncur, Ruang Atas dan Lekuk Dasar (Elevator panorama)',
                'landasan_jalur' => 'Landasan Jalur Kereta/Elevator Miring',
                'penerangan_ruangLuncur' => 'Penerangan Ruang Luncur, Ruang Atas, dan Lekuk Dasar',
                'pintu_darurat' => 'Pintu Darurat (Non Stop)',
                'ukuran_pintu_darurat' => 'Ukuran Pintu Darurat',
                'saklar_pengaman_pintu' => 'Saklar Pengaman Pintu Darurat',
                'jembatan_bantu' => 'Jembatan Bantu Dari Pintu Darurat',
                'ruangBebas_atasSangkar' => 'Ruang Bebas Di Atas Sangkar',
                'ruangBebas_lekukDasar' => 'Ruang Bebas Lekuk Dasar',
                'tangga_lekukDasar' => 'Tangga Lekuk Dasar',
                'syarat_lekukDasar' => 'Syarat Lekuk Dasar yang Dibawahnya Bukan Langsung Tanah',
                'akses_lekukDasar' => 'Akses Menuju Lekuk Dasar',
                'lekukDasar_antar2_elevator' => 'Lekuk Dasar Antar 2 Elevator',
                'daun_pintu_ruang_luncur' => 'Daun Pintu Ruang Luncur',
                'interlock_ruang_luncur' => 'Interlock/Kunci Kait Pintu Ruang Luncur',
                'kerataan_lantai' => 'Kerataan Lantai',
                'sekat_ruang_luncur_2sangkar' => 'Sekat Ruang Luncur (2 Sangkar)',
                'elevator_miring' => 'Elevator Miring',
                ];
                @endphp

                @foreach($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- E. Kereta --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">E. Kereta</h2>

        {{-- Preview Foto Kereta --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @if($data->foto_komponen_kereta)
            @foreach($data->foto_komponen_kereta as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Kereta">
            @endforeach
            @else
            <span class="text-gray-500 text-sm">Tidak ada foto kereta</span>
            @endif
        </div>
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
                'kerangka' => 'Kerangka',
                'badan_kereta' => 'Badan Kereta',
                'tinggi_dinding' => 'Tinggi Dinding',
                'luas_lantai' => 'Luas Lantai',
                'perluasan_luas_kereta' => 'Perluasan Luas Kereta',
                'pintu_kereta' => 'Pintu Kereta',
                'ukuran' => 'Ukuran',
                'kunci_kait' => 'Kunci Kait dan Saklar Pengaman',
                'celah_antar_pintu' => 'Celah Antar Ambang Pintu Kereta dengan Ruang Luncur',
                'sisi_luar_kereta' => 'Sisi Luar Kereta dengan Ruang Balok Luncur',
                'alarm_bell' => 'Alarm Bell',
                'sumber_tenaga_cadangan' => 'Sumber Tenaga Cadangan (ARD)',
                'intercom' => 'Intercom',
                'ventilasi' => 'Ventilasi',
                'penerangan_darurat' => 'Penerangan Darurat',
                'panel_operasi' => 'Panel Operasi',
                'penunjuk_posisi_sangkar' => 'Penunjuk Posisi Sangkar',
                ];
                @endphp

                @foreach($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
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


    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
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

    {{-- Syarat Panel Operasi --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">Syarat Panel Operasi</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
            <tbody>
                @php
                $items = [
                'nama_pembuat' => 'Nama Pembuat',
                'kapasitas_beban' => 'Kapasitas Beban',
                'rambu_dilarang_merokok' => 'Rambu Dilarang Merokok',
                'indikasi_beban_lebih' => 'Indikasi Beban Lebih',
                'tombol_buka_tutup' => 'Tombol Buka dan Tutup',
                'tombol_lantai_pemberhentian' => 'Tombol Lantai Pemberhentian',
                'tombol_bell_alarm' => 'Tombol Bell Alarm',
                'intercom_dua_arah' => 'Intercom Dua Arah',
                ];
                @endphp

                @foreach($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
            <tbody>
                @php
                $items = [
                'kekuatan_atap_kereta' => 'Kekuatan Atap Kereta',
                'syarat_pintu_darurat' => 'Syarat Pintu Darurat Atap Kereta',
                'syarat_pintu_darurat_samping' => 'Syarat Pintu Darurat Samping Kereta',
                'pagar_pengaman' => 'Pagar Pengaman Atap Kereta',
                'ukuran_pagar' => 'Ukuran Pagar Pengaman dengan Celah 300 – 850 mm',
                'ukuran_pagar_pengaman' => 'Ukuran Pagar Pengaman dengan Celah Lebih dari 850 mm',
                'penerangan_atap' => 'Penerangan Atap Kereta',
                'tombol_operasi_manual' => 'Tombol Operasi Manual',
                'syarat_interior_kereta' => 'Syarat Interior Kereta',
                ];
                @endphp

                @foreach ($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
            <tbody>
                @php
                $items = [
                'penjepit_tali' => 'Penjepit Tali/Sabuk Governor',
                'saklar_governor' => 'Saklar Governor',
                'fungsi_kecepatan_rem' => 'Fungsi Kecepatan Rem Pengaman Kereta',
                'rem_pengaman' => 'Rem Pengaman',
                'bentuk_rem_pengaman' => 'Bentuk Rem Pengaman',
                'rem_pengaman_berangsur' => 'Rem Pengaman Berangsur',
                'rem_pengaman_mendadak' => 'Rem Pengaman Mendadak',
                'syarat_rem_pengaman' => 'Syarat Rem Pengaman',
                'kecepatan_kereta' => 'Kecepatan Kereta ≥ 60 m/menit',
                'saklar_Pengaman' => 'Saklar Pengaman Lintas Batas',
                'alat_pembatas' => 'Alat Pembatas Beban Lebih',
                ];
                @endphp

                @foreach ($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
            <tbody>
                @php
                $items = [
                'bahan_dipergunakan' => 'Bahan yang dipergunakan',
                'pemasangan_sekat' => 'Pemasang sekat pengaman bobot imbang setinggi 2500 mm',
                'konstruksi_rel' => 'Konstruksi rel pemandu kereta dan bobot imbang',
                'jenis_peredam' => 'Jenis Peredam',
                'fungsi_peredam' => 'Fungsi Peredam',
                'saklar_pengaman_kereta' => 'Saklar Pengaman untuk Kereta Kecepatan 90 m / menit atau Lebih',
                ];
                @endphp

                @foreach ($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $data->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $data->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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


        function toggleTooltip(id) {
            const tooltip = document.getElementById(`tooltip-${id}`);
            tooltip.classList.toggle('hidden');
            setTimeout(() => tooltip.classList.add('hidden'), 4000);
        }
    </script>
</x-layout>