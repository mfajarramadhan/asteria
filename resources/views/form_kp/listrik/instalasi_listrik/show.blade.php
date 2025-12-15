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
                        <input disabled id="datepicker-autohide" value="{{ optional($formKpInstalasiListrik->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>

        {{-- foto_informasi_umum --}}
        <div>
            <h2 class="block mb-1 text-base font-bold text-gray-700">Informasi Umum</h2>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoInformasiUmum = $formKpInstalasiListrik->foto_informasi_umum; 
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
                {{ $formKpInstalasiListrik->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Jenis Bejana --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Bejana</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->jenis ?? '-' }}
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->lokasi ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpInstalasiListrik->tahun_pembuatan ?? '-' }}
            </div>
        </div>

        {{-- Daya Terpasang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Daya Terpasang</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('daya_terpasang', $formKpInstalasiListrik->daya_terpasang) ?? '-' }}
            </div>
        </div>

        {{-- Untuk Tenaga --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Untuk Tenaga</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('untuk_tenaga', $formKpInstalasiListrik->untuk_tenaga) ?? '-' }}
            </div>
        </div>

        {{-- Untuk Instalaltir --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Untuk Instalaltir</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('untuk_instalaltir', $formKpInstalasiListrik->untuk_instalaltir) ?? '-' }}
            </div>
        </div>

        {{-- Ampere MCB --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Ampere MCB</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('ampere_mcb', $formKpInstalasiListrik->ampere_mcb) ?? '-' }}
            </div>
        </div>

        {{-- Sumber Daya Listrik --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Sumber Daya Listrik</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('sumber_daya_listrik', $formKpInstalasiListrik->sumber_daya_listrik) ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pemasangan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pemasangan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ old('tahun_pemasangan', $formKpInstalasiListrik->tahun_pemasangan) ?? '-' }}
            </div>
        </div>

        {{-- Pondasi --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                {{-- Baris 1 --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Pondasi</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Foto</label>
                </div>

                {{-- Baris 2 - Konstruksi --}}
                <div>
                    <label class="block text-sm text-gray-700">Konstruksi</label>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ old('konstruksi_hasil', $formKpInstalasiListrik->konstruksi_hasil) ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ old('konstruksi_keterangan', $formKpInstalasiListrik->konstruksi_keterangan) ?? '-' }}
                    </div>
                </div>

                {{-- Detail Foto --}}
                <div class="flex items-center justify-center w-full gap-3">

                    @php
                        $name = 'konstruksi_foto';
                        $foto = json_decode($formKpInstalasiListrik->konstruksi_foto, true) ?? [];
                    @endphp

                    @if (!empty($foto))
                        <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                type="button" 
                                onclick="openModal('{{ $name }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                    4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                    -9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>

                {{-- Modal Foto --}}
                @if (!empty($foto))
                <div id="modal_{{ $name }}" 
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                    <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                        <h2 class="mb-3 text-lg font-bold">Foto Konstruksi</h2>

                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($foto as $file)
                                <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal('{{ $name }}')"
                            class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                            Tutup
                        </button>
                    </div>
                </div>
                @endif

                {{-- Baris 3 - Baut Pengikat --}}
                <div>
                    <label class="block text-sm text-gray-700">Baut Pengikat</label>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->baut_pengikat_hasil ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ old('baut_pengikat_keterangan', $formKpInstalasiListrik->baut_pengikat_keterangan) ?? '-' }}
                    </div>
                </div>

                <div class="flex items-center justify-center w-full gap-3">

                    {{-- TANPA INPUT FILE --}}
                    @php
                        $name = 'baut_pengikat_foto';
                        $foto = json_decode($formKpInstalasiListrik->baut_pengikat_foto, true) ?? [];
                    @endphp

                    @if (!empty($foto))
                        <button class="flex p-2 transition-all duration-500 rounded-full group item-center" 
                                type="button" 
                                onclick="openModal('{{ $name }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                    4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                    -9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>

                {{-- Modal Foto --}}
                @if (!empty($foto))
                <div id="modal_{{ $name }}" 
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    
                    <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                        <h2 class="mb-3 text-lg font-bold">Foto Baut Pengikat</h2>

                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($foto as $file)
                                <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal('{{ $name }}')"
                            class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                            Tutup
                        </button>

                    </div>
                </div>
                @endif

            </div>
        </div>

        
        {{-- Pembumian --}}
        <div class="w-full py-2 overflow-x-auto">
            <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                {{-- Header --}}
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Pembumian</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Hasil</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                </div>
                <div class="text-center">
                    <label class="block text-sm font-bold text-gray-700">Foto</label>
                </div>

                {{-- === Baris 1 : Kabel === --}}
                <div>
                    <label class="block text-sm text-gray-700">Kabel</label>
                </div>

                {{-- Hasil --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->kabel_hasil ?? '-' }}
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->kabel_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Foto --}}
                <div class="flex items-center justify-center w-full">
                    @php
                        $name = 'kabel_foto';
                        $foto = json_decode($formKpInstalasiListrik->kabel_foto, true) ?? [];
                    @endphp

                    @if (!empty($foto))
                        <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                    4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                    -9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>

                {{-- Modal Foto --}}
                @if (!empty($foto))
                <div id="modal_{{ $name }}" 
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    
                    <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                        <h2 class="mb-3 text-lg font-bold">Foto Kabel</h2>

                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($foto as $file)
                                <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal('{{ $name }}')"
                            class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                            Tutup
                        </button>

                    </div>
                </div>
                @endif

                {{-- === Baris 2 : Plat Tembaga === --}}
                <div>
                    <label class="block text-sm text-gray-700">Plat Tembaga</label>
                </div>

                {{-- Hasil --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->plat_tembaga_hasil ?? '-' }}
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->plat_tembaga_keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Foto --}}
                <div class="flex items-center justify-center w-full">
                    @php
                        $name = 'plat_tembaga_foto';
                        $foto = json_decode($formKpInstalasiListrik->plat_tembaga_foto, true) ?? [];
                    @endphp

                    @if (!empty($foto))
                        <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                    4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                    -9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>

                {{-- Modal Foto --}}
                @if (!empty($foto))
                <div id="modal_{{ $name }}" 
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    
                    <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                        <h2 class="mb-3 text-lg font-bold">Foto Plat Tembaga</h2>

                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($foto as $file)
                                <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal('{{ $name }}')"
                            class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                            Tutup
                        </button>

                    </div>
                </div>
                @endif

                {{-- === Baris 3 : Baut Pengikat === --}}
                <div>
                    <label for="baut_pengikat_hasil2" class="block text-sm text-gray-700">Baut Pengikat</label>
                </div>

                {{-- Hasil --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->baut_pengikat_hasil2 ?? '-' }}
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->baut_pengikat_keterangan2 ?? '-' }}
                    </div>
                </div>

                {{-- Foto --}}
                <div class="flex items-center justify-center w-full">
                    @php
                        $name = 'baut_pengikat_foto2';
                        $foto = json_decode($formKpInstalasiListrik->baut_pengikat_foto2, true) ?? [];
                    @endphp

                    @if (!empty($foto))
                        <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                    4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                    -9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>

                {{-- Modal Foto --}}
                @if (!empty($foto))
                <div id="modal_{{ $name }}" 
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    
                    <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                        <h2 class="mb-3 text-lg font-bold">Foto Baut Pengikat</h2>

                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($foto as $file)
                                <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal('{{ $name }}')"
                            class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                            Tutup
                        </button>

                    </div>
                </div>
                @endif

            </div>
        </div>

        {{-- Tempat/Ruang Transformator (Trafo) --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tempat/Ruang Transformator (Trafo)</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Pembatas --}}
                    <div>
                        <label class="block text-sm text-gray-700">Pembatas</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->pembatas_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->pembatas_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'pembatas_foto';
                            $foto = json_decode($formKpInstalasiListrik->pembatas_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Pembatas</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Tanda Peringatan --}}
                    <div>
                        <label class="block text-sm text-gray-700">Tanda Peringatan</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->tanda_peringatan_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->tanda_peringatan_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'tanda_peringatan_foto';
                            $foto = json_decode($formKpInstalasiListrik->tanda_peringatan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" class="flex p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Tanda Peringatan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - APAR --}}
                    <div>
                        <label class="block text-sm text-gray-700">APAR</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->apar_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->apar_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'apar_foto';
                            $foto = json_decode($formKpInstalasiListrik->apar_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto APAR</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Oil Gauge --}}
                    <div>
                        <label class="block text-sm text-gray-700">Oil Gauge</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->oil_gauge_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->oil_gauge_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'oil_gauge_foto';
                            $foto = json_decode($formKpInstalasiListrik->oil_gauge_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Oil Gauge</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Thermal Gauge --}}
                    <div>
                        <label class="block text-sm text-gray-700">Thermal Gauge</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->thermal_gauge_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->thermal_gauge_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'thermal_gauge_foto';
                            $foto = json_decode($formKpInstalasiListrik->thermal_gauge_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                            <h2 class="mb-3 text-lg font-bold">Foto Thermal Gauge</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Panel: Tampak Depan --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Panel: Tampak Depan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Lampu Indikator --}}
                    <div>
                        <label class="block text-sm text-gray-700">Lampu Indikator</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->lampu_indikator_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->lampu_indikator_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'lampu_indikator_foto';
                            $foto = json_decode($formKpInstalasiListrik->lampu_indikator_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Lampu Indikator</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Alat Ukur --}}
                    <div>
                        <label class="block text-sm text-gray-700">Alat Ukur</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->alat_ukur_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->alat_ukur_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'alat_ukur_foto';
                            $foto = json_decode($formKpInstalasiListrik->alat_ukur_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Alat Ukur</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Tanda Pintu Panel --}}
                    <div>
                        <label class="block text-sm text-gray-700">Tanda Pintu Panel</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->tanda_pintu_panel_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->tanda_pintu_panel_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'tanda_pintu_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->tanda_pintu_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Tanda Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kunci Pintu Panel --}}
                    <div>
                        <label class="block text-sm text-gray-700">Kunci Pintu Panel</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kunci_pintu_panel_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kunci_pintu_panel_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'kunci_pintu_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kunci_pintu_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Kunci Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Panel: Tampak Dalam --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Panel: Tampak Dalam</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Cover Pelindung --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Cover pelindung tegangan sentuh langsung
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->cover_pelindung_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->cover_pelindung_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'cover_pelindung_foto';
                            $foto = json_decode($formKpInstalasiListrik->cover_pelindung_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Cover Pelindung</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Gambar Single Line --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Gambar single line diagram dan kartu riwayat perawatan
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->gambar_single_line_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->gambar_single_line_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'gambar_single_line_foto';
                            $foto = json_decode($formKpInstalasiListrik->gambar_single_line_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')" 
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}" 
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Gambar Single Line</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kabel Bonding --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Kabel bonding pengaman sentuh tidak langsung
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kabel_bonding_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kabel_bonding_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'kabel_bonding_foto';
                            $foto = json_decode($formKpInstalasiListrik->kabel_bonding_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Kabel Bonding</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Label --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Labeling
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->label_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->label_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'label_foto';
                            $foto = json_decode($formKpInstalasiListrik->label_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Label</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kode Warna Kabel --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Kode Warna Kabel
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kode_warna_kabel_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kode_warna_kabel_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'kode_warna_kabel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kode_warna_kabel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Kode Warna Kabel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kebersihan Panel --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Kebersihan Panel
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kebersihan_panel_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kebersihan_panel_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'kebersihan_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->kebersihan_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Kebersihan Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Kerapian Instalasi --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Kerapian Instalasi
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kerapian_instalasi_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->kerapian_instalasi_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'kerapian_instalasi_foto';
                            $foto = json_decode($formKpInstalasiListrik->kerapian_instalasi_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Kerapian Instalasi</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Daerah Kerja --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-4 gap-4 pt-6 min-w-[700px]">

                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Daerah Kerja</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Keterangan</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Foto</label>
                    </div>

                    {{-- Baris - Jarak Bagian Depan --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Jarak Bagian Depan
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_depan_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_depan_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'jarak_depan_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_depan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Depan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Jarak Bagian Samping --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Jarak Bagian Samping
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_samping_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_samping_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'jarak_samping_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_samping_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Samping</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Jarak Bagian Belakang --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Jarak Bagian Belakang
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_belakang_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_belakang_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'jarak_belakang_foto';
                            $foto = json_decode($formKpInstalasiListrik->jarak_belakang_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Jarak Bagian Belakang</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Bebas Buka Pintu Panel --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Bebas Buka Pintu Panel
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->bebas_buka_panel_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->bebas_buka_panel_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'bebas_buka_panel_foto';
                            $foto = json_decode($formKpInstalasiListrik->bebas_buka_panel_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Bebas Buka Pintu Panel</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Pencahayaan --}}
                    <div>
                        <label class="block text-sm text-gray-700">Pencahayaan</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->pencahayaan_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->pencahayaan_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'pencahayaan_foto';
                            $foto = json_decode($formKpInstalasiListrik->pencahayaan_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Pencahayaan</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Barang Tidak Terpakai --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Barang-barang yang tidak terpakai
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->barang_tidak_pakai_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->barang_tidak_pakai_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'barang_tidak_pakai_foto';
                            $foto = json_decode($formKpInstalasiListrik->barang_tidak_pakai_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Barang Tidak Terpakai</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Ventilasi --}}
                    <div>
                        <label class="block text-sm text-gray-700">Ventilasi</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->ventilasi_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->ventilasi_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'ventilasi_foto';
                            $foto = json_decode($formKpInstalasiListrik->ventilasi_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Ventilasi</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Baris - Saluran Uap --}}
                    <div>
                        <label class="block text-sm text-gray-700">
                            Tidak dekat saluran uap, gas, air dan saluran yang tidak ada hubungan dengan PHBK
                        </label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->saluran_uap_hasil ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->saluran_uap_keterangan ?? '-' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full gap-3">
                        @php
                            $name = 'saluran_uap_foto';
                            $foto = json_decode($formKpInstalasiListrik->saluran_uap_foto, true) ?? [];
                        @endphp

                        @if (!empty($foto))
                            <button type="button" onclick="openModal('{{ $name }}')"
                                class="flex p-2 transition-all rounded-full group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 
                                        4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                        0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007
                                        -9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>

                    {{-- Modal Foto --}}
                    @if (!empty($foto))
                    <div id="modal_{{ $name }}"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <h2 class="mb-3 text-lg font-bold">Foto Saluran Uap</h2>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($foto as $file)
                                    <img src="{{ asset('storage/' . $file) }}" class="w-full border rounded">
                                @endforeach
                            </div>

                            <button type="button" onclick="closeModal('{{ $name }}')"
                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- dimensi_foto --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Dimensi</h2>
                <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                @php
                    $dimensiFoto = $formKpInstalasiListrik->dimensi_foto; 
                    if ($dimensiFoto && is_string($dimensiFoto)) {
                        $dimensiFoto = json_decode($dimensiFoto, true);
                    }            
                @endphp
                @if($dimensiFoto && count($dimensiFoto) > 0)
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($dimensiFoto as $foto)
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

            {{-- Pondasi --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-3 gap-4 pt-6 min-w-[700px]">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item Test</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran (cm)</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Standar SNI</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Jarak bagian depan</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_bagian_depan ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">Min 75 cm</label>
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Jarak bagian samping</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_bagian_samping ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">Min 150 cm</label>
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Jarak bagian belakang (TR)</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_bagian_belakang_tr ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">TR Min 75 cm</label>
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Jarak bagian belakang (TM)</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_bagian_belakang_tm ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">TM Min 100 cm</label>
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Jarak antar panel</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->jarak_antar_panel ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">Min 150 cm</label>
                    </div>

                    {{-- Baris 7 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Lebar pintu masuk</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->lebar_pintu_masuk ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">Min 75 cm</label>
                    </div>

                    {{-- Baris 8 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Tinggi panel</label>
                    </div>

                    <div>
                        <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                            {{ $formKpInstalasiListrik->tinggi_panel ?? '-' }} cm
                        </div>
                    </div>

                    <div class="text-center">
                        <label class="block text-sm text-gray-700">Min 200 cm</label>
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" placeholder="Keterangan" rows="1" disabled
                    class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiListrik->keterangan ?? '-' }}</textarea>
            </div>

            {{-- pembumian_foto --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pembumian</h2>
                <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                @php
                    $pembumianFoto = $formKpInstalasiListrik->pembumian_foto; 
                    if ($pembumianFoto && is_string($pembumianFoto)) {
                        $pembumianFoto = json_decode($pembumianFoto, true);
                    }            
                @endphp
                @if($pembumianFoto && count($pembumianFoto) > 0)
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($pembumianFoto as $foto)
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

            {{-- Pembumian --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item Test</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo1 ?? '-' }}
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo2 ?? '-' }}
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo3 ?? '-' }}
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Panel</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->panel ?? '-' }}
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Bonding Panel</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->bonding_panel ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan2" id="keterangan2" placeholder="Keterangan" rows="1" disabled
                    class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiListrik->keterangan2 ?? '-' }}</textarea>
            </div>

            {{-- pencahayaan_foto2 --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Pencahayaan</h2>
                <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                @php
                    $pencahayaanFoto = $formKpInstalasiListrik->pencahayaan_foto2; 
                    if ($pencahayaanFoto && is_string($pencahayaanFoto)) {
                        $pencahayaanFoto = json_decode($pencahayaanFoto, true);
                    }            
                @endphp
                @if($pencahayaanFoto && count($pencahayaanFoto) > 0)
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($pencahayaanFoto as $foto)
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

            {{-- Pencahayaan --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item Test</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Area Depan Panel</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->area_depan_panel ?? '-' }}
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Area Belakang Panel</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->area_blikg_panel ?? '-' }}
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Area Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->area_trafo ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan3" id="keterangan3" placeholder="Keterangan" rows="1" disabled
                    class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiListrik->keterangan3 ?? '-' }}</textarea>
            </div>

            {{-- thermography_foto --}}
            <div>
                <h2 class="block mb-1 text-base font-bold text-gray-700">Thermography</h2>
                <label class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                @php
                    $thermographyFoto = $formKpInstalasiListrik->thermography_foto; 
                    if ($thermographyFoto && is_string($thermographyFoto)) {
                        $thermographyFoto = json_decode($thermographyFoto, true);
                    }            
                @endphp
                @if($thermographyFoto && count($thermographyFoto) > 0)
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($thermographyFoto as $foto)
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

            {{-- Thermography --}}
            <div class="w-full py-2 overflow-x-auto">
                <div class="grid items-center grid-cols-2 gap-4 min-w-[700px]">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item Test</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil Pengukuran</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo1_thermal ?? '-' }}
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo2_thermal ?? '-' }}
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Trafo</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->trafo3_thermal ?? '-' }}
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Circuit Breaker Utama</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->circuit_breaker_utama ?? '-' }}
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Circuit Breaker Distribusi</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->circuit_breaker_distribusi ?? '-' }}
                    </div>

                    {{-- Baris 7 --}}
                    <div>
                        <label class="block text-sm text-gray-700">Busbar</label>
                    </div>
                    <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                        {{ $formKpInstalasiListrik->busbar ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan4" id="keterangan4" placeholder="Keterangan" rows="1" disabled
                    class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiListrik->keterangan4 ?? '-' }}</textarea>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                    class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpInstalasiListrik->catatan ?? '-' }}</textarea>
            </div>
        </div>
        
    <script>
        // Modal
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
