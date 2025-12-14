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
                value="{{ optional($formKpEskalator->tanggal_pemeriksaan)->format('d-m-Y') }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Nama Perusahaan</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Kapasitas</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->jobOrderTool->kapasitas ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Model / Tipe</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->jobOrderTool->model ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">No Seri</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->jobOrderTool->no_seri ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Pabrik Pembuat</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->pabrik_pembuat ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Jenis Eskalator</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->jenis_eskalator ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Lokasi Eskalator</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->lokasi_eskalator ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Tahun Pembuatan</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->tahun_pembuatan ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Asal Negara Pembuat</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->asal_negara_pembuat ?? '-' }}">
        </div>

        <div>
            <label class="text-sm font-semibold">Melayani</label>
            <input type="text" readonly class="w-full bg-gray-200 border rounded p-2"
                value="{{ $formKpEskalator->melayani ?? '-' }}">
        </div>
    </div>

   {{-- =============================
    FOTO PAGAR PELINDUNG
============================= --}}
<h2 class="text-lg font-bold border-b pb-2 mt-6">Foto Pagar Pelindung</h2>

@if($formKpEskalator->pagar_pelindung)
    <div class="flex flex-wrap gap-3 mt-3">
        @foreach(json_decode($formKpEskalator->pagar_pelindung, true) as $foto)
            <img
                src="{{ asset('storage/'.$foto) }}"
                alt="Foto Pagar Pelindung"
                class="max-h-32 rounded border shadow"
            >
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-500 italic mt-2">
        Tidak ada foto pagar pelindung
    </p>
@endif


    {{-- =============================
        PEMERIKSAAN DIMENSI & KEAMANAN
    ============================== --}}
    <h2 class="text-lg font-bold border-b pb-2">Pemeriksaan Dimensi & Keamanan</h2>

    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Item</th>
                <th class="border p-2">Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach([
                'tinggi' => 'Tinggi',
                'tekanan_samping' => 'Tekanan Samping',
                'tekanan_vertikal' => 'Tekanan Vertikal',
                'pelindung_bawah' => 'Pelindung Bawah',
                'kelenturan_pelindung_bawah' => 'Kelenturan Pelindung Bawah',
                'celah_anak_tangga' => 'Celah Anak Tangga'
            ] as $field => $label)
            <tr>
                <td class="border p-2">{{ $label }}</td>
                <td class="border p-2 font-semibold">
                    @if($formKpEskalator->$field === 'Memenuhi')
                        <span class="text-green-600">✔ Memenuhi</span>
                    @elseif($formKpEskalator->$field === 'Tidak Memenuhi')
                        <span class="text-red-600">✖ Tidak Memenuhi</span>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
{{-- =============================
    BAN PEGANGAN
============================= --}}
<h2 class="text-lg font-bold border-b pb-2">Ban Pegangan</h2>

{{-- Foto Ban Pegangan --}}
@if($formKpEskalator->ban_pegangan_foto)
    <div class="flex flex-wrap gap-3 mt-3">
        @foreach(json_decode($formKpEskalator->ban_pegangan_foto, true) as $foto)
            <img src="{{ asset('storage/'.$foto) }}"
                 class="max-h-32 rounded border shadow">
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-500 italic mt-2">Tidak ada foto ban pegangan</p>
@endif

{{-- Tabel Pemeriksaan Ban Pegangan --}}
<div class="overflow-x-auto mt-4">
    <table class="min-w-full text-sm text-left border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Komponen</th>
                <th class="border px-3 py-2">Hasil</th>
                <th class="border px-3 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach([
                'kondisi_ban_pegangan' => 'Kondisi Ban Pegangan',
                'kecepatan_ban_pegangan' => 'Kecepatan Ban Pegangan',
                'lebar_ban_pegangan' => 'Lebar Ban Pegangan',
            ] as $field => $label)
                <tr>
                    <td class="border px-3 py-2 font-medium">{{ $label }}</td>
                    <td class="border px-3 py-2 font-semibold">
                        @if($formKpEskalator->$field === 'Memenuhi')
                            <span class="text-green-600">✔ Memenuhi</span>
                        @elseif($formKpEskalator->$field === 'Tidak Memenuhi')
                            <span class="text-red-600">✖ Tidak Memenuhi</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-3 py-2">
                        {{ $formKpEskalator->{$field.'_keterangan'} ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- =============================
    PERALATAN PENGAMAN
============================= --}}
<h2 class="text-lg font-bold border-b pb-2 mt-8">Peralatan Pengaman</h2>

{{-- Foto Peralatan Pengaman --}}
@if($formKpEskalator->peralatan_pengaman_foto)
    <div class="flex flex-wrap gap-3 mt-3">
        @foreach(json_decode($formKpEskalator->peralatan_pengaman_foto, true) as $foto)
            <img src="{{ asset('storage/'.$foto) }}"
                 class="max-h-32 rounded border shadow">
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-500 italic mt-2">Tidak ada foto peralatan pengaman</p>
@endif

{{-- Tabel Pemeriksaan Peralatan Pengaman --}}
<div class="overflow-x-auto mt-4">
    <table class="min-w-full text-sm text-left border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Komponen</th>
                <th class="border px-3 py-2">Hasil</th>
                <th class="border px-3 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach([
                'kunci_pengendali' => 'Kunci Pengendali Operasi',
                'saklar_henti' => 'Saklar Henti Darurat',
                'pengaman_rantai' => 'Pengaman Rantai Anak Tangga / Palet',
                'rantai_penarik' => 'Pengaman Rantai Penarik',
                'pengaman_anak_tangga' => 'Pengaman Anak Tangga / Palet',
                'pengaman_ban_pegangan' => 'Pengaman Ban Pegangan',
                'pengaman_pencegah_balik_arah' => 'Pengaman Pencegah Balik Arah',
                'pengaman_area_masuk_ban' => 'Pengaman Area Masuk Ban Pegangan',
                'pengaman_pelat_sisir' => 'Pengaman Pelat Sisir',
                'sikat_pelindung_dalam' => 'Sikat Pelindung Dalam',
                'tombol_penghenti' => 'Tombol Penghenti',
            ] as $field => $label)
                <tr>
                    <td class="border px-3 py-2 font-medium">{{ $label }}</td>
                    <td class="border px-3 py-2 font-semibold">
                        @if($formKpEskalator->$field === 'Memenuhi')
                            <span class="text-green-600">✔ Memenuhi</span>
                        @elseif($formKpEskalator->$field === 'Tidak Memenuhi')
                            <span class="text-red-600">✖ Tidak Memenuhi</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-3 py-2">
                        {{ $formKpEskalator->{$field.'_keterangan'} ?? '-' }}
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
            {{ $formKpEskalator->catatan ?? '-' }}
        </div>
    </div>

    {{-- =============================
        TOMBOL AKSI
    ============================== --}}
    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-500 text-white rounded">Kembali</a>
        <a href="{{ route('form_kp.eskalator.eskalator.edit', $formKpEskalator->id) }}"
            class="px-4 py-2 bg-blue-600 text-white rounded">Edit</a>
    </div>

</div>

</x-layout>
