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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpCargoLift->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpCargoLift->foto_informasi_umum; 
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
                {{ $formKpCargoLift->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis Alat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Alat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->jenis_alat ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpCargoLift->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Angkat --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">
                    Tinggi Angkat
                </label>
            </div>

            {{-- Right: SHOW --}}
            <div class="space-y-4">

                {{-- Tinggi Angkat (Meter) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Meter</label>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->tinggi_angkat_meter ?? '-' }}
                    </div>
                </div>

                {{-- Tinggi Angkat (Lantai) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lantai</label>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->tinggi_angkat_lantai ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

        {{-- Kecepatan Angkat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Angkat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpCargoLift->kecepatan_angkat ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Pondasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Pondasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpCargoLift->dimensi_pondasi ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Sangkar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Sangkar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpCargoLift->dimensi_sangkar ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Ruang Luncur --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Ruang Luncur</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpCargoLift->dimensi_ruang_luncur ?? '-' }}
            </div>
        </div>

        {{-- foto_rantai --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoRantai = $formKpCargoLift->foto_rantai; 
                if ($fotoRantai && is_string($fotoRantai)) {
                    $fotoRantai = json_decode($fotoRantai, true);
                }            
            @endphp
            @if($fotoRantai && count($fotoRantai) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoRantai as $foto)
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

        <div class="grid grid-cols-2 gap-4">
            {{-- Left: Image --}}
            <div class="flex flex-col items-start justify-start">
                <div class="flex justify-start w-full">
                    <img src="{{ asset('assets/image/papa/chain.png') }}" alt="Rantai Image" class="object-contain h-full rounded-md shadow-md">
                </div>

                <label class="block mt-2 text-sm font-medium text-gray-700">
                    Panjang 1 Meter Rantai
                </label>
            </div>

            {{-- Right: Show Values --}}
            <div class="space-y-4">
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai4 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai5 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_rantai6 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_wire_rope --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Wire Rope/Tali Kawat Baja/Sling</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoWireRope = $formKpCargoLift->foto_wire_rope; 
                if ($fotoWireRope && is_string($fotoWireRope)) {
                    $fotoWireRope = json_decode($fotoWireRope, true);
                }            
            @endphp
            @if($fotoWireRope && count($fotoWireRope) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoWireRope as $foto)
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

        <div class="grid grid-cols-2 gap-4">
            {{-- Left: Image --}}
            <div class="flex flex-col items-start justify-start">
                <div class="flex justify-start w-full">
                    <img src="{{ asset('assets/image/papa/wire.png') }}" alt="Kecepatan Image" class="object-contain h-full rounded-md shadow-md">
                </div>

                <label class="block mt-2 text-sm font-medium text-gray-700">
                    Panjang Wire Rope
                </label>
            </div>

            {{-- Right: Show Values --}}
            <div class="space-y-4">
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope4 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope5 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpCargoLift->panjang_wire_rope6 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_hook --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Hook/Kait</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoHook = $formKpCargoLift->foto_hook; 
                if ($fotoHook && is_string($fotoHook)) {
                    $fotoHook = json_decode($fotoHook, true);
                }            
            @endphp
            @if($fotoHook && count($fotoHook) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoHook as $foto)
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

        <div class="grid grid-cols-2 gap-4">
            {{-- Left: Image --}}
            <div class="flex flex-col items-start justify-start">
                <div class="flex justify-start w-full">
                    <img src="{{ asset('assets/image/papa/hook.png') }}" alt="Hook Image" class="object-contain h-full rounded-md shadow-md">
                </div>

                <label class="block mt-2 text-sm font-medium text-gray-700">
                    Panjang Tali Kait
                </label>
            </div>

            {{-- Right: Show Values --}}
            <div class="space-y-4">
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookA ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookAi ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookHa ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookB ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookBi ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookHb ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookW_C ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_hookD ?? '-' }}
                </div>
            </div>
        </div>

        {{-- foto_pulley --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pulley</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPulley = $formKpCargoLift->foto_pulley; 
                if ($fotoPulley && is_string($fotoPulley)) {
                    $fotoPulley = json_decode($fotoPulley, true);
                }            
            @endphp
            @if($fotoPulley && count($fotoPulley) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPulley as $foto)
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

        <div class="grid grid-cols-2 gap-4">
            {{-- Left: Image --}}
            <div class="flex flex-col items-start justify-start">
                <div class="flex justify-start w-full">
                    <img src="{{ asset('assets/image/papa/pulley.png') }}" alt="Pulley Image" class="object-contain h-full rounded-md shadow-md">
                </div>

                <label class="block mt-2 text-sm font-medium text-gray-700">
                    Panjang Pulley
                </label>
            </div>

            {{-- Right: Show Values --}}
            <div class="space-y-4">
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_pulleyA ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_pulleyB ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_pulleyC ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_pulleyD ?? '-' }}
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpCargoLift->panjang_pulleyE ?? '-' }}
                </div>
            </div>
        </div>

        {{-- foto_performance --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Uji Penampilan/Peroformance</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPerformance = $formKpCargoLift->foto_performance; 
                if ($fotoPerformance && is_string($fotoPerformance)) {
                    $fotoPerformance = json_decode($fotoPerformance, true);
                }            
            @endphp
            @if($fotoPerformance && count($fotoPerformance) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPerformance as $foto)
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

        {{-- Uji Performance --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-5 gap-4 min-w-[700px]">

                {{-- Header --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hoisting: Naik/Turun *)</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Jenis Uji: Beban/Tanpa Beban*)</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Bobot Beban</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Indikasi Kerusakan/ Kekurangan</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>

                {{-- Baris 1 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hoisting_naik_turun1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->jenis_uji1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->bobot_beban1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->indikasi_kerusakan1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hasil_performance1 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 2 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hoisting_naik_turun2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->jenis_uji2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->bobot_beban2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->indikasi_kerusakan2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hasil_performance2 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 3 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hoisting_naik_turun3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->jenis_uji3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->bobot_beban3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->indikasi_kerusakan3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpCargoLift->hasil_performance3 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_loadtest --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
            <label class="block mb-1 text-xs italic font-normal text-gray-700">*) Amati keseluruhan apakah terjadi crack, deformasi, bocor, putus, rusak, dll.</label>
            <label class="block mb-1 text-xs italic font-normal text-gray-700">*) Fungsi kerja komponen safety device/indicator, sistem mekanis, rem, tenaga penggerak & rangkaian kekuatan konstruksi</label>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoLoadTest = $formKpCargoLift->foto_loadtest; 
                if ($fotoLoadTest && is_string($fotoLoadTest)) {
                    $fotoLoadTest = json_decode($fotoLoadTest, true);
                }            
            @endphp
            @if($fotoLoadTest && count($fotoLoadTest) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoLoadTest as $foto)
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

        {{-- Uji Load Test --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">

                {{-- Header --}}
                <div class="font-bold text-center text-gray-700">Statis & Dinamis *)</div>
                <div class="font-bold text-center text-gray-700">Tinggi Angkat Hook</div>
                <div class="font-bold text-center text-gray-700">SWL x Beban Uji Load Chart</div>
                <div class="font-bold text-center text-gray-700">Hoisting</div>
                <div class="font-bold text-center text-gray-700">Hasil</div>
                <div class="font-bold text-center text-gray-700">Keterangan</div>

                {{-- Row 1 --}}
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->statis_dinamis1 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->tinggi_angkat_hook1 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->swl_beban_uji1 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hoisting1 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hasil1 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->keterangan1 ?? '-' }}
                </div>

                {{-- Row 2 --}}
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->statis_dinamis2 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->tinggi_angkat_hook2 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->swl_beban_uji2 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hoisting2 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hasil2 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->keterangan2 ?? '-' }}
                </div>

                {{-- Row 3 --}}
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->statis_dinamis3 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->tinggi_angkat_hook3 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->swl_beban_uji3 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hoisting3 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->hasil3 ?? '-' }}
                </div>
                <div class="px-3 py-2 bg-gray-200 border border-gray-400 rounded">
                    {{ $formKpCargoLift->keterangan3 ?? '-' }}
                </div>
            </div>
        </div>

        {{-- foto_defleksi --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Defleksi</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoDefleksi = $formKpCargoLift->foto_defleksi; 
                if ($fotoDefleksi && is_string($fotoDefleksi)) {
                    $fotoDefleksi = json_decode($fotoDefleksi, true);
                }            
            @endphp
            @if($fotoDefleksi && count($fotoDefleksi) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoDefleksi as $foto)
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

        {{-- Defleksi Show --}}
        <div class="grid items-center grid-cols-3 gap-4">
            {{-- Header --}}
            <div class="font-bold text-center text-gray-700">Posisi</div>
            <div class="font-bold text-center text-gray-700">Dengan Beban</div>
            <div class="font-bold text-center text-gray-700">Tanpa Beban</div>

            {{-- Baris 1 --}}
            <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="flex-1 border-r border-gray-400 last:border-0 py-2 text-center
                        {{ $formKpCargoLift->posisi_defleksi == $i ? 'bg-blue-500 text-white' : '' }}">
                        {{ $i }}
                    </div>
                @endfor
            </div>

            <div>
                <label for="single_girder_beban" class="block text-sm text-gray-700">Single Girder</label>
                <input type="number" step="any" value="{{ $formKpCargoLift->single_girder_beban ?? '' }}" readonly class="block w-full px-3 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
            </div>
            <div>
                <input type="number" step="any" value="{{ $formKpCargoLift->single_girder_tanpa_beban ?? '' }}" readonly class="block w-full px-3 py-2 mt-6 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
            </div>

            {{-- Baris 2 --}}
            <div class="inline-block">
                {{-- Row 1 --}}
                <div class="flex mt-6 overflow-hidden border border-gray-400 rounded-md">
                    @foreach ([1,2,3] as $i)
                        <div class="flex-1 border-r border-gray-400 last:border-0 py-2 text-center
                            {{ $formKpCargoLift->posisi_defleksi_dua == $i ? 'bg-blue-500 text-white' : '' }}">
                            {{ $i }}
                        </div>
                    @endforeach
                </div>

                {{-- Row 2 --}}
                <div class="flex overflow-hidden border border-gray-400 rounded-md">
                    @foreach ([6,5,4] as $i)
                        <div class="flex-1 border-r border-gray-400 last:border-0 py-2 text-center
                            {{ $formKpCargoLift->posisi_defleksi_dua == $i ? 'bg-blue-500 text-white' : '' }}">
                            {{ $i }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="space-y-1">
                <label for="double_girder_beban" class="block text-sm text-gray-700">Double Girder</label>
                <input type="number" step="any" value="{{ $formKpCargoLift->double_girder_beban ?? '' }}" readonly class="block w-full px-3 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
                <input type="number" step="any" value="{{ $formKpCargoLift->double_girder_beban_dua ?? '' }}" readonly class="block w-full px-3 py-2 mt-2 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
            </div>

            <div class="space-y-1">
                <input type="number" step="any" value="{{ $formKpCargoLift->double_girder_tanpa_beban ?? '' }}" readonly class="block w-full px-3 py-2 mt-6 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
                <input type="number" step="any" value="{{ $formKpCargoLift->double_girder_tanpa_beban_dua ?? '' }}" readonly class="block w-full px-3 py-2 mt-2 bg-gray-100 border border-gray-300 rounded-md shadow-md sm:text-sm">
            </div>
        </div>

        {{-- Hasil Uji --}}
        <div class="grid items-center grid-cols-2 gap-4">

            {{-- Baris 1 --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Pengujian NTD : Tidak dilakukan / Dilakukan*) pada bagian:
                </label>
            </div>
            <div>
                <div class="w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded shadow-md">
                    {{ $formKpCargoLift->pengujian_ntd ?? '-' }}
                </div>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Hasil:
                </label>
            </div>
            <div>
                <div class="w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded shadow-md">
                    {{ $formKpCargoLift->hasil_uji ?? '-' }}
                </div>
            </div>

        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpCargoLift->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
