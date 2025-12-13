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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpMotorDiesel->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpMotorDiesel->foto_informasi_umum; 
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
                {{ $formKpMotorDiesel->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpMotorDiesel->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- foto_mesin --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Engine</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoMesin = $formKpMotorDiesel->foto_mesin; 
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
        
        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('pabrik_pembuat_mesin', $formKpMotorDiesel->pabrik_pembuat_mesin ?? '-') }}
            </div>
        </div>

        {{-- Nomor Seri --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('nomor_seri_mesin', $formKpMotorDiesel->nomor_seri_mesin ?? '-') }}
            </div>
        </div>

        {{-- Daya Mesin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Daya Mesin</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('daya_mesin', $formKpMotorDiesel->daya_mesin ?? '-') }}
            </div>
        </div>

        {{-- Jumlah Silinder --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah Silinder</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('jumlah_silinder', $formKpMotorDiesel->jumlah_silinder ?? '-') }}
            </div>
        </div>

        {{-- foto_generator --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Generator</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoGenerator = $formKpMotorDiesel->foto_generator; 
                if ($fotoGenerator && is_string($fotoGenerator)) {
                    $fotoGenerator = json_decode($fotoGenerator, true);
                }            
            @endphp
            @if($fotoGenerator && count($fotoGenerator) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoGenerator as $foto)
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
        
        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('pabrik_pembuat_generator', $formKpMotorDiesel->pabrik_pembuat_generator ?? '-') }}
            </div>
        </div>

        {{-- Nomor Seri --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('nomor_seri_generator', $formKpMotorDiesel->nomor_seri_generator ?? '-') }}
            </div>
        </div>

        {{-- foto_pengujian --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPengukuran = $formKpMotorDiesel->foto_pengujian; 
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

        {{-- Grounding 1 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Grounding 1</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('grounding1', $formKpMotorDiesel->grounding1 ?? '-') }}
            </div>
        </div>

        {{-- Grounding 2 --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Grounding 2</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('grounding2', $formKpMotorDiesel->grounding2 ?? '-') }}
            </div>
        </div>

        {{-- Getaran --}}
        <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">

            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Getaran</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label for="pondasi" class="block text-sm text-gray-700">Pondasi</label>
            </div>
            <div>
                <input type="text" name="pondasi" id="pondasi"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->pondasi }}" readonly>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label for="rangka" class="block text-sm text-gray-700">Rangka</label>
            </div>
            <div>
                <input type="text" name="rangka" id="rangka"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->rangka }}" readonly>
            </div>

            {{-- Baris 4 --}}
            <div>
                <label for="cover_kipas" class="block text-sm text-gray-700">Cover Kipas</label>
            </div>
            <div>
                <input type="text" name="cover_kipas" id="cover_kipas"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->cover_kipas }}" readonly>
            </div>
        </div>

        {{-- Pencahayaan --}}
        <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">

            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Pencahayaan</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label for="pencahayaan_depan" class="block text-sm text-gray-700">Bagian Depan Diesel</label>
            </div>
            <div>
                <input type="text" name="pencahayaan_depan" id="pencahayaan_depan"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->pencahayaan_depan }}" readonly>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label for="pencahayaan_belakang" class="block text-sm text-gray-700">Bagian Belakang</label>
            </div>
            <div>
                <input type="text" name="pencahayaan_belakang" id="pencahayaan_belakang"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->pencahayaan_belakang }}" readonly>
            </div>

            {{-- Baris 4 --}}
            <div>
                <label for="pencahayaan_tengah" class="block text-sm text-gray-700">Bagian Tengah</label>
            </div>
            <div>
                <input type="text" name="pencahayaan_tengah" id="pencahayaan_tengah"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->pencahayaan_tengah }}" readonly>
            </div>

            {{-- Baris 5 --}}
            <div>
                <label for="pencahayaan_depan_panel" class="block text-sm text-gray-700">Depan Panel</label>
            </div>
            <div>
                <input type="text" name="pencahayaan_depan_panel" id="pencahayaan_depan_panel"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->pencahayaan_depan_panel }}" readonly>
            </div>
        </div>

        {{-- Kebisingan --}}
        <div class="grid items-center grid-cols-[25%_75%] gap-4 px-4">

            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Kebisingan</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label for="kebisingan_ruang_pltd" class="block text-sm text-gray-700">Dalam Ruang PLTD</label>
            </div>
            <div>
                <input type="text" name="kebisingan_ruang_pltd" id="kebisingan_ruang_pltd"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->kebisingan_ruang_pltd }}" readonly>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label for="kebisingan_ruang_kontrol" class="block text-sm text-gray-700">Ruang Kontrol</label>
            </div>
            <div>
                <input type="text" name="kebisingan_ruang_kontrol" id="kebisingan_ruang_kontrol"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->kebisingan_ruang_kontrol }}" readonly>
            </div>

            {{-- Baris 4 --}}
            <div>
                <label for="kebisingan_luar_ruang_pltd" class="block text-sm text-gray-700">Diluar Area PLTD</label>
            </div>
            <div>
                <input type="text" name="kebisingan_luar_ruang_pltd" id="kebisingan_luar_ruang_pltd"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->kebisingan_luar_ruang_pltd }}" readonly>
            </div>

            {{-- Baris 5 --}}
            <div>
                <label for="kebisingan_area_kerja" class="block text-sm text-gray-700">Area Kerja</label>
            </div>
            <div>
                <input type="text" name="kebisingan_area_kerja" id="kebisingan_area_kerja"
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ $formKpMotorDiesel->kebisingan_area_kerja }}" readonly>
            </div>
        </div>

        {{-- foto_pengujian --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Pengukuran</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPengujian = $formKpMotorDiesel->foto_pengujian; 
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

        {{-- Jenis Proteksi --}}
        <div class="grid items-center grid-cols-3 gap-4 px-4">

            {{-- Header --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Jenis Proteksi</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil Pengujian</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Keterangan</label>
            </div>

            {{-- Emergency Stop --}}
            <div>
                <label for="emergency_stop" class="block text-sm text-gray-700">Emergency Stop</label>
            </div>

            <div>
                <select name="emergency_stop" id="emergency_stop" disabled
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                    <option value="-" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == '-' ? 'selected' : '' }}>-</option>
                    <option value="Berfungsi" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == 'Berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                    <option value="Tidak Berfungsi" {{ old('emergency_stop', $formKpMotorDiesel->emergency_stop) == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>

                </select>
            </div>

            <div>
                <input type="text" name="emergency_stop_ket" id="emergency_stop_ket" readonly
                    class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('emergency_stop_ket', $formKpMotorDiesel->emergency_stop_ket) }}">
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpMotorDiesel->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
