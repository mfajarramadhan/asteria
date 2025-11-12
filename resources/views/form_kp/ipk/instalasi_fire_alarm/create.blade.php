<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.eskalator.eskalator.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
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

            {{-- Nama Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
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
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat') }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <h2 class="block text-sm font-bold text-gray-700">Spesifikasi</h2>

            {{-- Jenis Eskalator --}}
            <div>
                <input type="text" name="jenis_eskalator" placeholder="Jenis Eskalator" id="jenis_eskalator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_eskalator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_eskalator') }}">
                @error('jenis_eskalator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Merk Eskalator --}}
            <div>
                <input type="text" name="merk_eskalator" placeholder="Merk Eskalator" id="merk_eskalator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('merk_eskalator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('merk_eskalator') }}">
                @error('merk_eskalator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>


            {{-- Asal Negara Pembuat --}}
            <div>
                <input type="text" name="asal_negara_pembuat" placeholder="Asal Negara Pembuat" id="asal_negara_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('asal_negara_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('asal_negara_pembuat') }}">
                @error('asal_negara_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tahun Pembuatan --}}
            <div>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan" id="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuatan') }}">
                @error('tahun_pembuatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>


            {{-- Melayani --}}
            <div>
                <input type="text" name="melayani" placeholder="Melayani" id="melayani" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('melayani') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('melayani') }}">
                @error('melayani')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi Eskalator --}}
            <div>
                <input type="text" name="lokasi_eskalator" placeholder="Lokasi Eskalator" id="lokasi_eskalator" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi_eskalator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi_eskalator') }}">
                @error('lokasi_eskalator')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Pagar Pelindung --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Pagar Pelindung</h2>
                <div id="pagar_pelindung-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="pagar_pelindung[]" id="pagar_pelindung" accept="image/*" multiple onchange="previewImage(this, 'pagar_pelindung-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pagar_pelindung') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('pagar_pelindung')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <h2 class="block mb-2 text-sm font-bold text-gray-700">Pemeriksaan Dimensi dan Keamanan</h2>
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
                        'tinggi' => ['label' => 'Tinggi', 'desc' => 'Pastikan tinggi handrail atau tangga sesuai standar keamanan.'],
                        'tekanan_samping' => ['label' => 'Tekanan Samping', 'desc' => 'Uji kekuatan tekanan samping untuk memastikan stabilitas struktur.'],
                        'tekanan_vertikal' => ['label' => 'Tekanan Vertikal', 'desc' => 'Periksa kemampuan menahan beban vertikal sesuai kapasitas yang ditentukan.'],
                        'pelindung_bawah' => ['label' => 'Pelindung Bawah (Skirt Panel)', 'desc' => 'Pastikan panel pelindung bawah terpasang rapat dan tidak rusak.'],
                        'kelenturan_pelindung_bawah' => ['label' => 'Kelenturan Pelindung Bawah', 'desc' => 'Pastikan pelindung bawah cukup lentur untuk menahan benturan ringan tanpa pecah.'],
                        'celah_anak_tangga' => ['label' => 'Celah Anak Tangga', 'desc' => 'Periksa jarak antar anak tangga sesuai standar agar aman bagi pengguna.'],
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

            {{-- Ban Pegangan --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Ban Pegangan</h2>
                <div id="ban_pegangan_foto-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="ban_pegangan_foto[]" id="ban_pegangan_foto" accept="image/*" multiple onchange="previewImage(this, 'ban_pegangan_foto-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ban_pegangan_foto') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('ban_pegangan_foto')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <h2 class="block mb-2 text-sm font-bold text-gray-700">Pemeriksaan Ban Pegangan</h2>
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
                        'kondisi_ban_pegangan' => [
                        'label' => 'Kondisi Ban Pegangan',
                        'desc' => 'Menilai kondisi fisik ban pegangan apakah terdapat keretakan, keausan, atau kerusakan lainnya.'
                        ],
                        'kecepatan_ban_pegangan' => [
                        'label' => 'Kecepatan Ban Pegangan',
                        'desc' => 'Memastikan kecepatan ban pegangan seimbang dengan kecepatan anak tangga untuk kenyamanan pengguna.'
                        ],
                        'lebar_ban_pegangan' => [
                        'label' => 'Lebar Ban Pegangan',
                        'desc' => 'Mengukur lebar ban pegangan agar sesuai standar keselamatan dan kenyamanan operasional.'
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

            {{-- Peralatan Pengamanan --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Peralatan Pengamanan</h2>
                <div id="peralatan_pengaman_foto-preview" class="flex flex-wrap gap-2"></div>
                <input type="file" name="peralatan_pengaman_foto[]" id="peralatan_pengaman_foto" accept="image/*" multiple onchange="previewImage(this, 'peralatan_pengaman_foto-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('peralatan_pengaman_foto') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('peralatan_pengaman_foto')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <h2 class="block mb-2 text-sm font-bold text-gray-700">Pemeriksaan Peralatan Pengaman</h2>
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
                        'kunci_pengendali' => [
                        'label' => 'Kunci Pengendali Operasi',
                        'desc' => 'Digunakan untuk mengontrol operasi eskalator secara manual dalam kondisi tertentu.'
                        ],
                        'saklar_henti' => [
                        'label' => 'Saklar Henti Darurat',
                        'desc' => 'Tombol penghenti darurat untuk mematikan eskalator segera jika terjadi bahaya.'
                        ],
                        'pengaman_rantai' => [
                        'label' => 'Peralatan Pengaman Rantai Anak Tangga / Palet',
                        'desc' => 'Melindungi rantai penggerak anak tangga dari gangguan benda asing.'
                        ],
                        'rantai_penarik' => [
                        'label' => 'Peralatan Pengaman Rantai Penarik',
                        'desc' => 'Menjamin rantai penarik tetap aman dari gangguan mekanis selama beroperasi.'
                        ],
                        'pengaman_anak_tangga' => [
                        'label' => 'Peralatan Pengaman Anak Tangga / Palet',
                        'desc' => 'Menjaga anak tangga tetap stabil dan mencegah slip selama perjalanan.'
                        ],
                        'pengaman_ban_pegangan' => [
                        'label' => 'Pengaman Ban Pegangan',
                        'desc' => 'Mencegah tangan pengguna terjepit di area ban pegangan.'
                        ],
                        'pengaman_pencegah_balik_arah' => [
                        'label' => 'Pengaman Pencegah Balik Arah',
                        'desc' => 'Mencegah eskalator berputar ke arah berlawanan secara tidak sengaja.'
                        ],
                        'pengaman_area_masuk_ban' => [
                        'label' => 'Pengaman Area Masuk Ban Pegangan',
                        'desc' => 'Melindungi area masuk ban agar tidak tersangkut benda asing.'
                        ],
                        'pengaman_pelat_sisir' => [
                        'label' => 'Pengaman Pelat Sisir',
                        'desc' => 'Mendeteksi benda yang tersangkut di area pertemuan pelat sisir dan anak tangga.'
                        ],
                        'sikat_pelindung_dalam' => [
                        'label' => 'Sikat Pelindung Dalam',
                        'desc' => 'Menghalangi kaki atau pakaian pengguna agar tidak tersangkut di sisi eskalator.'
                        ],
                        'tombol_penghenti' => [
                        'label' => 'Tombol Penghenti',
                        'desc' => 'Tombol manual untuk menghentikan eskalator dalam situasi darurat atau perawatan.'
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