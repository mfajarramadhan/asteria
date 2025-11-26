<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 space-y-4 bg-white rounded-lg shadow-md">
        {{-- Tanggal Pemeriksaan --}}
        <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
        <div class="flex flex-wrap justify-between w-full gap-y-4">
            {{-- Tanggal Pemeriksaan 1 --}}
            <div class="w-full md:w-[50%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ optional($formKpScrewCompressor->tanggal_pemeriksaan)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg shadow-md focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tanggal_pemeriksaan') }}"> 
                </div>
                @error('tanggal_pemeriksaan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Negara --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Negara</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->negara ?? '-' }}
            </div>
        </div>

        {{-- Tahun --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->tahun ?? '-' }}
            </div>
        </div>

        {{-- Tekanan Kerja --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan Kerja</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->tekanan_kerja ?? '-' }}
            </div>
        </div>

        <h2 class="block text-sm font-bold text-gray-700">Dimensi</h2>
        
        {{-- foto_shell_separator --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Shell/Badan Saparator Tank</h2>
            <label for="foto_shell_separator" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoShellSeparator = $formKpScrewCompressor->foto_shell_separator; 
                if ($fotoShellSeparator && is_string($fotoShellSeparator)) {
                    $fotoShellSeparator = json_decode($fotoShellSeparator, true);
                }            
            @endphp
            @if($fotoShellSeparator && count($fotoShellSeparator) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoShellSeparator as $foto)
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

        {{-- Ketebalan --}}
        <div>
            <label class="block text-sm text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->ketebalan_shell_separator ?? '-' }}
            </div>
        </div>

        {{-- Diameter (Keliling) --}}
        <div>
            <label class="block text-sm text-gray-700">Diameter (Keliling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->diameter_shell_separator ?? '-' }}
            </div>
        </div>

        {{-- Panjang --}}
        <div>
            <label class="block text-sm text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->panjang_shell_separator ?? '-' }}
            </div>
        </div>


        {{-- Instalasi Pipa --}}
        {{-- foto_instalasi_pipa --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Instalasi Pipa</h2>
            <label for="foto_instalasi_pipa" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInstalasiPipa = $formKpScrewCompressor->foto_instalasi_pipa; 
                if ($fotoInstalasiPipa && is_string($fotoInstalasiPipa)) {
                    $fotoInstalasiPipa = json_decode($fotoInstalasiPipa, true);
                }            
            @endphp
            @if($fotoInstalasiPipa && count($fotoInstalasiPipa) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoInstalasiPipa as $foto)
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

        {{-- Diameter --}}
        <div>
            <label class="block text-sm text-gray-700">Diameter</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->diameter_instalasi_pipa ?? '-' }}
            </div>
        </div>

        {{-- Ketebalan --}}
        <div>
            <label class="block text-sm text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->ketebalan_instalasi_pipa ?? '-' }}
            </div>
        </div>

        {{-- Panjang --}}
        <div>
            <label class="block text-sm text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->panjang_instalasi_pipa ?? '-' }}
            </div>
        </div>


        {{-- Casing/Cover Screw Compressor --}}
        {{-- foto_casing_screw --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Casing/Cover Screw Compressor</h2>
            <label for="foto_casing_screw" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoCasingScrew = $formKpScrewCompressor->foto_casing_screw; 
                if ($fotoCasingScrew && is_string($fotoCasingScrew)) {
                    $fotoCasingScrew = json_decode($fotoCasingScrew, true);
                }            
            @endphp
            @if($fotoCasingScrew && count($fotoCasingScrew) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoCasingScrew as $foto)
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

        {{-- Panjang --}}
        <div>
            <label class="block text-sm text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->panjang_casing_screw ?? '-' }}
            </div>
        </div>

        {{-- Lebar --}}
        <div>
            <label class="block text-sm text-gray-700">Lebar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->lebar_casing_screw ?? '-' }}
            </div>
        </div>

        {{-- Tinggi --}}
        <div>
            <label class="block text-sm text-gray-700">Tinggi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->tinggi_casing_screw ?? '-' }}
            </div>
        </div>


        {{-- Pondasi Screw Compressor --}}
        {{-- foto_pondasi_screw --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pondasi Screw Compressor</h2>
            <label for="foto_pondasi_screw" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoPondasiScrew = $formKpScrewCompressor->foto_pondasi_screw; 
                if ($fotoPondasiScrew && is_string($fotoPondasiScrew)) {
                    $fotoPondasiScrew = json_decode($fotoPondasiScrew, true);
                }            
            @endphp
            @if($fotoPondasiScrew && count($fotoPondasiScrew) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPondasiScrew as $foto)
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

        {{-- Panjang --}}
        <div>
            <label class="block text-sm text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->panjang_pondasi_screw ?? '-' }}
            </div>
        </div>

        {{-- Lebar --}}
        <div>
            <label class="block text-sm text-gray-700">Lebar</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpScrewCompressor->lebar_pondasi_screw ?? '-' }}
            </div>
        </div>

        
        {{-- Safety Device --}}
        {{-- foto_safety_device --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Safety Device</h2>
            <label for="foto_safety_device" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $foto_safety_device = $formKpScrewCompressor->foto_safety_device; 
                if ($foto_safety_device && is_string($foto_safety_device)) {
                    $foto_safety_device = json_decode($foto_safety_device, true);
                }            
            @endphp
            @if($foto_safety_device && count($foto_safety_device) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($foto_safety_device as $foto)
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

        {{-- Safety Valve Saparator Tank --}}
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
            <label class="block text-sm text-gray-700">Safety Valve Separator Tank</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpScrewCompressor->safety_valve_separator_membuka ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpScrewCompressor->safety_valve_separator_menutup ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Catatan Safety Valve --}}
        <div>
            <label class="block text-sm text-gray-700">Catatan Safety Valve Separator Tank</label>
            <textarea name="catatan_safety_valve" id="catatan_safety_valve" placeholder="catatan_safety_valve" rows="2" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpScrewCompressor->catatan_safety_valve ?? '-' }}</textarea>
        </div>

        {{-- foto_pressure_switch --}}
        <div>
            <label for="foto_pressure_switch" class="block mt-10 mb-1 text-sm font-medium text-gray-700">Foto Pressure Switch</label>
            @php
                $foto_pressure_switch = $formKpScrewCompressor->foto_pressure_switch; 
                if ($foto_pressure_switch && is_string($foto_pressure_switch)) {
                    $foto_pressure_switch = json_decode($foto_pressure_switch, true);
                }            
            @endphp
            @if($foto_pressure_switch && count($foto_pressure_switch) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($foto_pressure_switch as $foto)
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
                    {{ $formKpScrewCompressor->pressure_switch_on_set ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpScrewCompressor->pressure_switch_on_hasil ?? '-' }}
                </div>
            </div>

            {{-- Baris 3 --}}
            <div>
                <label class="block text-sm text-gray-700">Pressure Switch Off</label>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpScrewCompressor->pressure_switch_off_set ?? '-' }}
                </div>
            </div>
            <div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpScrewCompressor->pressure_switch_off_hasil ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Catatan Pressure Switch --}}
        <div>
            <label class="block text-sm text-gray-700">Catatan Pressure Switch</label>
            <textarea name="catatan_pressure_switch" id="catatan_pressure_switch" placeholder="catatan_pressure_switch" rows="2" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpScrewCompressor->catatan_pressure_switch ?? '-' }}</textarea>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpScrewCompressor->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
