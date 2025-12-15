<x-layout>
<x-slot:title>{{ $title }}</x-slot:title>
<x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

<div class="p-6 bg-white rounded-lg shadow-md">

<form
    action="{{ route('form_kp.eskalator.eskalator.update', $formKpEskalator->id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
    onsubmit="return confirm('Simpan perubahan data?')"
>
    @csrf
    @method('PUT')


{{-- =========================
    TANGGAL PEMERIKSAAN
========================= --}}
<div class="w-full md:w-[50%]">
    <div class="relative">
        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        <input required id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan"
               value="{{ old('tanggal_pemeriksaan', $formKpEskalator->tanggal_pemeriksaan?->format('d-m-Y')) }}"
               datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today
               type="text"
               class="bg-gray-50 border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
    </div>
    @error('tanggal_pemeriksaan')
    <div class="text-xs text-red-600">
        {{ $message }}
    </div>
    @enderror
</div>


{{-- =========================
    INFORMASI UMUM (FOTO)
========================= --}}
<div>
    <h2 class="text-sm font-bold text-gray-700 mb-1">Informasi Umum</h2>
    <input type="file" name="foto_informasi_umum[]" multiple
        onchange="previewImage(this, 'foto_informasi_umum-preview')"
        class="w-full md:w-1/2 border rounded p-2">
    <div id="foto_informasi_umum-preview" class="flex gap-2 mt-2"></div>
</div>

{{-- =========================
    DATA UMUM (DISABLED)
========================= --}}
@foreach ([
    'Nama Perusahaan' => $formKpEskalator->jobOrderTool->jobOrder->nama_perusahaan,
    'Kapasitas' => $formKpEskalator->jobOrderTool->kapasitas,
    'Model / Tipe' => $formKpEskalator->jobOrderTool->model,
    'No Seri' => $formKpEskalator->jobOrderTool->no_seri,
] as $label => $value)
<div>
    <label class="block text-sm font-medium">{{ $label }}</label>
    <input type="text" disabled
        class="w-full bg-gray-200 border border-gray-300 rounded-lg p-2.5 text-sm"
        value="{{ $value }}">
</div>
@endforeach

{{-- =========================
    INPUT TEKS
========================= --}}
@php
$textFields = [
    'pabrik_pembuat'=>'Pabrik Pembuat',
    'jenis_eskalator'=>'Jenis Eskalator',
    'lokasi_eskalator'=>'Lokasi Eskalator',
    'tahun_pembuatan'=>'Tahun Pembuatan',
    'asal_negara_pembuat'=>'Asal Negara Pembuat',
    'melayani'=>'Melayani'
];
@endphp

@foreach($textFields as $field => $label)
<div>
    <label class="block text-sm font-medium">{{ $label }}</label>
    <input type="text"
        name="{{ $field }}"
        class="w-full border rounded p-2 text-sm"
        value="{{ old($field, $formKpEskalator->$field) }}">
</div>
@endforeach

{{-- =========================
    FOTO PAGAR PELINDUNG
========================= --}}
<div>
    <h2 class="text-sm font-bold text-gray-700 mb-1">Foto Pagar Pelindung</h2>

    @if($formKpEskalator->pagar_pelindung)
        <div class="flex gap-2 mb-2">
            @foreach(json_decode($formKpEskalator->pagar_pelindung, true) as $foto)
                <img src="{{ asset('storage/'.$foto) }}" class="max-h-24 rounded border">
            @endforeach
        </div>
    @endif

    <input type="file" name="pagar_pelindung[]" multiple
        onchange="previewImage(this,'pagar_pelindung-preview')"
        class="w-full md:w-1/2 border rounded p-2">
    <div id="pagar_pelindung-preview" class="flex gap-2 mt-2"></div>
</div>

{{-- =========================
    TABEL PEMERIKSAAN
========================= --}}
@php
$sections = [
    'Dimensi' => [
        'tinggi' => 'Tinggi',
        'tekanan_samping' => 'Tekanan Samping',
        'tekanan_vertikal' => 'Tekanan Vertikal',
        'pelindung_bawah' => 'Pelindung Bawah (Skirt Panel)',
        'kelenturan_pelindung_bawah' => 'Kelenturan Pelindung Bawah',
        'celah_anak_tangga' => 'Celah Anak Tangga',
    ],
    'Ban Pegangan' => [
        'kondisi_ban_pegangan' => 'Kondisi Ban Pegangan',
        'kecepatan_ban_pegangan' => 'Kecepatan Ban Pegangan',
        'lebar_ban_pegangan' => 'Lebar Ban Pegangan',
    ],
    'Peralatan Pengaman' => [
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
    ],
];
@endphp

@foreach($sections as $titleSection => $items)
<div class="mt-8">

    <h2 class="font-bold mb-3">{{ $titleSection }}</h2>

    <div class="grid grid-cols-5 text-sm font-semibold mb-2">
        <div>Komponen</div>
        <div class="text-center"></div>
        <div class="text-center">Memenuhi</div>
        <div class="text-center">Tidak</div>
        <div>Keterangan</div>
    </div>

    @foreach($items as $field => $label)
    <div class="grid grid-cols-5 gap-2 items-center text-sm mb-2">

        <div>{{ $label }}</div>

        {{-- TOOLTIP --}}
        <div class="relative text-center">
            <span
                class="text-gray-400 cursor-pointer select-none"
                onmouseenter="showTip('{{ $field }}')"
                onmouseleave="hideTip('{{ $field }}')">?</span>

            <div id="tip-{{ $field }}"
                class="hidden absolute z-10 -top-2 left-6 w-56 bg-gray-800 text-white text-xs rounded p-2 shadow">
                Keterangan pemeriksaan {{ strtolower($label) }}
            </div>
        </div>

        <div class="text-center">
            <input type="radio" name="{{ $field }}" value="Memenuhi"
                {{ old($field, $formKpEskalator->$field) == 'Memenuhi' ? 'checked' : '' }}>
        </div>

        <div class="text-center">
            <input type="radio" name="{{ $field }}" value="Tidak Memenuhi"
                {{ old($field, $formKpEskalator->$field) == 'Tidak Memenuhi' ? 'checked' : '' }}>
        </div>

        <div>
            <input type="text"
                name="{{ $field }}_keterangan"
                class="w-full border rounded p-1 text-xs"
                value="{{ old($field.'_keterangan', $formKpEskalator->{$field.'_keterangan'}) }}">
        </div>

    </div>
    @endforeach

</div>
@endforeach

{{-- =========================
    SUBMIT
========================= --}}
<div class="pt-6 flex justify-end">
    <button
        type="submit"
        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold"
    >
        Update
    </button>
</div>


</form>
</div>

{{-- =========================
    SCRIPT
========================= --}}
<script>
function previewImage(input, target) {
    const el = document.getElementById(target);
    el.innerHTML = '';
    [...input.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'max-h-24 rounded border';
            el.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function showTip(id) {
    document.getElementById('tip-' + id).classList.remove('hidden');
}
function hideTip(id) {
    document.getElementById('tip-' + id).classList.add('hidden');
}
</script>

</x-layout>
