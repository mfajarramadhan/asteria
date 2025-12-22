<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md space-y-4">
        {{-- Tanggal Pemeriksaan --}}
        <div>
            <label class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</label>
            <p class="mt-1 text-gray-900">{{ $formKpInstalasiFireHydrant->tanggal_pemeriksaan ? \Carbon\Carbon::parse($formKpInstalasiFireHydrant->tanggal_pemeriksaan)->format('d-m-Y') : '-' }}</p>
        </div>

        {{-- Foto Informasi Umum --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Informasi Umum</label>
            @if($formKpInstalasiFireHydrant->foto_informasi_umum)
                <div class="flex flex-wrap gap-2">
                    @foreach(json_decode($formKpInstalasiFireHydrant->foto_informasi_umum) as $foto)
                        <img src="{{ asset('storage/' . $foto) }}" class="max-h-48 rounded border shadow-sm">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Tidak ada foto.</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Informasi Umum --}}
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Informasi Umum</h3>
                <dl class="space-y-2">
                    @foreach(['nama_perusahaan', 'kapasitas', 'model_unit', 'nomor_seri', 'pabrik_pembuat', 'jenis', 'lokasi', 'tahun_pembuatan'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- Spesifikasi Fisik & Bangunan --}}
            <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Spesifikasi Fisik & Bangunan</h3>
                 <dl class="space-y-2">
                    @foreach(['luas_lahan', 'total_luas_bangunan', 'struktur_utama', 'struktur_lantai', 'dinding_luar', 'dinding_dalam', 'rangka_plafond', 'penutup_plafond', 'rangka_atap', 'penutup_atap', 'tinggi_bangunan', 'jumlah_lantai', 'jumlah_luas_lantai'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
             {{-- Instalasi & Sumber Air --}}
             <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Instalasi & Sumber Air</h3>
                 <dl class="space-y-2">
                    @foreach(['tahun_pemasangan', 'instalatir', 'sumber_air_baku', 'kapasitas_ground_tank', 'siamese_connection', 'priming_tank'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>

             {{-- Spesifikasi Teknis Bejana & Valve --}}
             <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Bejana Tekan & Valve</h3>
                 <dl class="space-y-2">
                    @foreach(['bejana_liter', 'bejana_tk_kg', 'bejana_tk_uji', 'pressure_relief_valve', 'test_valve'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
            {{-- Komponen Hydrant --}}
             <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Komponen Hydrant</h3>
                 <dl class="space-y-2">
                    @foreach(['jumlah_hydrant_gedung', 'jumlah_hydrant_halaman', 'jumlah_hydrant_pillar', 'jumlah_landing_valve'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>

             {{-- Spesifikasi Pompa --}}
             <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Spesifikasi Pompa</h3>
                 <dl class="space-y-2">
                    @foreach(['merk_model_pompa_jockey', 'merk_model_pompa_utama', 'merk_model_pompa_diesel', 'nomor_seri_pompa_jockey', 'nomor_seri_pompa_utama', 'nomor_seri_pompa_diesel', 'kapasitas_pompa_jockey', 'kapasitas_pompa_utama', 'kapasitas_pompa_diesel', 'daya_pompa_jockey', 'daya_pompa_utama', 'daya_pompa_diesel'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>
        </div>

         <div class="pt-4">
             <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Spesifikasi Pipa & Tekanan</h3>
             <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                @foreach(['pipa_header_diameter', 'pipa_hisap_diameter', 'pipa_penyalur_utama_diameter', 'pipa_tegak_diameter', 'catatan_diameter_pipa', 'tekanan_titik1', 'tekanan_titik2', 'tekanan_titik3', 'keterangan_tekanan'] as $field)
                    <div>
                        <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireHydrant->$field ?? '-' }}</dd>
                    </div>
                @endforeach
                    <div class="col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Catatan</dt>
                        <dd class="text-sm font-semibold text-gray-900 whitespace-pre-wrap">{{ $formKpInstalasiFireHydrant->catatan ?? '-' }}</dd>
                    </div>
             </dl>
        </div>
    </div>
</x-layout>