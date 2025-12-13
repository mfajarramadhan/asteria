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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpWheelLoader->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpWheelLoader->foto_informasi_umum; 
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
                {{ $formKpWheelLoader->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Panjang Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->panjang_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->tinggi_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Lebar Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->lebar_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Jarak Track / Roda --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Track Antar Roda Depan dan Belakang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jarak_track_roda ?? '-' }}
            </div>
        </div>

        {{-- Ukuran Lebar Roda --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ukuran Lebar Roda (Tire)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->ukuran_lebar_roda ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan Maks Travelling --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Maksimum (Travelling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->kecepatan_maks_travelling ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan Mundur --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kecepatan Mundur</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->kecepatan_mundur ?? '-' }}
            </div>
        </div>

        {{-- Rem --}}
        <div class="grid grid-cols-2 gap-4 pt-4">
            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">
                    Rem
                </label>
            </div>

            {{-- Right: Display --}}
            <div class="space-y-4">

                {{-- Display 1 --}}
                <div>
                    <div
                        class="block w-full px-3 py-2 mt-1 text-sm text-gray-700 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpWheelLoader->rem_macam ?? '-' }}
                    </div>
                </div>

                {{-- Display 2 --}}
                <div>
                    <div
                        class="block w-full px-3 py-2 mt-1 text-sm text-gray-700 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpWheelLoader->rem_type ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Radius Putaran --}}
        <div class="grid grid-cols-2 gap-4 pt-4">
            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">
                    Radius Putaran
                </label>
            </div>

            {{-- Right: Display --}}
            <div class="space-y-4">

                {{-- Display Kiri --}}
                <div>
                    <div
                        class="block w-full px-3 py-2 mt-1 text-sm text-gray-700 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpWheelLoader->radius_putaran_kiri ?? '-' }}
                    </div>
                </div>

                {{-- Display Kanan --}}
                <div>
                    <div
                        class="block w-full px-3 py-2 mt-1 text-sm text-gray-700 bg-gray-200 border border-gray-400 rounded-md shadow-md">
                        {{ $formKpWheelLoader->radius_putaran_kanan ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_mesin --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Mesin</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoMesin = $formKpWheelLoader->foto_mesin; 
                if ($fotoMesin && is_string($fotoMesin)) {
                    $fotoMesin = json_decode($fotoMesin, true);
                }            
            @endphp
            @if($fotoMesin && count($fotoMesin) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoMesin as $foto)
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

        {{-- Tipe Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->tipe_mesin ?? '-' }}
            </div>
        </div>

        {{-- Nomor Seri --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->nomor_seri ?? '-' }}
            </div>
        </div>

        {{-- Jumlah Silinder --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Silinder</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->jumlah_silinder ?? '-' }}
            </div>
        </div>

        {{-- Daya Bersih --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Daya Bersih</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->daya_bersih ?? '-' }}
            </div>
        </div>

        {{-- Merek --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Merek</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->merek ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->tahun_pembuatan_mesin ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->pabrik_pembuat_mesin ?? '-' }}
            </div>
        </div>

        {{-- foto_pompa_hydraulik --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pompa Hydraulik</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPompaHydraulik = $formKpWheelLoader->foto_pompa_hydraulik; 
                if ($fotoPompaHydraulik && is_string($fotoPompaHydraulik)) {
                    $fotoPompaHydraulik = json_decode($fotoPompaHydraulik, true);
                }            
            @endphp
            @if($fotoPompaHydraulik && count($fotoPompaHydraulik) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPompaHydraulik as $foto)
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

        {{-- Pompa Hydraulik Type --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->pompa_hydraulik_type ?? '-' }}
            </div>
        </div>

        {{-- Pompa Hydraulik Tekanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpWheelLoader->pompa_hydraulik_tekanan ?? '-' }}
            </div>
        </div>

        {{-- Pengujian --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-6 gap-4 min-w-[700px]">
                {{-- Baris 1 --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Fungsi</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Kecepatan</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Gerakan (mm)</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Beban</label>
                </div>

                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>
                
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>

                {{-- Baris 2 --}}
                <div class="text-left">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Travelling</label>
                </div>

                {{-- fungsi_travelling_kecepatan --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->fungsi_travelling_kecepatan ?? '-' }}
                    </div>
                </div>

                {{-- travelling_gerakan_maju & mundur --}}
                <div class="flex gap-1">
                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->travelling_gerakan_maju ?? '-' }}
                    </div>

                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->travelling_gerakan_mundur ?? '-' }}
                    </div>
                </div>

                {{-- travelling_beban --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->travelling_beban ?? '-' }}
                    </div>
                </div>

                {{-- travelling_hasil --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->travelling_hasil ?? '-' }}
                    </div>
                </div>

                {{-- travelling_keterangan --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->travelling_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Baris 3 --}}
                <div class="text-left">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Belok</label>
                </div>

                {{-- fungsi_belok_kecepatan --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->fungsi_belok_kecepatan ?? '-' }}
                    </div>
                </div>

                {{-- belok_gerakan_maju & mundur --}}
                <div class="flex gap-1">
                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->belok_gerakan_maju ?? '-' }}
                    </div>

                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->belok_gerakan_mundur ?? '-' }}
                    </div>
                </div>

                {{-- belok_beban --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->belok_beban ?? '-' }}
                    </div>
                </div>

                {{-- belok_hasil --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->belok_hasil ?? '-' }}
                    </div>
                </div>

                {{-- belok_keterangan --}}
                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->belok_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Baris 4 --}}
                <div class="text-left">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Lengan (boom)</label>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->fungsi_lengan_kecepatan ?? '-' }}
                    </div>
                </div>

                <div class="flex gap-1">
                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->lengan_gerakan_maju ?? '-' }}
                    </div>

                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->lengan_gerakan_mundur ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->lengan_beban ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->lengan_hasil ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->lengan_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Baris 5 --}}
                <div class="text-left">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Bak (bucket)</label>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->fungsi_bucket_kecepatan ?? '-' }}
                    </div>
                </div>

                <div class="flex gap-1">
                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->bucket_gerakan_maju ?? '-' }}
                    </div>

                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->bucket_gerakan_mundur ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->bucket_beban ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->bucket_hasil ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->bucket_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Baris 6 --}}
                <div class="text-left">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Gerakan Mengangkut (loading)</label>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->fungsi_loading_kecepatan ?? '-' }}
                    </div>
                </div>

                <div class="flex gap-1">
                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->loading_gerakan_maju ?? '-' }}
                    </div>

                    <div class="block w-full px-2 py-2 mt-1 text-sm text-center bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->loading_gerakan_mundur ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->loading_beban ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->loading_hasil ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="block w-full px-3 py-2 mt-1 text-sm bg-gray-100 border border-gray-300 rounded-md shadow-md">
                        {{ $formKpWheelLoader->loading_keterangan ?? '-' }}
                    </div>
                </div>


                
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpWheelLoader->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
