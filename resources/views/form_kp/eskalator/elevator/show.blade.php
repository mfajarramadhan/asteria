 <x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
<div class="p-6 bg-white rounded-lg shadow-md space-y-6">

    {{-- =============================
        INFORMASI UMUM
    ============================== --}}
    <h2 class="text-lg font-bold border-b pb-2">Informasi Umum</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
    <label class="text-sm font-semibold">Tanggal Pemeriksaan</label>
    <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
           value="{{ optional($formKpElevator->jobOrderTool->jobOrder->tanggal_pemeriksaan)->format('d-m-Y') }}">
</div>


        <div>
            <label class="text-sm font-semibold">Nama Perusahaan</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Kapasitas Angkut</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jobOrderTool->kapasitas ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Model / Tipe</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jobOrderTool->model ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">No Seri</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jobOrderTool->no_seri ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Pabrik Pembuat</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->pabrik_pembuat ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Jenis Elevator</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jenis_elevator ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Lokasi Elevator</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->lokasi_elevator ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Tahun Pembuatan</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->tahun_pembuatan ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Asal Negara Pembuat</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->asal_negara_pembuat ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Jumlah Lantai Pemberhentian</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->jumlah_lantai_pemberhentian ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Kecepatan Elevator</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpElevator->kecepatan_elevator ?? '-' }}">
        </div>
    </div>


    {{-- Foto Mesin --}}
    <div>
        <h2 class="text-sm font-bold text-gray-700">A. Mesin</h2>
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach (($formKpElevator->foto_mesin ?? []) as $foto)
                <img src="{{ asset('storage/' . $foto) }}" class="w-32 h-32 object-cover rounded border">
            @endforeach
        </div>
    </div>

    {{-- Tabel Pemeriksaan --}}
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
                    'dudukan_mesin' => 'Dudukan Mesin',
                    'rem_mekanik' => 'Rem Mekanik',
                    'rem_electric' => 'Rem Electric',
                    'konstruksi_kamar' => 'Konstruksi Kamar Mesin',
                    'ruang_bebas_kamar' => 'Ruang Bebas Kamar Mesin',
                    'penerangan_kamar_mesin' => 'Penerangan Kamar Mesin',
                    'ventilasi_pendingin' => 'Ventilasi / Pendingin',
                    'pintu_kamar_mesin' => 'Pintu Kamar Mesin',
                    'posisi_panel' => 'Posisi Panel',
                    'alat_pelindung' => 'Alat Pelindung',
                    'pelindung_lubang_talibaja' => 'Pelindung Lubang Tali Baja',
                    'tangga_kamar_mesin' => 'Tangga Kamar Mesin',
                    'perbedaan_ketinggian' => 'Perbedaan Ketinggian',
                    'alat_pemadam_ringan' => 'APAR',
                    'elevator_tanpa_kamar' => 'Elevator Tanpa Kamar Mesin',
                ];
            @endphp

            @foreach($items as $name => $label)
            <tr>
                <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    {{-- B. Tali / Sabuk Penggantung --}}
