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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpForklift->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpForklift->foto_informasi_umum; 
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
                {{ $formKpForklift->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpForklift->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- foto_kecepatan --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Kecepatan (Speed)</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoKecepatan = $formKpForklift->foto_kecepatan; 
                if ($fotoKecepatan && is_string($fotoKecepatan)) {
                    $fotoKecepatan = json_decode($fotoKecepatan, true);
                }            
            @endphp
            @if($fotoKecepatan && count($fotoKecepatan) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoKecepatan as $foto)
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

        {{-- Kecepatan Angkat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Angkat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->kecepatan_angkat ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan Ungkit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Ungkit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->kecepatan_ungkit ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan Jalan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Jalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->kecepatan_jalan ?? '-' }}
            </div>
        </div>

        {{-- foto_radius --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Radius Putaran</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoRadius = $formKpForklift->foto_radius; 
                if ($fotoRadius && is_string($fotoRadius)) {
                    $fotoRadius = json_decode($fotoRadius, true);
                }            
            @endphp
            @if($fotoRadius && count($fotoRadius) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoRadius as $foto)
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

        {{-- Radius Putaran Kiri --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Radius Putaran Kiri</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->radius_putaran_kiri ?? '-' }}
            </div>
        </div>

        {{-- Radius Putaran Kanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Radius Putaran Kanan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->radius_putaran_kanan ?? '-' }}
            </div>
        </div>

        {{-- Penggerak --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Penggerak</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->penggerak ?? '-' }}
            </div>
        </div>

        {{-- Nama Operator --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Operator</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->nama_operator ?? '-' }}
            </div>
        </div>

        {{-- Sertifikat Operator SIO --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Sertifikat Operator (SIO)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->sertifikat_operator_sio ?? '-' }}
            </div>
        </div>

        {{-- foto_dimensi_forklift --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Forklift</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoDimensiForklift = $formKpForklift->foto_dimensi_forklift; 
                if ($fotoDimensiForklift && is_string($fotoDimensiForklift)) {
                    $fotoDimensiForklift = json_decode($fotoDimensiForklift, true);
                }            
            @endphp
            @if($fotoDimensiForklift && count($fotoDimensiForklift) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoDimensiForklift as $foto)
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

        {{-- Panjang Dimensi Forklift --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang Dimensi Forklift</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->panjang_dimensi_forklift ?? '-' }}
            </div>
        </div>

        {{-- Lebar Dimensi Forklift --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Dimensi Forklift</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->lebar_dimensi_forklift ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Dimensi Forklift --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Dimensi Forklift</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tinggi_dimensi_forklift ?? '-' }}
            </div>
        </div>

        {{-- foto_garpu --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Garpu/Fork</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoGarpu = $formKpForklift->foto_garpu; 
                if ($fotoGarpu && is_string($fotoGarpu)) {
                    $fotoGarpu = json_decode($fotoGarpu, true);
                }            
            @endphp
            @if($fotoGarpu && count($fotoGarpu) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoGarpu as $foto)
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

        {{-- Tinggi Garpu --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Garpu</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tinggi_garpu ?? '-' }}
            </div>
        </div>

        {{-- Lebar Garpu --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Garpu</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->lebar_garpu ?? '-' }}
            </div>
        </div>

        {{-- Tebal Garpu 1 - 3 --}}
        <div class="grid grid-cols-3 gap-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tebal Garpu 1</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                    {{ $formKpForklift->tebal_garpu1 ?? '-' }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tebal Garpu 2</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                    {{ $formKpForklift->tebal_garpu2 ?? '-' }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tebal Garpu 3</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                    {{ $formKpForklift->tebal_garpu3 ?? '-' }}
                </div>
            </div>
        </div>

        {{-- foto_pagar --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pagar/Back Rest</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPagar = $formKpForklift->foto_pagar; 
                if ($fotoPagar && is_string($fotoPagar)) {
                    $fotoPagar = json_decode($fotoPagar, true);
                }            
            @endphp
            @if($fotoPagar && count($fotoPagar) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPagar as $foto)
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

        {{-- Tinggi Pagar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Pagar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tinggi_pagar ?? '-' }}
            </div>
        </div>

        {{-- Lebar Pagar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Pagar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->lebar_pagar ?? '-' }}
            </div>
        </div>

        {{-- foto_mast --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Mast</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoMast = $formKpForklift->foto_mast; 
                if ($fotoMast && is_string($fotoMast)) {
                    $fotoMast = json_decode($fotoMast, true);
                }            
            @endphp
            @if($fotoMast && count($fotoMast) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoMast as $foto)
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

        {{-- Tinggi Mast --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Mast</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tinggi_mast ?? '-' }}
            </div>
        </div>

        {{-- Lebar Mast --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Mast</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->lebar_mast ?? '-' }}
            </div>
        </div>

        {{-- Tebal Mast --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Mast</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tebal_mast ?? '-' }}
            </div>
        </div>

        {{-- foto_torak --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Torak/Hidrolik</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoTorak = $formKpForklift->foto_torak; 
                if ($fotoTorak && is_string($fotoTorak)) {
                    $fotoTorak = json_decode($fotoTorak, true);
                }            
            @endphp
            @if($fotoTorak && count($fotoTorak) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoTorak as $foto)
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

        {{-- Torak Dalam --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Torak Dalam</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->torak_dalam ?? '-' }}
            </div>
        </div>

        {{-- Torak Luar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Torak Luar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->torak_luar ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Torak --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Torak</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->tinggi_torak ?? '-' }}
            </div>
        </div>

        {{-- foto_jarak_antarroda --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Jarak Antar Roda</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoJarakAntarRoda = $formKpForklift->foto_jarak_antarroda; 
                if ($fotoJarakAntarRoda && is_string($fotoJarakAntarRoda)) {
                    $fotoJarakAntarRoda = json_decode($fotoJarakAntarRoda, true);
                }            
            @endphp
            @if($fotoJarakAntarRoda && count($fotoJarakAntarRoda) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoJarakAntarRoda as $foto)
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

        {{-- Jarak Roda Depan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Roda Depan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->jarak_roda_depan ?? '-' }}
            </div>
        </div>

        {{-- Jarak Roda Belakang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Roda Belakang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->jarak_roda_belakang ?? '-' }}
            </div>
        </div>

        {{-- Jarak As Roda Depan-Belakang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak As Roda Depan - Belakang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpForklift->jarak_as_roda_depan_belakang ?? '-' }}
            </div>
        </div>

        {{-- foto_load_test --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoLoadTest = $formKpForklift->foto_load_test; 
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

        {{-- Pengujian --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">

                {{-- Baris 1 - Label --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Swl Tinggi Angkat</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Beban Uji Load Chard</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Travelling/ Kecepatan</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Gerakan (mm)</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>

                {{-- Baris 2 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->tinggi_angkat_hook1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->beban_uji_load1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->travelling_kecepatan1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->gerakan1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->hasil1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->keterangan1 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 3 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->tinggi_angkat_hook2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->beban_uji_load2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->travelling_kecepatan2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->gerakan2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->hasil2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->keterangan2 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 4 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->tinggi_angkat_hook3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->beban_uji_load3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->travelling_kecepatan3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->gerakan3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->hasil3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpForklift->keterangan3 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        








        
        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpForklift->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
