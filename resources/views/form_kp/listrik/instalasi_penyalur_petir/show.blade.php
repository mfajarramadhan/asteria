<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 space-y-4 bg-white rounded-lg shadow-md">

        {{-- Tanggal Pemeriksaan --}}
        <div>
            <label for="tanggal_pemeriksaan" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                <div class="w-full md:w-[48%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpInstalasiPenyalurPetir->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpInstalasiPenyalurPetir->foto_informasi_umum; 
                if ($fotoInformasiUmum && is_string($fotoInformasiUmum)) {
                    $fotoInformasiUmum = json_decode($fotoInformasiUmum, true);
                }            
            @endphp
            @if($fotoInformasiUmum && count($fotoInformasiUmum) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoInformasiUmum as $foto)
                        <div class="relative overflow-hidden rounded-lg group aspect-square">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Shell" class="object-contain w-full h-full transition-transform duration-500 transform group-hover:scale-110">
                            <div class="absolute inset-0 flex items-end p-6 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 to-transparent group-hover:opacity-100">
                                <div class="transition-transform duration-300 translate-y-4 group-hover:translate-y-0">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm italic text-gray-500">Tidak ada foto</p>
            @endif
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiPenyalurPetir->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Air Terminal 1 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Air Terminal</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('air_terminal1', $formKpInstalasiPenyalurPetir->air_terminal1) ?? '-' }}
            </div>
        </div>

        {{-- Air Terminal 2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Air Terminal</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('air_terminal2', $formKpInstalasiPenyalurPetir->air_terminal2) ?? '-' }}
            </div>
        </div>

        {{-- Jarak Radius Proteksi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak/Radius Proteksi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jarak_radius_proteksi', $formKpInstalasiPenyalurPetir->jarak_radius_proteksi) ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Tiang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Tiang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('tinggi_tiang', $formKpInstalasiPenyalurPetir->tinggi_tiang) ?? '-' }}
            </div>
        </div>

        {{-- Jumlah dan Jarak --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah dan Jarak</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jumlah_dan_jarak', $formKpInstalasiPenyalurPetir->jumlah_dan_jarak) ?? '-' }}
            </div>
        </div>

        {{-- Keadaan Visual Air --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Keadaan Visual Air</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('keadaan_visual_air', $formKpInstalasiPenyalurPetir->keadaan_visual_air) ?? '-' }}
            </div>
        </div>

        {{-- Down Conductor --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Down Conductor</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('down_conductor', $formKpInstalasiPenyalurPetir->down_conductor) ?? '-' }}
            </div>
        </div>

        {{-- Jumlah Down Conductor --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Down Conductor</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jumlah_down_conductor1', $formKpInstalasiPenyalurPetir->jumlah_down_conductor) ?? '-' }}
            </div>
        </div>

        {{-- Jarak Antar Kaki Penerima --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Antar Kaki Penerima</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jarak_antar_kaki_penerima', $formKpInstalasiPenyalurPetir->jarak_antar_kaki_penerima) ?? '-' }}
            </div>
        </div>

        {{-- Titik Percabangan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Titik Percabangan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('titik_percabangan', $formKpInstalasiPenyalurPetir->titik_percabangan) ?? '-' }}
            </div>
        </div>

        {{-- Luas Penampang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Luas Penampang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('luas_penampang', $formKpInstalasiPenyalurPetir->luas_penampang) ?? '-' }}
            </div>
        </div>

        {{-- Tebal Penampang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Penampang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('tebal_penampang', $formKpInstalasiPenyalurPetir->tebal_penampang) ?? '-' }}
            </div>
        </div>

        {{-- Jarak Antar Penghantar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Antar Penghantar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jarak_antar_penghantar', $formKpInstalasiPenyalurPetir->jarak_antar_penghantar) ?? '-' }}
            </div>
        </div>

        {{-- Jenis Penghantar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Penghantar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jenis_penghantar', $formKpInstalasiPenyalurPetir->jenis_penghantar) ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Bangunan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Bangunan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('tinggi_bangunan', $formKpInstalasiPenyalurPetir->tinggi_bangunan) ?? '-' }}
            </div>
        </div>

        {{-- Luas Bangunan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Luas Bangunan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('luas_bangunan', $formKpInstalasiPenyalurPetir->luas_bangunan) ?? '-' }}
            </div>
        </div>

        {{-- Earth Electrode --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Earth Electrode</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('earth_electrode', $formKpInstalasiPenyalurPetir->earth_electrode) ?? '-' }}
            </div>
        </div>

        {{-- Batang Pita Mesh --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">(Batang/Rod, Pita, Mesh)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('batang_pita_mesh', $formKpInstalasiPenyalurPetir->batang_pita_mesh) ?? '-' }}
            </div>
        </div>

        {{-- Diameter Penampang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter Penampang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('diameter_penampang', $formKpInstalasiPenyalurPetir->diameter_penampang) ?? '-' }}
            </div>
        </div>

        {{-- Kedalaman Elektroda --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kedalaman Elektroda</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('kedalaman_elektroda', $formKpInstalasiPenyalurPetir->kedalaman_elektroda) ?? '-' }}
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiPenyalurPetir->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
