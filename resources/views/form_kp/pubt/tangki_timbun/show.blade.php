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
                    <input disabled id="datepicker-autohide" value="{{ optional($formKpTangkiTimbun->tanggal_pemeriksaan)->format('d-m-Y') }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->jobOrderTool->jobOrder->nama_perusahaan ?? '-' }}
            </div>
        </div>

        {{-- Kapasitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->jobOrderTool->kapasitas ?? '-' }}
            </div>
        </div>

        {{-- Model/Tipe --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->jobOrderTool->model ?? '-' }}
            </div>
        </div>

        {{-- No. Seri/Unit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->jobOrderTool->no_seri ?? '-' }}
            </div>
        </div>

        {{-- Tipe Tangki --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe Tangki</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tipe_tangki ?? '-' }}
            </div>
        </div>

        {{-- Pabrik Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->pabrik_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Tempat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tempat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tempat ?? '-' }}
            </div>
        </div>

        {{-- Tahun Pembuat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Pembuat</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tahun_pembuat ?? '-' }}
            </div>
        </div>

        {{-- Tekanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tekanan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tekanan ?? '-' }}
            </div>
        </div>

        {{-- Suhu --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Suhu</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->suhu ?? '-' }}
            </div>
        </div>

        {{-- Media yang Diisikan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Media yang Diisikan</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->media_yang_diisikan ?? '-' }}
            </div>
        </div>

        {{-- Lokasi Tangki --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi Tangki</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->lokasi_tangki ?? '-' }}
            </div>
        </div>

        {{-- foto_visual --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Visual</h2>
            <label for="foto_visual" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoVisual = $formKpTangkiTimbun->foto_visual; 
                if ($fotoVisual && is_string($fotoVisual)) {
                    $fotoVisual = json_decode($fotoVisual, true);
                }            
            @endphp
            @if($fotoVisual && count($fotoVisual) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoVisual as $foto)
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

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="text-gray-700 bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">Komponen</th>
                        <th class="px-3 py-2 text-center border">Ya</th>
                        <th class="px-3 py-2 text-center border">Tidak</th>
                        <th class="px-3 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items = [
                        'tanda_kebocoran' => ['label' => 'Ada tanda kebocoran di permukaan tangki'],
                        'kondisi_tangki' => ['label' => 'Kondisi tangki rusak, berkarat atau buruk'],
                        'komponen_sambungan' => ['label' => 'Baut, kelingan atau sambungan rusak'],
                        'penopang_tangki' => ['label' => 'Penopang tangki rusak atau melengkung'],
                        'pondasi_tangki' => ['label' => 'Pondasi tangki terkikis'],
                        'pengukur_ketinggian' => ['label' => 'Pengukur ketinggian atau alarm rusak'],
                        'ventilasi_terhalang' => ['label' => 'Ventilasi terhalang / terhambat'],
                        'segel_katup' => ['label' => 'Segel katup atau paking ada kebocoran'],
                        'jalur_pemipaan' => ['label' => 'Jalur pemipaan terhalang atau rusak'],
                        'jalur_pipa' => ['label' => 'Jalur pipa bawah tanah mencuat'],
                        'area_bongkar' => ['label' => 'Area bongkar muat rusak'],
                        'sambungan_flense' => ['label' => 'Sambungan tidak ditutup / diberi flense mati'],
                        'secondary_containment' => ['label' => 'Secondary containment rusak'],
                        'katup_drainase' => ['label' => 'Katup drainase tanggul terbuka'],
                        'pagar_gerbang' => ['label' => 'Pagar, gerbang atau penerangan rusak'],
                        'kotak_peralatan' => ['label' => 'Kotak peralatan penanganan tumpahan tidak lengkap'],
                    ];
                    @endphp

                    @foreach ($items as $name => $data)
                    @php
                        $value = $formKpTangkiTimbun->$name ?? null;
                        $keterangan = $formKpTangkiTimbun->{$name . '_keterangan'} ?? '-';
                    @endphp
                    <tr class="relative">
                        {{-- Komponen --}}
                        <td class="px-3 py-2 border font-medium w-[50%]">
                            {{ $data['label'] }}
                        </td>

                        {{-- Radio Ya --}}
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" name="{{ $name }}" value="Ya"
                                {{ $value == 'Ya' ? 'checked' : '' }}
                                class="text-blue-600 border-gray-300 cursor-default pointer-events-none focus:ring-blue-500">
                        </td>

                        {{-- Radio Tidak --}}
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" name="{{ $name }}" value="Tidak"
                                {{ $value == 'Tidak' ? 'checked' : '' }}
                                class="text-blue-600 border-gray-300 cursor-default pointer-events-none focus:ring-blue-500">
                        </td>
                            

                        {{-- Keterangan --}}
                        <td class="px-3 py-2 border">
                            <div class="px-2 py-1 text-sm bg-gray-200 border border-gray-300 rounded-md shadow-sm">
                                {{ $keterangan }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
        {{-- foto_pengukuran --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran/Pengujian</h2>
            <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto Pengukuran/Pengujian</label>
            @php
                $fotoPengukuran = $formKpTangkiTimbun->foto_pengukuran; 
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

        {{-- Grounding 1 (Hasil) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Grounding 1 (Hasil)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->grounding1_hasil ?? '-' }}
            </div>
        </div>

        {{-- Grounding 2 (Hasil) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Grounding 2 (Hasil)</label>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->grounding2_hasil ?? '-' }}
            </div>
        </div>


        {{-- foto_komponen --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran Ketebalan</h2>
            <label for="foto_komponen" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoKomponen = $formKpTangkiTimbun->foto_komponen; 
                if ($fotoKomponen && is_string($fotoKomponen)) {
                    $fotoKomponen = json_decode($fotoKomponen, true);
                }            
            @endphp
            @if($fotoKomponen && count($fotoKomponen) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoKomponen as $foto)
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

        {{-- Komponen --}}
        <div class="grid items-center grid-cols-2 gap-4">
            {{-- Baris 1 --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Komponen</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 1</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell1 ?? '-' }}
            </div>

            {{-- Baris 3 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 2</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell2 ?? '-' }}
            </div>

            {{-- Baris 4 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 3</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell3 ?? '-' }}
            </div>

            {{-- Baris 5 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 4</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell4 ?? '-' }}
            </div>

            {{-- Baris 6 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 5</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell5 ?? '-' }}
            </div>

            {{-- Baris 7 --}}
            <div>
                <label class="block text-sm text-gray-700">Shell 6</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->shell6 ?? '-' }}
            </div>

            {{-- Baris 8 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Pelat Atap/Head 1</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_pelat_atap1 ?? '-' }}
            </div>

            {{-- Baris 9 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Pelat Atap/Head 2</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_pelat_atap2 ?? '-' }}
            </div>

            {{-- Baris 10 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Pelat Bottom 1</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_pelat_bottom1 ?? '-' }}
            </div>

            {{-- Baris 11 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Pelat Bottom 2</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_pelat_bottom2 ?? '-' }}
            </div>

            {{-- Baris 12 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Pipa-pipa/Channel</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_pipa_channel ?? '-' }}
            </div>

            {{-- Baris 13 --}}
            <div>
                <label class="block text-sm text-gray-700">Tebal Instalasi Pipa</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tebal_instalasi_pipa ?? '-' }}
            </div>
        </div>


        {{-- foto_tangki --}}
        <div>
            <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran Dimensi</h2>
            <label for="foto_tangki" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
            @php
                $fotoTangki = $formKpTangkiTimbun->foto_tangki; 
                if ($fotoTangki && is_string($fotoTangki)) {
                    $fotoTangki = json_decode($fotoTangki, true);
                }            
            @endphp
            @if($fotoTangki && count($fotoTangki) > 0)
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($fotoTangki as $foto)
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
        <div class="grid items-center grid-cols-2 gap-4">
            {{-- Header --}}
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Item</label>
            </div>
            <div class="text-center">
                <label class="block text-sm font-bold text-gray-700">Hasil</label>
            </div>

            {{-- Baris 2 --}}
            <div>
                <label class="block text-sm text-gray-700">Diameter Tangki (OD)</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->diameter_tangki ?? '-' }}
            </div>

            {{-- Baris 3 --}}
            <div>
                <label class="block text-sm text-gray-700">Tinggi Tangki Keseluruhan</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tinggi_tangki ?? '-' }}
            </div>

            {{-- Baris 4 --}}
            <div>
                <label class="block text-sm text-gray-700">Secondary Containment (P x L x T)</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->secondary_containtment ?? '-' }}
            </div>

            {{-- Baris 5 --}}
            <div>
                <label class="block text-sm text-gray-700">Tinggi Pagar Atap (Roof)</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tinggi_pagar_atap ?? '-' }}
            </div>

            {{-- Baris 6 --}}
            <div>
                <label class="block text-sm text-gray-700">Pipa-pipa/Channel (OD)</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tinggi_panjang_pipa ?? '-' }}
            </div>

            {{-- Baris 7 --}}
            <div>
                <label class="block text-sm text-gray-700">Instalasi Pipa (OD)</label>
            </div>
            <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                {{ $formKpTangkiTimbun->tinggi_panjang_instalasi_pipa ?? '-' }}
            </div>

            {{-- Baris 8–13 (Shell 1–6) --}}
            @for ($i = 1; $i <= 6; $i++)
                <div>
                    <label class="block text-sm text-gray-700">Tinggi/Panjang Shell {{ $i }}</label>
                </div>
                <div class="px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-sm">
                    {{ $formKpTangkiTimbun->{'tinggi_panjang_shell' . $i} ?? '-' }}
                </div>
            @endfor
        </div>


        {{-- Catatan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" rows="3" disabled
                class="block w-full px-3 py-2 mt-1 leading-normal bg-gray-200 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $formKpBejanaTekan->catatan ?? '-' }}</textarea>
        </div>
    </div>
</x-layout>
