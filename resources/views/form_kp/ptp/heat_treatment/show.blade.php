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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpHeatTreatment->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpHeatTreatment->foto_informasi_umum; 
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
                {{ $formKpHeatTreatment->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis Bejana --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Bejana</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Jenis/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jenis_tipe ?? '-' }}
            </div>
        </div>

        {{-- foto_billet --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Jenis Billet</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoBillet = $formKpHeatTreatment->foto_billet; 
                if ($fotoBillet && is_string($fotoBillet)) {
                    $fotoBillet = json_decode($fotoBillet, true);
                }            
            @endphp
            @if($fotoBillet && count($fotoBillet) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoBillet as $foto)
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

        {{-- Dimensi Billet Maksimum --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Billet Maksimum</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->dimensi_billet_maks ?? '-' }}
            </div>
        </div>

        {{-- Berat Billet Maksimum --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Berat Billet Maksimum</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->berat_billet_maks ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Maksimum --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Maksimum</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->kapasitas_maks ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Efektif --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Efektif</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->kapasitas_efektif ?? '-' }}
            </div>
        </div>

        {{-- foto_shell --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Shell</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoShell = $formKpHeatTreatment->foto_shell; 
                if ($fotoShell && is_string($fotoShell)) {
                    $fotoShell = json_decode($fotoShell, true);
                }            
            @endphp
            @if($fotoShell && count($fotoShell) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoShell as $foto)
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

        {{-- Tebal Dinding Shell --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Dinding Shell</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tebal_dinding_shell ?? '-' }}
            </div>
        </div>

        {{-- Material Shell --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Material Shell</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->material_shell ?? '-' }}
            </div>
        </div>

        {{-- Tebal Refractory Shaped --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Refractory (Shaped/Cetak)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tebal_refractory_shaped ?? '-' }}
            </div>
        </div>

        {{-- Tebal Refractory Unshaped --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Refractory (Unshaped/Monolithic)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tebal_refractory_unshaped ?? '-' }}
            </div>
        </div>

        {{-- Jarak Antar Refractory --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jarak Antar Refractory</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jarak_antar_refractory ?? '-' }}
            </div>
        </div>

        {{-- foto_jalur_furnace --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Jalur Operasi Furnace</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoJalurFurnace = $formKpHeatTreatment->foto_jalur_furnace; 
                if ($fotoJalurFurnace && is_string($fotoJalurFurnace)) {
                    $fotoJalurFurnace = json_decode($fotoJalurFurnace, true);
                }            
            @endphp
            @if($fotoJalurFurnace && count($fotoJalurFurnace) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoJalurFurnace as $foto)
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

        {{-- Jumlah Jalur Operasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Jalur Operasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jumlah_jalur_operasi ?? '-' }}
            </div>
        </div>

        {{-- Panjang Jalur Operasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang Jalur Operasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->panjang_jalur_operasi ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Total Furnace --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Total Furnace</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->dimensi_total_furnace ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Efektif Furnace --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Efektif Furnace</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->dimensi_efektif_furnace ?? '-' }}
            </div>
        </div>

        {{-- foto_pembakaran --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Proses Pembakaran</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPembakaran = $formKpHeatTreatment->foto_pembakaran; 
                if ($fotoPembakaran && is_string($fotoPembakaran)) {
                    $fotoPembakaran = json_decode($fotoPembakaran, true);
                }            
            @endphp
            @if($fotoPembakaran && count($fotoPembakaran) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPembakaran as $foto)
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

        {{-- Bahan Bakar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Bahan Bakar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->bahan_bakar ?? '-' }}
            </div>
        </div>

        {{-- Temp Awal --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Temp. Kerja Pemanasan Awal</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->temp_awal ?? '-' }}
            </div>
        </div>

        {{-- Temp Akhir --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Temp. Kerja Pemanasan Akhir</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->temp_akhir ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Nozel NG --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Nozel NG / LNG</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tekanan_nozel_ng ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Nozel NG --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Nozel NG / LNG</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->kapasitas_nozel_ng ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Nozel Oksigen --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Nozel Oksigen</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tekanan_nozel_oksigen ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Nozel Oksigen --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Nozel Oksigen</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->kapasitas_nozel_oksigen ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Nozel N2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Nozel N₂</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tekanan_nozel_n2 ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas Nozel N2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas Nozel N₂</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->kapasitas_nozel_n2 ?? '-' }}
            </div>
        </div>

        {{-- Tebal Pipa Bakar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Pipa Bahan Bakar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tebal_pipa_bakar ?? '-' }}
            </div>
        </div>

        {{-- Diameter Pipa Bakar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter Pipa Bahan Bakar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->diameter_pipa_bakar ?? '-' }}
            </div>
        </div>

        {{-- Jenis Pipa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Pipa</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->jenis_pipa ?? '-' }}
            </div>
        </div>

        {{-- Dimensi Pondasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dimensi Pondasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->dimensi_pondasi ?? '-' }}
            </div>
        </div>

        
        {{-- foto_pendingin --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Sistem Pendingin</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $foto_pendingin = $formKpHeatTreatment->foto_pendingin; 
                if ($foto_pendingin && is_string($foto_pendingin)) {
                    $foto_pendingin = json_decode($foto_pendingin, true);
                }            
            @endphp
            @if($foto_pendingin && count($foto_pendingin) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($foto_pendingin as $foto)
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

        {{-- Temp Air Masuk --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Temp Air Pendingin Masuk</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->temp_air_masuk ?? '-' }}
            </div>
        </div>

        {{-- Temp Air Keluar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Temp Air Pendingin Kembali</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->temp_air_keluar ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Air --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Air Pendingin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tekanan_air ?? '-' }}
            </div>
        </div>

        {{-- Laju Aliran Air --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Laju Aliran Air Pendingin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->laju_aliran_air ?? '-' }}
            </div>
        </div>

        {{-- Diameter Pipa Pendingin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter Pipa Pendingin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->diameter_pipa_pendingin ?? '-' }}
            </div>
        </div>

        {{-- Tebal Pipa Pendingin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tebal Pipa Pendingin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpHeatTreatment->tebal_pipa_pendingin ?? '-' }}
            </div>
        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-300">
                        <thead class="text-gray-700 bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 text-center border">Bagian - Bagian</th>
                                <th class="px-3 py-2 text-center border">Memenuhi Syarat</th>
                                <th class="px-3 py-2 text-center border">Tidak Memenuhi Syarat</th>
                                <th class="px-3 py-2 text-center border">Keterangan</th>
                                <th class="px-3 py-2 text-center border">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $items = [
                                'konstruksi_pondasi_furnace' => ['label' => 'Konstruksi Pondasi Furnace'],
                                'furnace_shell' => ['label' => 'Furnace Shell'],
                                'sambungan_las' => ['label' => 'Sambungan Las Steel Shell'],
                                'tutup_furnace' => ['label' => 'Tutup Furnace (Roof/Cover Vessel)'],
                                'refractory' => ['label' => 'Refractory'],
                                'furnace_roof' => ['label' => 'Furnace Roof/Tutup Refractory'],
                                'furnace_sidewalls_refractory' => ['label' => 'Furnace Sidewalls Refractory'],
                                'furnace_hearth_refractory' => ['label' => 'Furnace Hearth Refractory'],
                                'clamping_hydraulic' => ['label' => 'Clamping Hydraulic'],
                                'charging_table' => ['label' => 'Heating Table/Charging Table'],
                                'furnace_top_igniter' => ['label' => 'Furnace Top Igniter'],
                                'burner' => ['label' => 'Burner'],
                                'conveyor' => ['label' => 'Conveyor'],
                                'control_room' => ['label' => 'Control Room'],
                                'pipa_nosel' => ['label' => 'Pipa & Nosel'],
                                'nosel_ng' => ['label' => 'Nosel NG/LNG'],
                                'pipa_ng' => ['label' => 'Pipa NG/LNG'],
                                'nosel_oksigen' => ['label' => 'Nosel Oksigen'],
                                'pipa_oksigen' => ['label' => 'Pipa Oksigen'],
                                'nosel_n2' => ['label' => 'Nosel N₂'],
                                'pipa_n2' => ['label' => 'Pipa N₂'],
                                'safety_valve' => ['label' => 'Safety Valve'],
                                'holder_cap' => ['label' => 'Holder Cap'],
                                'sistem_pendingin' => ['label' => 'Sistem Pendingin'],
                                'sistem_pendingin_tutup' => ['label' => 'Sistem Pendingin Tutup/Roof'],
                                'sistem_pendingin_shell' => ['label' => 'Sistem Pendingin Shell'],
                                'pipa_air_pendingin_shell' => ['label' => 'Pipa Air Pendingin Shell'],
                                'sistem_pendingin_kejut' => ['label' => 'Sistem Pendingin Kejut/Emergency'],
                                'sistem_kelistrikan' => ['label' => 'Sistem Kelistrikan'],
                                'mcb' => ['label' => 'MCB'],
                                'sambungan_bracket' => ['label' => 'Sambungan & Bracket'],
                                'tahanan_isolasi' => ['label' => 'Tahanan Isolasi'],
                                'safety_device' => ['label' => 'Safety Device'],
                                'pressure_gauge' => ['label' => 'Pressure Gauge'],
                                'temp_idicator' => ['label' => 'Temp Indicator'],
                                'sensor_bahan_bakar' => ['label' => 'Sensor-Sensor Bahan Bakar'],
                                'thermocouple' => ['label' => 'Thermocouple'],
                                'sistem_pembumian' => ['label' => 'Sistem Pembumian (Grounding)'],
                                'furnace_top_bleeding' => ['label' => 'Furnace Top Bleeding Valve'],
                                'safety_valve_nitrogen_supply' => ['label' => 'Safety Valve Nitrogen Supply'],
                                'safety_valve_ng_cng' => ['label' => 'Safety Valve NG / CNG'],
                                'safety_valve_oksigen' => ['label' => 'Safety Valve Oksigen'],
                                'safety_valve_n2' => ['label' => 'Safety Valve N₂'],
                                'dust_collector' => ['label' => 'Dust Collector'],
                                'gas_stop_valve' => ['label' => 'Gas Stop Valve'],
                                'dust_remover' => ['label' => 'Dust Remover Bleeding Valve'],
                                'electrostatis_precipitator_bag' => ['label' => 'Electrostatic Precipitator Bag Filter'],
                                'emergency_stop' => ['label' => 'Emergency Stop'],
                                'pagar_pengaman_lantai' => ['label' => 'Pagar Pengaman Lantai'],
                                'lantai_dapur' => ['label' => 'Lantai Dapur'],
                                'pagar_pengaman_tangga' => ['label' => 'Pagar Pengaman Tangga'],
                                ];
                            @endphp

                            @foreach ($items as $name => $data)
                                @php
                                    $value = old($name, $formKpHeatTreatment->$name ?? null);
                                    $ket   = old("keterangan_$name", $formKpHeatTreatment->{"keterangan_$name"} ?? null);

                                    // FIX: Foto harus selalu array
                                    $fotoRaw = $formKpHeatTreatment->{"foto_$name"} ?? null;

                                    if (is_string($fotoRaw)) {
                                        $decoded = json_decode($fotoRaw, true);
                                        $foto = is_array($decoded) ? $decoded : [];
                                    } elseif (is_array($fotoRaw)) {
                                        $foto = $fotoRaw;
                                    } else {
                                        $foto = [];
                                    }
                                @endphp

                                <tr class="relative">
                                    <td class="px-3 py-2 border font-medium w-[50%]">
                                        <div class="flex items-center justify-between gap-2">
                                            {{ $data['label'] }}
                                        </div>
                                    </td>

                                    {{-- Radio Ya --}}
                                    <td class="px-3 py-2 text-center border">
                                        <input type="radio"
                                            name="{{ $name }}"
                                            value="Ya"
                                            {{ $value == 'Ya' ? 'checked' : '' }}
                                            class="text-blue-600 border-gray-300 cursor-default pointer-events-none focus:ring-blue-500">
                                    </td>

                                    {{-- Radio Tidak --}}
                                    <td class="px-3 py-2 text-center border">
                                        <input type="radio"
                                            name="{{ $name }}"
                                            value="Tidak"
                                            {{ $value == 'Tidak' ? 'checked' : '' }}
                                            class="text-blue-600 border-gray-300 cursor-default pointer-events-none focus:ring-blue-500">
                                    </td>

                                    {{-- Keterangan --}}
                                    <td class="px-3 py-2 border">
                                        <input type="text"
                                            name="keterangan_{{ $name }}"
                                            value="{{ $ket }}"
                                            disabled
                                            class="px-2 py-1 text-sm bg-gray-200 border border-gray-300 rounded-md shadow-sm">
                                    </td>

                                    {{-- Foto --}}
                                    <td class="px-3 py-2 border">

                                        @if (!empty($foto))
                                            <button class="flex p-2 transition-all duration-500 rounded-full group item-center" type="button" onclick="openModal('{{ $name }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                            </button>

                                            {{-- Modal --}}
                                            <div id="modal_{{ $name }}" 
                                                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                                                <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                                                    <h2 class="mb-3 text-lg font-bold">Foto — {{ $data['label'] }}</h2>

                                                    <div class="grid grid-cols-2 gap-3">
                                                        @foreach ($foto as $file)
                                                            <img 
                                                                src="{{ asset('storage/' . $file) }}" 
                                                                class="w-full border rounded">
                                                        @endforeach
                                                    </div>

                                                    <button 
                                                        onclick="closeModal('{{ $name }}')"
                                                        class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                                        Tutup
                                                    </button>

                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpHeatTreatment->catatan ?? '-' }}</textarea>
        </div>
    </div>
    <script>
        function openModal(name) {
            const modal = document.getElementById("modal_" + name);
            modal.classList.remove("hidden");

            // tutup modal saat klik area luar
            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    closeModal(name);
                }
            });
        }

        function closeModal(name) {
            const modal = document.getElementById("modal_" + name);
            modal.classList.add("hidden");
        }
        </script>
</x-layout>
