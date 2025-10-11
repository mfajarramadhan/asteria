<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.eskalator.elevator.update', $formKpElevator->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Perbarui data ini?')">
            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                <div class="w-full md:w-[50%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ old('tanggal_pemeriksaan', $formKpElevator->tanggal_pemeriksaan) }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 @error('tanggal_pemeriksaan') border-red-600 @enderror">
                    </div>
                    @error('tanggal_pemeriksaan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan', $formKpElevator->nama_perusahaan) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('nama_perusahaan') border-red-600 @enderror">
                @error('nama_perusahaan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <h2 class="block text-sm font-bold text-gray-700">Spesifikasi</h2>

            {{-- Jenis Elevator --}}
            <div>
                <input type="text" name="jenis_elevator" placeholder="Jenis Elevator" value="{{ old('jenis_elevator', $formKpElevator->jenis_elevator) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_elevator') border-red-600 @enderror">
                @error('jenis_elevator')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" value="{{ old('pabrik_pembuat', $formKpElevator->pabrik_pembuat) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pabrik_pembuat') border-red-600 @enderror">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Negara Tahun Pembuat --}}
            <div>
                <input type="text" name="negara_tahun_pembuat" placeholder="Negara/tahun Pembuat" value="{{ old('negara_tahun_pembuat', $formKpElevator->negara_tahun_pembuat) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('negara_tahun_pembuat') border-red-600 @enderror">
                @error('negara_tahun_pembuat')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nomor Seri --}}
            <div>
                <input type="text" name="nomor_seri" placeholder="Nomor Seri" value="{{ old('nomor_seri', $formKpElevator->nomor_seri) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('nomor_seri') border-red-600 @enderror">
                @error('nomor_seri')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kapasitas --}}
            <div>
                <input type="text" name="kapasitas" placeholder="Kapasitas" value="{{ old('kapasitas', $formKpElevator->kapasitas) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kapasitas') border-red-600 @enderror">
                @error('kapasitas')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jumlah Lantai Pemberhentian --}}
            <div>
                <input type="text" name="jumlah_lantai_pemberhentian" placeholder="Jumlah Lantai Pemberhentian" value="{{ old('jumlah_lantai_pemberhentian', $formKpElevator->jumlah_lantai_pemberhentian) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jumlah_lantai_pemberhentian') border-red-600 @enderror">
                @error('jumlah_lantai_pemberhentian')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kecepatan Elevator --}}
            <div>
                <input type="text" name="kecepatan_elevator" placeholder="Kecepatan Elevator" value="{{ old('kecepatan_elevator', $formKpElevator->kecepatan_elevator) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kecepatan_elevator') border-red-600 @enderror">
                @error('kecepatan_elevator')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lokasi Elevator --}}
            <div>
                <input type="text" name="lokasi_elevator" placeholder="Lokasi Elevator" value="{{ old('lokasi_elevator', $formKpElevator->lokasi_elevator) }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('lokasi_elevator') border-red-600 @enderror">
                @error('lokasi_elevator')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Helper Function to Render Image Previews and Inputs --}}
            @php
            function renderImageSection($title, $fieldName, $existingImages) {
            @endphp
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">{{ $title }}</h2>
                @if($existingImages && is_array(json_decode($existingImages, true)))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach(json_decode($existingImages, true) as $foto)
                    <img src="{{ asset('storage/'.$foto) }}" class="object-cover h-24 border rounded w-28">
                    @endforeach
                </div>
                @endif
                <div id="{{ $fieldName }}-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="{{ $fieldName }}[]" accept="image/*" multiple onchange="previewImage(this, '{{ $fieldName }}-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error($fieldName) border-red-600 @enderror">
                @error($fieldName)
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>
            @php
            }

            function renderTableSection($items, $model) {
            @endphp
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    @if(!isset($GLOBALS['tableHeaderRendered']))
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 border">Komponen</th>
                            <th class="px-3 py-2 text-center border">Memenuhi</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                            <th class="px-3 py-2 border">Keterangan</th>
                        </tr>
                    </thead>
                    @php $GLOBALS['tableHeaderRendered'] = true; @endphp
                    @endif
                    <tbody>
                        @foreach ($items as $name => $data)
                        <tr class="relative">
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                    <button type="button" onclick="toggleTooltip('{{ $name }}')" class="font-bold text-blue-600 hover:text-blue-800">?</button>
                                    <div id="tooltip-{{ $name }}" class="absolute hidden p-2 text-xs text-white bg-gray-800 rounded shadow-lg bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-10">
                                        {{ $data['desc'] }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Memenuhi" {{ old($name, $model->$name) == 'Memenuhi' ? 'checked' : '' }} class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>
                            <td class="px-3 py-2 text-center border">
                                <input type="radio" name="{{ $name }}" value="Tidak Memenuhi" {{ old($name, $model->$name) == 'Tidak Memenuhi' ? 'checked' : '' }} class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>
                            <td class="px-3 py-2 border">
                                <input type="text" name="{{ $name }}_keterangan" placeholder="Keterangan" value="{{ old($name.'_keterangan', $model->{$name.'_keterangan'}) }}" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @php
            }
            @endphp

            {{-- A. Mesin --}}
            {{ renderImageSection('A. Mesin', 'foto_mesin', $formKpElevator->foto_mesin) }}
            @php
            $mesinItems = [
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
            renderTableSection($mesinItems, $formKpElevator);
            @endphp

            {{-- (Ulangi untuk setiap seksi lainnya: B, C, D, E, F, G) --}}
            {{-- Contoh untuk seksi B --}}
            {{ renderImageSection('B. Tali/Sabuk Penggantung', 'foto_tali_penggantung', $formKpElevator->foto_tali_penggantung) }}
            @php
            $taliItems = [
            'tali_sabuk1' => ['label' => 'Tali/Sabuk Penggantung 1', 'desc' => 'Periksa kondisi tali atau sabuk penggantung pertama agar tidak terdapat keretakan, keausan, atau karat.'],
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
            renderTableSection($taliItems, $formKpElevator);
            @endphp

            {{ renderImageSection('C. Teromol', 'foto_tali_teromol', $formKpElevator->foto_tali_teromol) }}
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
            renderTableSection($taliItems, $formKpElevator);
            @endphp

            {{ renderImageSection('D. Bangunan Ruang Luncur, Ruang Atas dan Lekuk Dasar', 'foto_bangun_ruang_luncur', $formKpElevator->foto_bangun_ruang_luncur) }}
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

            {{ renderImageSection('E. Kereta', 'foto_komponen_kereta', $formKpElevator->foto_komponen_kereta) }}
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


            {{ renderImageSection('>F. Governor dan Rem Pengaman Kereta', 'foto_governor_rem', $formKpElevator->foto_governor_rem) }}
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

            {{ renderImageSection('>F. Governor dan Rem Pengaman Kereta', 'foto_bobot_imbang', $formKpElevator->foto_bobot_imbang) }}
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

            {{-- Tombol Perbarui --}}
            <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Perbarui
            </button>
        </form>
    </div>

    <script>
        function previewImage(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            // Jangan hapus preview lama, tambahkan saja yang baru atau biarkan
            // Jika ingin mengganti, baris di bawah ini bisa diaktifkan kembali
            // previewContainer.innerHTML = ""; 
            Array.from(inputElement.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("max-h-32", "rounded", "border", "m-1", "object-cover");
                    previewContainer.appendChild(img);
                };
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