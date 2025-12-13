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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpDumpTrailer->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpDumpTrailer->foto_informasi_umum; 
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
                {{ $formKpDumpTrailer->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Panjang Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->panjang_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Tinggi Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tinggi Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tinggi_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Ketinggian Kabin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketinggian Kabin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->ketinggian_kabin ?? '-' }}
            </div>
        </div>

        {{-- Lebar Keseluruhan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lebar Keseluruhan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->lebar_keseluruhan ?? '-' }}
            </div>
        </div>

        {{-- Kecepatan --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- Left: Label --}}
            <div class="flex items-center">
                <label class="block text-sm font-medium text-gray-700">
                    Kecepatan
                </label>
            </div>

            {{-- Right: Show Fields --}}
            <div class="space-y-4">
                {{-- Show Angkat --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->kecepatan_angkat ?? '-' }}
                    </div>
                </div>

                {{-- Show Turun --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->kecepatan_turun ?? '-' }}
                    </div>
                </div>

                {{-- Show Travelling --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->kecepatan_travelling ?? '-' }}
                    </div>
                </div>
            </div>
        </div>


        {{-- Perlengkapan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Perlengkapan / Attachment</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->perlengkapan ?? '-' }}
            </div>
        </div>

        {{-- Berat Kendaraan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Berat Kendaraan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->berat_kendaraan ?? '-' }}
            </div>
        </div>

        {{-- foto_penggerak_utama --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Penggerak Utama (Engine)</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPenggerakUtama = $formKpDumpTrailer->foto_penggerak_utama; 
                if ($fotoPenggerakUtama && is_string($fotoPenggerakUtama)) {
                    $fotoPenggerakUtama = json_decode($fotoPenggerakUtama, true);
                }            
            @endphp
            @if($fotoPenggerakUtama && count($fotoPenggerakUtama) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPenggerakUtama as $foto)
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
        
        {{-- Merk/Type --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Merk / Type</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->merk_type ?? '-' }}
            </div>
        </div>

        {{-- Nomor Seri --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->nomor_seri ?? '-' }}
            </div>
        </div>

        {{-- Jumlah Silinder --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Silinder</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->jumlah_silinder ?? '-' }}
            </div>
        </div>

        {{-- Daya --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Daya</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->daya ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tahun_pembuatan_mesin ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuatan Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuatan Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->pabrik_pembuatan_mesin ?? '-' }}
            </div>
        </div>

        {{-- foto_tekanan_roda --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Tekanan Roda (Tire Pressure)</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoTekananRoda = $formKpDumpTrailer->foto_tekanan_roda; 
                if ($fotoTekananRoda && is_string($fotoTekananRoda)) {
                    $fotoTekananRoda = json_decode($fotoTekananRoda, true);
                }            
            @endphp
            @if($fotoTekananRoda && count($fotoTekananRoda) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoTekananRoda as $foto)
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

        {{-- Roda Penggerak --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Roda Penggerak</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->roda_penggerak ?? '-' }}
            </div>
        </div>

        {{-- Roda Kemudi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Roda Kemudi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->roda_kemudi ?? '-' }}
            </div>
        </div>
        
        {{-- foto_roda_penggerak --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Roda Penggerak (Drive Wheel)</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoRodaPenggerak = $formKpDumpTrailer->foto_roda_penggerak; 
                if ($fotoRodaPenggerak && is_string($fotoRodaPenggerak)) {
                    $fotoRodaPenggerak = json_decode($fotoRodaPenggerak, true);
                }            
            @endphp
            @if($fotoRodaPenggerak && count($fotoRodaPenggerak) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoRodaPenggerak as $foto)
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
        
        {{-- Ukuran --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ukuran</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->ukuran ?? '-' }}
            </div>
        </div>

        {{-- Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tipe ?? '-' }}
            </div>
        </div>

        {{-- foto_roda_kemudi --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Roda Kemudi (Steering Wheel)</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoRodaKemudi = $formKpDumpTrailer->foto_roda_kemudi; 
                if ($fotoRodaKemudi && is_string($fotoRodaKemudi)) {
                    $fotoRodaKemudi = json_decode($fotoRodaKemudi, true);
                }            
            @endphp
            @if($fotoRodaKemudi && count($fotoRodaKemudi) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoRodaKemudi as $foto)
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

        {{-- Ukuran2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ukuran</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->ukuran2 ?? '-' }}
            </div>
        </div>

        {{-- Tipe2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tipe2 ?? '-' }}
            </div>
        </div>
        
        {{-- foto_pompa_hidrolik --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pompa Hidrolik</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPompaHidrolik = $formKpDumpTrailer->foto_pompa_hidrolik; 
                if ($fotoPompaHidrolik && is_string($fotoPompaHidrolik)) {
                    $fotoPompaHidrolik = json_decode($fotoPompaHidrolik, true);
                }            
            @endphp
            @if($fotoPompaHidrolik && count($fotoPompaHidrolik) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPompaHidrolik as $foto)
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

        {{-- Tipe Pompa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe Pompa</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tipe_pompa ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Pompa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Pompa</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->tekanan_pompa ?? '-' }}
            </div>
        </div>

        {{-- Relief Valve Pompa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Relief Valve Pompa</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpDumpTrailer->relief_valve_pompa ?? '-' }}
            </div>
        </div>

        {{-- foto_pengujian --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengujian</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPengujian = $formKpDumpTrailer->foto_pengujian; 
                if ($fotoPengujian && is_string($fotoPengujian)) {
                    $fotoPengujian = json_decode($fotoPengujian, true);
                }            
            @endphp
            @if($fotoPengujian && count($fotoPengujian) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPengujian as $foto)
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
                {{-- Baris 1 --}}
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
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->swl_tinggi_angkat1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->beban_uji_load1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->travelling_kecepatan1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->gerakan1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->hasil1 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->keterangan1 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 3 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->swl_tinggi_angkat2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->beban_uji_load2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->travelling_kecepatan2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->gerakan2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->hasil2 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->keterangan2 ?? '-' }}
                    </div>
                </div>

                {{-- Baris 4 --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->swl_tinggi_angkat3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->beban_uji_load3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->travelling_kecepatan3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->gerakan3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->hasil3 ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpDumpTrailer->keterangan3 ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpDumpTrailer->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
