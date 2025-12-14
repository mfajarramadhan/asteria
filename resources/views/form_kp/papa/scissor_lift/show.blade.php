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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpScissorLift->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpScissorLift->foto_informasi_umum; 
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
                {{ $formKpScissorLift->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis Alat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Alat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Angkat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Angkat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->kapasitas_angkat ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Angkat Maksimum --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Angkat Maksimum</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScissorLift->tinggi_angkat_maksimum ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan Angkat --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Label kiri --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Kecepatan Angkat</label>
            </div>

            {{-- Nilai kanan --}}
            <div class="space-y-4">

                {{-- Naik --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->kecepatan_angkat_naik ?? '-' }}
                    </div>
                </div>

                {{-- Turun --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->kecepatan_angkat_turun ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tiang Penyangga/Mast --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Label kiri --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Tiang Penyangga/Mast</label>
            </div>

            {{-- Nilai kanan --}}
            <div class="space-y-4">

                {{-- Panjang --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->tiang_penyangga_panjang ?? '-' }}
                    </div>
                </div>

                {{-- Lebar --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->tiang_penyangga_lebar ?? '-' }}
                    </div>
                </div>

                {{-- Tebal --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->tiang_penyangga_tebal ?? '-' }}
                    </div>
                </div>
            </div>
        </div>


        {{-- Platform --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Platform</label>
            </div>

            {{-- Right: Values --}}
            <div class="space-y-4">

                {{-- Panjang --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->platform_panjang ?? '-' }}
                    </div>
                </div>

                {{-- Lebar --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->platform_lebar ?? '-' }}
                    </div>
                </div>

                {{-- Tinggi --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->platform_tinggi ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Torak Hidrolik --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Torak Hidrolik</label>
            </div>

            {{-- Right: Values --}}
            <div class="space-y-4">

                {{-- Torak Dalam --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->torak_hidrolik_dalam ?? '-' }}
                    </div>
                </div>

                {{-- Torak Luar --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->torak_hidrolik_luar ?? '-' }}
                    </div>
                </div>

                {{-- Tinggi Torak --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->torak_hidrolik_tinggi ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Jig/Kaki Penumpu --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Jig/Kaki Penumpu</label>
            </div>

            {{-- Right: Values --}}
            <div class="space-y-4">

                {{-- Panjang --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->jig_panjang ?? '-' }}
                    </div>
                </div>

                {{-- Lebar --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->jig_lebar ?? '-' }}
                    </div>
                </div>

                {{-- Tebal --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->jig_tebal ?? '-' }}
                    </div>
                </div>

                {{-- Diameter --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->jig_diameter ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Rem --}}
        <div class="grid grid-cols-2 gap-4 pt-4">

            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">Rem</label>
            </div>

            {{-- Right: Values --}}
            <div class="space-y-4">

                {{-- Macam --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->rem_macam ?? '-' }}
                    </div>
                </div>

                {{-- Type --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpScissorLift->rem_type ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_engine --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Engine</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoLoadTest = $formKpScissorLift->foto_engine; 
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

        {{-- Item --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Item</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->item ?? '-' }}
            </div>
        </div>

        {{-- Voltage --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Voltage</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->voltage ?? '-' }}
            </div>
        </div>

        {{-- Daya --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Daya</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->daya ?? '-' }}
            </div>
        </div>

        {{-- Frequency --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Frequency</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->frequency ?? '-' }}
            </div>
        </div>

        {{-- Phase --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Phase</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->phase ?? '-' }}
            </div>
        </div>

        {{-- Arus --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Arus</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->arus ?? '-' }}
            </div>
        </div>

        {{-- Beban --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Beban</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->beban ?? '-' }}
            </div>
        </div>

        {{-- Putaran --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Putaran</label>
            <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                {{ $formKpScissorLift->putaran ?? '-' }}
            </div>
        </div>

        {{-- foto_loadtest --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Load Test</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoLoadTest = $formKpScissorLift->foto_loadtest; 
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
            <div class="grid items-center grid-cols-5 gap-4 min-w-[700px]">
                {{-- Baris 1 (Label Header) --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Swl Tinggi Angkat</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Beban Uji Load Chard</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Lifting/Kecepatan</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>


                {{-- Baris 2 --}}
                <div>
                    <label class="block mb-1 text-xs text-gray-600"> </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->swl_tinggi_angkat1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-600"> </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->beban_uji_load_chard1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-600"> </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->lifting1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-600"> </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->hasil1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-600"> </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->keterangan1 ?? '-' }}
                    </div>
                </div>


                {{-- Baris 3 --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->swl_tinggi_angkat2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->beban_uji_load_chard2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->lifting2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->hasil2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->keterangan2 ?? '-' }}
                    </div>
                </div>


                {{-- Baris 4 --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->swl_tinggi_angkat3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->beban_uji_load_chard3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->lifting3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->hasil3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpScissorLift->keterangan3 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpScissorLift->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
