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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpPesawatTenagaProduksi->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpPesawatTenagaProduksi->foto_informasi_umum; 
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
                {{ $formKpPesawatTenagaProduksi->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Nama Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->nama_mesin ?? '-' }}
            </div>
        </div>

        {{-- Fungsi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Fungsi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->fungsi ?? '-' }}
            </div>
        </div>

        {{-- Foto Device --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Safety Device</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoDevice = $formKpPesawatTenagaProduksi->foto_device; 
                if ($fotoDevice && is_string($fotoDevice)) {
                    $fotoDevice = json_decode($fotoDevice, true);
                }            
            @endphp
            @if($fotoDevice && count($fotoDevice) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoDevice as $foto)
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

        {{-- Safety Device --}}
        <div class="grid items-center grid-cols-3 gap-4">
            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Safety Device</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Komponen Utama</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Pendukung Mesin</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device1 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama1 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin1 ?? '-' }}
                </div>
            </div>

            {{-- Baris 3 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device2 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama2 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin2 ?? '-' }}
                </div>
            </div>
            
            {{-- Baris 4 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device3 ?? '-' }}
                </div>
            </div>
            
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama3 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin3 ?? '-' }}
                </div>
            </div>
            
            {{-- Baris 5 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device4 ?? '-' }}
                </div>
            </div>
            
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama4 ?? '-' }}
                </div>
            </div>
            
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin4 ?? '-' }}
                </div>
            </div>

            {{-- Baris 6 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device5 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama5 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin5 ?? '-' }}
                </div>
            </div>

            {{-- Baris 7 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device6 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama6 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin6 ?? '-' }}
                </div>
            </div>

            {{-- Baris 8 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device7 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama7 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin7 ?? '-' }}
                </div>
            </div>

            {{-- Baris 9 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device8 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama8 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin8 ?? '-' }}
                </div>
            </div>

            {{-- Baris 10 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device9 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama9 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin9 ?? '-' }}
                </div>
            </div>

            {{-- Baris 11 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->safety_device10 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->komponen_utama10 ?? '-' }}
                </div>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pendukung_mesin10 ?? '-' }}
                </div>
            </div>
        </div>
        
        {{-- Foto Pengukuran --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
            <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPengukuran = $formKpPesawatTenagaProduksi->foto_pengukuran; 
                if ($fotoPengukuran && is_string($fotoPengukuran)) {
                    $fotoPengukuran = json_decode($fotoPengukuran, true);
                }            
            @endphp
            @if($fotoPengukuran && count($fotoPengukuran) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPengukuran as $foto)
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
        
        {{-- Pengukuran --}}
        <div class="grid items-center grid-cols-2 gap-4">
            {{-- Baris 1 --}}
            <div>
                <label for="pengukuran_grounding" class="block text-sm font-medium text-gray-700">Grounding</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pengukuran_grounding ?? '-' }}
                </div>
            </div>

            <div>
                <label for="pengukuran_pencahayaan" class="block text-sm font-medium text-gray-700">Pencahayaan</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pengukuran_pencahayaan ?? '-' }}
                </div>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label for="pengukuran_suhu" class="block text-sm font-medium text-gray-700">Suhu</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->pengukuran_suhu ?? '-' }}
                </div>
            </div>

            <div>
                <label for="emergency_top" class="block text-sm font-medium text-gray-700">Kebisingan</label>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->emergency_top ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Foto Pengukuran --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pengujian</h2>
            <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPengujian = $formKpPesawatTenagaProduksi->foto_pengujian; 
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

        {{-- Proteksi --}}
        <div class="grid items-center grid-cols-3 gap-4">
            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Jenis Proteksi</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil Pengujian</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Keterangan</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->emergency_stop ?? '-' }}
                </div>
            </div>

            <div>
                <select name="emergency_stop_hasil" id="emergency_stop_hasil" disabled
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    
                    <option value="-" 
                        {{ $formKpPesawatTenagaProduksi->emergency_stop_hasil == '-' ? 'selected' : '' }}>
                        -
                    </option>

                    <option value="Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->emergency_stop_hasil == 'Berfungsi' ? 'selected' : '' }}>
                        Berfungsi
                    </option>

                    <option value="Tidak Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->emergency_stop_hasil == 'Tidak Berfungsi' ? 'selected' : '' }}>
                        Tidak Berfungsi
                    </option>
                </select>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->ket_emergency_stop ?? '-' }}
                </div>
            </div>

            {{-- Baris 3 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->blank ?? '-' }}
                </div>
            </div>

            <div>
                <select name="blank_hasil" id="blank_hasil" disabled
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    
                    <option value="-" 
                        {{ $formKpPesawatTenagaProduksi->blank_hasil == '-' ? 'selected' : '' }}>
                        -
                    </option>

                    <option value="Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank_hasil == 'Berfungsi' ? 'selected' : '' }}>
                        Berfungsi
                    </option>

                    <option value="Tidak Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank_hasil == 'Tidak Berfungsi' ? 'selected' : '' }}>
                        Tidak Berfungsi
                    </option>
                </select>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->ket_blank ?? '-' }}
                </div>
            </div>

            {{-- Baris 4 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->blank2 ?? '-' }}
                </div>
            </div>

            <div>
                <select name="blank2_hasil" id="blank2_hasil" disabled
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    
                    <option value="-" 
                        {{ $formKpPesawatTenagaProduksi->blank2_hasil == '-' ? 'selected' : '' }}>
                        -
                    </option>

                    <option value="Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank2_hasil == 'Berfungsi' ? 'selected' : '' }}>
                        Berfungsi
                    </option>

                    <option value="Tidak Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank2_hasil == 'Tidak Berfungsi' ? 'selected' : '' }}>
                        Tidak Berfungsi
                    </option>
                </select>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->ket_blank2 ?? '-' }}
                </div>
            </div>

            {{-- Baris 5 --}}
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->blank3 ?? '-' }}
                </div>
            </div>

            <div>
                <select name="blank3_hasil" id="blank3_hasil" disabled
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    
                    <option value="-" 
                        {{ $formKpPesawatTenagaProduksi->blank3_hasil == '-' ? 'selected' : '' }}>
                        -
                    </option>

                    <option value="Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank3_hasil == 'Berfungsi' ? 'selected' : '' }}>
                        Berfungsi
                    </option>

                    <option value="Tidak Berfungsi" 
                        {{ $formKpPesawatTenagaProduksi->blank3_hasil == 'Tidak Berfungsi' ? 'selected' : '' }}>
                        Tidak Berfungsi
                    </option>
                </select>
            </div>

            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpPesawatTenagaProduksi->ket_blank3 ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpPesawatTenagaProduksi->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
