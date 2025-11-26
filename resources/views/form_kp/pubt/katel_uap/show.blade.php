<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 space-y-4 bg-white rounded-lg shadow-md">

        {{-- Tanggal Pemeriksaan --}}
        <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
        <div class="flex flex-wrap justify-between w-full gap-y-4">
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide" value="{{ optional($formKpKatelUap->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block text-sm font-bold text-gray-700">Informasi Umum</h2>
            <label for="foto_informasi_umum" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpKatelUap->foto_informasi_umum; 
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

        {{-- Jenis Alat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Alat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->jenis_alat ?? '-' }}
            </div>
        </div>

        {{-- Tempat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tempat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->tempat ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Desain --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Desain</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->tekanan_desain ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Kerja --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Kerja</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->tekanan_kerja ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Uap --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Uap</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->kapasitas_uap ?? '-' }}
            </div>
        </div>

        {{-- Luas Pemanasan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Luas Pemanasan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->luas_pemanasan ?? '-' }}
            </div>
        </div>

        {{-- Work Temperature --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Work Temperature</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->work_temperature ?? '-' }}
            </div>
        </div>

        {{-- Bahan Bakar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Bahan Bakar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->bahan_bakar ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->lokasi ?? '-' }}
            </div>
        </div>


        {{-- foto_safety_valve --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Safety Device</h2>
            <label for="foto_safety_valve" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoSafetyValve = $formKpKatelUap->foto_safety_valve; 
                if ($fotoSafetyValve && is_string($fotoSafetyValve)) {
                    $fotoSafetyValve = json_decode($fotoSafetyValve, true);
                }            
            @endphp
            @if($fotoSafetyValve && count($fotoSafetyValve) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoSafetyValve as $foto)
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

        {{-- Safety Valve --}}
        <div class="grid items-center grid-cols-3 gap-4">
            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Item</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Membuka</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Menutup</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label class="block text-sm text-gray-700">Safety Valve 1</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->safety_valve1_membuka ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->safety_valve1_menutup ?? '-' }}
                </div>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label class="block text-sm text-gray-700">Safety Valve 2</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->safety_valve2_membuka ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->safety_valve2_menutup ?? '-' }}
                </div>
            </div>
        </div>
    
        {{-- Catatan Safety Valve --}}
        <div>
            <label class="block text-sm text-gray-700">Catatan Safety Valve</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->catatan_safety_valve ?? '-' }}
            </div>
        </div>

        {{-- foto_pressure_switch --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pressure Switch</h2>
            <label for="foto_pressure_switch" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPressureSwitch = $formKpKatelUap->foto_pressure_switch; 
                if ($fotoPressureSwitch && is_string($fotoPressureSwitch)) {
                    $fotoPressureSwitch = json_decode($fotoPressureSwitch, true);
                }            
            @endphp
            @if($fotoPressureSwitch && count($fotoPressureSwitch) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPressureSwitch as $foto)
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

        {{-- Pressure Switch --}}
        <div class="grid items-center grid-cols-3 gap-4">
            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Deskripsi</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Tekanan Setting</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label class="block text-sm text-gray-700">Pressure Switch On</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->pressure_switch_on_set ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->pressure_switch_on_hasil ?? '-' }}
                </div>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label class="block text-sm text-gray-700">Pressure Switch Off</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->pressure_switch_off_set ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpKatelUap->pressure_switch_off_hasil ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Catatan Pressure Switch --}}
        <div>
            <label class="block text-sm text-gray-700">Catatan Pressure Switch</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpKatelUap->catatan_pressure_switch ?? '-' }}
            </div>
        </div>  

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpKatelUap->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
