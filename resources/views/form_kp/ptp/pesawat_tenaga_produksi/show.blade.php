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
                    <input disabled id="datepicker-autohide" value="{{ optional($formKpPesawatTenagaProduksi->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
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

        <h2 class="block text-sm font-bold text-gray-700">Dimensi</h2>

        {{-- Foto Shell --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Shell/Badan</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Shell/Badan</label>
            @php
                $fotoShell = $formKpPesawatTenagaProduksi->foto_shell; 
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

        {{-- Ketidakbulatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketidak bulatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->ketidakbulatan ?? '-' }}
            </div>
        </div>
        
        {{-- Ketebalan shell --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->ketebalan_shell ?? '-' }}
            </div>
        </div>

        {{-- Diameter shell --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter (keliling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->diameter_shell ?? '-' }}
            </div>
        </div>
        
        {{-- Panjang shell --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->panjang_shell ?? '-' }}
            </div>
        </div>

        {{-- Foto foto_head --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Head/Tutup Ujung</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Head/Tutup Ujung</label>
            @php
                $fotoHead = $formKpPesawatTenagaProduksi->foto_head; 
                if ($fotoHead && is_string($fotoHead)) {
                    $fotoHead = json_decode($fotoHead, true);
                }            
            @endphp
            @if($fotoHead && count($fotoHead) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoHead as $foto)
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

        {{-- Diameter_head --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter (keliling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->diameter_head ?? '-' }}
            </div>
        </div>
        
        {{-- Ketebalan head --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->ketebalan_head ?? '-' }}
            </div>
        </div>

        {{-- Foto foto_pipa --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pipa-pipa/Channel</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Pipa-pipa/Channel</label>
            @php
                $fotoPipa = $formKpPesawatTenagaProduksi->foto_pipa; 
                if ($fotoPipa && is_string($fotoPipa)) {
                    $fotoPipa = json_decode($fotoPipa, true);
                }            
            @endphp
            @if($fotoPipa && count($fotoPipa) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoPipa as $foto)
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

        {{-- Diameter Pipa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter (keliling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->diameter_pipa ?? '-' }}
            </div>
        </div>
        
        {{-- Ketebalan Pipa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->ketebalan_pipa ?? '-' }}
            </div>
        </div>
        
        {{-- Panjang Pipa --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->panjang_pipa ?? '-' }}
            </div>
        </div>

        {{-- Foto foto_instalasi --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Instalasi Pipa</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Instalasi Pipa</label>
            @php
                $fotoInstalasiPipa = $formKpPesawatTenagaProduksi->foto_instalasi; 
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

        {{-- Diameter Instalasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Diameter (keliling)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->diameter_intalasi ?? '-' }}
            </div>
        </div>
        
        {{-- Ketebalan Instalasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ketebalan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->ketebalan_intalasi ?? '-' }}
            </div>
        </div>
        
        {{-- Panjang Instalasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Panjang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpPesawatTenagaProduksi->panjang_intalasi ?? '-' }}
            </div>
        </div>

        {{-- Safety value cal --}}
        <div class="flex justify-center">
            <div class="flex items-center w-full md:w-5/6">
                <label for="safety_valv_cal" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                    • Safety Valve & Pressure Gauge apakah sudah dikalibrasi? 
                </label>
                <div class="w-[30%] md:w-[25%] flex items-center justify-between">
                    <span class="text-sm text-gray-900">
                        @if($formKpPesawatTenagaProduksi->safety_valv_cal === 1)
                            Ya
                        @elseif($formKpPesawatTenagaProduksi->safety_valv_cal === 0)
                            Tidak
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        </div>

        {{-- Tekanan kerja --}}
        <div class="flex justify-center">
            <div class="flex items-center w-full md:w-5/6">
                <label for="tekanan_kerja" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                    • Tekanan kerja
                </label>
                <div class="w-[30%] md:w-[25%]">
                    <input type="number" step="any" name="tekanan_kerja" id="tekanan_kerja"
                        class="block w-full px-3 py-1 text-gray-900 bg-gray-200 border border-gray-400 rounded-md shadow-md sm:text-sm"
                        value="{{ $formKpPesawatTenagaProduksi->tekanan_kerja ?? '-' }}" disabled>
                </div>
            </div>
        </div>

        {{-- Setting safety valve --}}
        <div class="flex justify-center">
            <div class="flex items-center w-full md:w-5/6">                    
                <label for="set_safety_valv" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                    • Settingan safety valve?
                </label>
                <div class="w-[30%] md:w-[25%]">
                    <input type="number" step="any" name="set_safety_valv" id="set_safety_valv"
                        class="block w-full px-3 py-1 text-gray-900 bg-gray-200 border border-gray-400 rounded-md shadow-md sm:text-sm"
                        value="{{ $formKpPesawatTenagaProduksi->set_safety_valv ?? '-' }}" disabled>
                </div>
            </div>
        </div>

        {{-- Media --}}
        <div class="flex justify-center">
            <div class="flex items-center w-full md:w-5/6">
                <label for="media_yang_diisikan" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                    • Media yang diisikan?
                </label>
                <div class="w-[30%] md:w-[25%]">
                    <input type="text" name="media_yang_diisikan" id="media_yang_diisikan"
                        class="block w-full px-3 py-1 text-gray-900 bg-gray-200 border border-gray-400 rounded-md shadow-md sm:text-sm"
                        value="{{ $formKpPesawatTenagaProduksi->media_yang_diisikan ?? '-' }}" disabled>
                </div>
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpPesawatTenagaProduksi->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
