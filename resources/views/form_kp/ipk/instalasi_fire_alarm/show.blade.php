<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md space-y-4">

        {{-- Tanggal Pemeriksaan --}}
        <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
        <input type="text" value="{{ $form->tanggal_pemeriksaan }}"
            class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>

        {{-- Nama Perusahaan --}}
        <input type="text" value="{{ $form->nama_perusahaan }}"
            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>

        <h2 class="block text-sm font-bold text-gray-700">Spesifikasi</h2>
        <input type="text" value="{{ $form->jenis_eskalator }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>
        <input type="text" value="{{ $form->merk_eskalator }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>
        <input type="text" value="{{ $form->nomor_seri }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>
        <input type="text" value="{{ $form->kapasitas }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>
        <input type="text" value="{{ $form->melayani }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>
        <input type="text" value="{{ $form->lokasi_eskalator }}" class="w-full mt-1 bg-gray-100 border rounded-md px-3 py-2 cursor-not-allowed" readonly>

        {{-- Pagar Pelindung Foto --}}
        <h2 class="block mb-1 text-sm font-bold text-gray-700">Pagar Pelindung</h2>
        <div class="flex flex-wrap gap-2">
            @if ($form->pagar_pelindung)
            @foreach ($form->pagar_pelindung as $img)
            <img src="{{ asset('storage/'.$img) }}" class="max-h-32 rounded border m-1">
            @endforeach
            @else
            <p class="text-sm text-gray-500">Tidak ada foto</p>
            @endif
        </div>

        {{-- Tabel Pemeriksaan Dimensi --}}
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
                    'tinggi' => 'Tinggi',
                    'tekanan_samping' => 'Tekanan Samping',
                    'tekanan_vertikal' => 'Tekanan Vertikal',
                    'pelindung_bawah' => 'Pelindung Bawah',
                    'kelenturan_pelindung_bawah' => 'Kelenturan Pelindung Bawah',
                    'celah_anak_tangga' => 'Celah Anak Tangga',
                    ];
                    @endphp

                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">{{ $form[$name.'_keterangan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Ban Pegangan --}}
        <h2 class="block mb-1 text-sm font-bold text-gray-700">Ban Pegangan</h2>
        <div class="flex flex-wrap gap-2">
            @if ($form->ban_pegangan_foto)
            @foreach ($form->ban_pegangan_foto as $img)
            <img src="{{ asset('storage/'.$img) }}" class="max-h-32 rounded border m-1">
            @endforeach
            @else
            <p class="text-sm text-gray-500">Tidak ada foto</p>
            @endif
        </div>

        {{-- Pemeriksaan Ban Pegangan --}}
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
                    'kondisi_ban_pegangan' => 'Kondisi Ban Pegangan',
                    'kecepatan_ban_pegangan' => 'Kecepatan Ban Pegangan',
                    'lebar_ban_pegangan' => 'Lebar Ban Pegangan',
                    ];
                    @endphp

                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">{{ $form[$name.'_keterangan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Peralatan Pengaman Foto --}}
        <h2 class="block mb-1 text-sm font-bold text-gray-700">Peralatan Pengaman</h2>
        <div class="flex flex-wrap gap-2">
            @if ($form->peralatan_pengaman_foto)
            @foreach ($form->peralatan_pengaman_foto as $img)
            <img src="{{ asset('storage/'.$img) }}" class="max-h-32 rounded border m-1">
            @endforeach
            @else
            <p class="text-sm text-gray-500">Tidak ada foto</p>
            @endif
        </div>

        {{-- Pemeriksaan Peralatan Pengaman --}}
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
                    'kunci_pengendali' => 'Kunci Pengendali Operasi',
                    'saklar_henti' => 'Saklar Henti Darurat',
                    'pengaman_rantai' => 'Pengaman Rantai Anak Tangga',
                    'rantai_penarik' => 'Pengaman Rantai Penarik',
                    'pengaman_anak_tangga' => 'Pengaman Anak Tangga',
                    'pengaman_ban_pegangan' => 'Pengaman Ban Pegangan',
                    'pengaman_pencegah_balik_arah' => 'Pencegah Balik Arah',
                    'pengaman_area_masuk_ban' => 'Pengaman Area Masuk Ban',
                    'pengaman_pelat_sisir' => 'Pengaman Pelat Sisir',
                    'sikat_pelindung_dalam' => 'Sikat Pelindung Dalam',
                    'tombol_penghenti' => 'Tombol Penghenti',
                    ];
                    @endphp

                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $form->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">{{ $form[$name.'_keterangan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-layout>