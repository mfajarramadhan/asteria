<x-layout>
<x-slot:title>{{ $title }}</x-slot:title>
<x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>


<div class="p-4 bg-white rounded-lg shadow-md">
<form action="{{ route('form_kp.eskalator.eskalator.update', [$jobOrderTool->id, $eskalator->id]) }}"
method="POST"
class="space-y-4"
enctype="multipart/form-data"
onsubmit="return confirm('Simpan perubahan data?')">
@csrf
@method('PUT')


{{-- ================= TANGGAL PEMERIKSAAN ================= --}}
<h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
<div class="w-full md:w-[50%]">
<input name="tanggal_pemeriksaan"
type="text"
datepicker datepicker-autohide datepicker-format="dd-mm-yyyy"
class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5"
value="{{ old('tanggal_pemeriksaan', $eskalator->tanggal_pemeriksaan) }}">
</div>


{{-- ================= FOTO INFORMASI UMUM ================= --}}
<div>
<h2 class="block mb-1 text-sm font-bold text-gray-700">Informasi Umum</h2>
<div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2"></div>
<input type="file" name="foto_informasi_umum[]" multiple
onchange="previewImage(this, 'foto_informasi_umum-preview')"
class="block w-full lg:w-[50%] px-3 py-2 mt-1 border rounded-md">
</div>
{{-- ================= DATA UMUM (DISABLED) ================= --}}
<div>
<label class="block text-sm font-medium">Nama Perusahaan</label>
<input type="text" disabled class="w-full bg-gray-200 rounded" value="{{ $jobOrderTool->jobOrder->nama_perusahaan }}">
</div>
<div>
<label class="block text-sm font-medium">Kapasitas</label>
<input type="text" disabled class="w-full bg-gray-200 rounded" value="{{ $jobOrderTool->kapasitas }}">
</div>
<div>
<label class="block text-sm font-medium">Model / Tipe</label>
<input type="text" disabled class="w-full bg-gray-200 rounded" value="{{ $jobOrderTool->model }}">
</div>
<div>
<label class="block text-sm font-medium">No Seri</label>
<input type="text" disabled class="w-full bg-gray-200 rounded" value="{{ $jobOrderTool->no_seri }}">
</div>


{{-- ================= INPUT TEKS ================= --}}
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


@foreach($textFields as $name=>$label)
<div>
<label class="block text-sm font-medium">{{ $label }}</label>
<input type="text" name="{{ $name }}" class="w-full border rounded px-3 py-2"
value="{{ old($name, $eskalator->$name) }}">
</div>
@endforeach

            {{-- Gambar (preview lama) --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Foto Pagar Pelindung (Opsional)</h2>
                @if($formKpEskalator->pagar_pelindung)
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach(json_decode($formKpEskalator->pagar_pelindung, true) as $foto)
                    <img src="{{ asset('storage/'.$foto) }}" class="max-h-32 rounded border">
                    @endforeach
                </div>
                @endif
                <input type="file" name="pagar_pelindung[]" multiple accept="image/*"
                    onchange="previewImage(this, 'pagar_pelindung-preview')"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm">
                <div id="pagar_pelindung-preview" class="flex flex-wrap gap-2"></div>
            </div>

            {{-- ================= TABEL PEMERIKSAAN ================= --}}
@php
$tables = [
'dimensi' => [
'tinggi','tekanan_samping','tekanan_vertikal','pelindung_bawah','kelenturan_pelindung_bawah','celah_anak_tangga'
],
'ban' => ['kondisi_ban_pegangan','kecepatan_ban_pegangan','lebar_ban_pegangan'],
'pengaman' => [
'kunci_pengendali','saklar_henti','pengaman_rantai','rantai_penarik','pengaman_anak_tangga','pengaman_ban_pegangan','pengaman_pencegah_balik_arah','pengaman_area_masuk_ban','pengaman_pelat_sisir','sikat_pelindung_dalam','tombol_penghenti'
]
];
@endphp


@foreach($tables as $section=>$items)
<h2 class="font-bold mt-4">Pemeriksaan {{ ucfirst($section) }}</h2>
<table class="w-full border text-sm">
@foreach($items as $item)
<tr>
<td class="border px-2">{{ ucwords(str_replace('_',' ',$item)) }}</td>
<td class="border text-center"><input type="radio" name="{{ $item }}" value="Memenuhi" {{ old($item, $eskalator->$item)=='Memenuhi'?'checked':'' }}></td>
<td class="border text-center"><input type="radio" name="{{ $item }}" value="Tidak Memenuhi" {{ old($item, $eskalator->$item)=='Tidak Memenuhi'?'checked':'' }}></td>
<td class="border"><input type="text" name="{{ $item }}_keterangan" class="w-full border rounded"
value="{{ old($item.'_keterangan', $eskalator->{$item.'_keterangan'}) }}"></td>
</tr>
@endforeach
</table>
@endforeach


<button class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Update</button>
</form>

            {{-- Tombol Simpan --}}
            <button
                class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-green-900 to-green-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Perbarui
            </button>
        </form>
    </div>

    <script>
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
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</x-layout>