<div class="mt-6">
    <h2 class="mb-2 text-sm font-bold text-gray-700">
        B. Tali / Sabuk Penggantung
    </h2>

    {{-- FOTO --}}
    <div class="mb-4">
        <h3 class="text-sm font-semibold text-gray-600 mb-2">Foto Dokumentasi</h3>

        <div class="flex flex-wrap gap-3">
            @php
            $fotoTali = $formKpElevator->foto_tali_penggantung ?? [];
            @endphp


            @forelse ($fotoTali as $foto)
                <img
                    src="{{ asset('storage/' . $foto) }}"
                    alt="Foto Tali/Sabuk Penggantung"
                    class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm"
                >
            @empty
                <p class="text-sm text-gray-500">Tidak ada foto tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- TABEL --}}
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
                    'tali_sabuk1' => 'Tali / Sabuk Penggantung 1',
                    'tali_sabuk2' => 'Tali / Sabuk Penggantung 2',
                    'nilai_faktor_keamanan' => 'Nilai Faktor Keamanan Tali / Sabuk',
                    'tali_penggantung_bobot_imbang' => 'Tali Penggantung dengan Bobot Imbang',
                    'tali_penggantung_tanpa_bobot' => 'Tali Penggantung tanpa Bobot Imbang',
                    'sabuk' => 'Sabuk',
                    'pengaman_tanpa_bobot' => 'Pengaman Elevator Tanpa Bobot Imbang',
                ];
            @endphp

            @foreach($items as $name => $label)
            <tr>
                <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    {{-- C. Teromol --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">C. Teromol</h2>

        {{-- Preview Foto Teromol --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @foreach(($formKpElevator->foto_teromol ?? []) as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Teromol">
            @endforeach
            <span class="text-gray-500 text-sm">Tidak ada foto teromol</span>
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

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
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
           @foreach(($formKpElevator->foto_bangun_ruang_luncur ?? []) as $foto)

            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Bangunan Ruang Luncur">
            @endforeach
            <span class="text-gray-500 text-sm">Tidak ada foto bangunan ruang luncur</span>
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

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
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
            @foreach(($formKpElevator->foto_komponen_kereta ?? []) as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Kereta">
            @endforeach
            <span class="text-gray-500 text-sm">Tidak ada foto kereta</span>
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
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
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

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
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

            @foreach($items as $name => $label)
            <tr>
                <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
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

        {{-- F. Governor dan Rem Pengaman Kereta --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">F. Governor dan Rem Pengaman Kereta</h2>

        {{-- Preview Foto governor --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @foreach(($formKpElevator->foto_governor_rem ?? []) as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Governor dan Rem Pengaman Kereta">
            @endforeach
            <span class="text-gray-500 text-sm">Tidak ada Foto Governor dan Rem Pengaman Kereta</span>
        </div>
    </div>
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

            @foreach($items as $name => $label)
            <tr>
                <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>

                {{-- Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Tidak Memenuhi --}}
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>

                {{-- Keterangan --}}
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- G. Bobot Imbang, Rel Pemandu Dan Peredam --}}
    <div>
        <h2 class="block mb-1 text-sm font-bold text-gray-700">G. Bobot Imbang, Rel Pemandu Dan Peredam</h2>

        {{-- Preview Foto Bobot Imbang, Rel Pemandu Dan Peredam --}}
        <div class="flex flex-wrap gap-2 mb-2">
            @foreach(($formKpElevator->foto_bobot_imbang ?? []) as $foto)
            <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Teromol">
            @endforeach
            <span class="text-gray-500 text-sm">Tidak ada foto Bobot Imbang, Rel Pemandu Dan Peredam</span>
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
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{-- G. Instalasi Listrik --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">H. Instalasi Listrik</h2>
    
            {{-- Preview Foto Instalasi Listrik --}}
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach(($formKpElevator->foto_instalasi_listrik ?? []) as $foto)
                <img src="{{ asset('storage/'.$foto) }}" class="w-32 h-32 object-cover rounded-md border" alt="Foto Instalasi Listrik">
                @endforeach
                <span class="text-gray-500 text-sm">Tidak ada foto Instalasi Listrik</span>
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
    'standar_rangkaian' => 'Standar Rangkaian Instalasi Listrik, Perlengkapan dan Pengaman',
    'panel_listrik' => 'Panel Listrik',
    'catu_daya_ard' => 'Catu Daya Pengganti Listrik Otomatis (ARD)',
    'kabel_grounding' => 'Kabel Grounding',
    'alarm_kebakaran' => 'Alarm Kebakaran',
];
@endphp    
                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">
                            <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            <h2 class="block mb-1 text-sm font-bold text-gray-700">Elevator Untuk Penanggulangan Kebakaran</h2>
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
    'catu_daya_cadangan' => 'Catu Daya Cadangan',
    'pengoperasian_khusus' => 'Pengoperasian Khusus',
    'saklar_kebakaran' => 'Saklar Kebakaran',
    'label_elevator_kebakaran' => 'Label Elevator Penanggulangan Kebakaran',
    'ketahanan_instalasi_api' => 'Ketahanan Instalasi Listrik Terhadap Api',
    'dinding_luncur' => 'Dinding Luncur',
    'ukuran_sangkar' => 'Ukuran Sangkar',
    'ukuran_pintu_kereta' => 'Ukuran Pintu Kereta',
    'waktu_tempuh' => 'Waktu Tempuh',
    'lantai_evakuasi' => 'Lantai Evakuasi',
];
@endphp

    
                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">
                            <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <h2 class="block mb-1 text-sm font-bold text-gray-700">Elevator Untuk Disabilitas</h2>
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
    'panel_operasi_disabilitas' => 'Panel Operasi Disabilitas',
    'tinggi_panel_operasi' => 'Tinggi Panel Operasi',
    'waktu_bukaan_pintu' => 'Waktu Bukaan Pintu',
    'lebar_bukaan_pintu' => 'Ukuran Lebar Bukaan Pintu',
    'informasi_operasi' => 'Informasi Operasi',
    'label_operator_disabilitas' => 'Label "Operator Disabilitas"',
];

@endphp


                @foreach ($items as $name => $label)
                <tr>
                    <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 text-center border">
                        <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                    </td>
                    <td class="px-3 py-2 border">
                        <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <h2 class="block mb-1 text-sm font-bold text-gray-700">Sensor Gempa</h2>
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
    'sensor_gempa_lebih_10lt_40m' => 'Lebih dari 10 lt. / 40 meter',
    'fungsi_input_signal_sensor_gempa' => 'Fungsi Input Signal Sensor Gempa',
];


@endphp


            @foreach ($items as $name => $label)
            <tr>
                <td class="px-3 py-2 border font-medium w-[50%]">{{ $label }}</td>
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Memenuhi' ? 'checked' : '' }}>
                </td>
                <td class="px-3 py-2 text-center border">
                    <input type="radio" disabled {{ $formKpElevator->$name == 'Tidak Memenuhi' ? 'checked' : '' }}>
                </td>
                <td class="px-3 py-2 border">
                    <span>{{ $formKpElevator->{$name.'_keterangan'} ?? '-' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

 {{-- =============================
        CATATAN
    ============================== --}}
    <div>
        <h2 class="text-lg font-bold border-b pb-2">Catatan</h2>
        <div class="bg-gray-100 p-4 rounded mt-2">
            {{ $formKpElevator->catatan ?? '-' }}
        </div>
    </div>

    {{-- =============================
        TOMBOL AKSI
    ============================== --}}
    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-500 text-white rounded">Kembali</a>
        <a href="{{ route('form_kp.eskalator.elevator.edit', $formKpElevator->id) }}"
            class="px-4 py-2 bg-blue-600 text-white rounded">Edit</a>
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