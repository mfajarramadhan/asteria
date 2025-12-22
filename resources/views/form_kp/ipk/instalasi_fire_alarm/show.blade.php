<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md space-y-4">
        {{-- Tanggal Pemeriksaan --}}
        <div>
            <label class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</label>
            <p class="mt-1 text-gray-900">{{ $formKpInstalasiFireAlarm->tanggal_pemeriksaan ? $formKpInstalasiFireAlarm->tanggal_pemeriksaan->format('d-m-Y') : '-' }}</p>
        </div>

        {{-- Foto Informasi Umum --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Informasi Umum</label>
            @if($formKpInstalasiFireAlarm->foto_informasi_umum)
                <div class="flex flex-wrap gap-2">
                    @foreach(json_decode($formKpInstalasiFireAlarm->foto_informasi_umum) as $foto)
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
                    @foreach(['nama_perusahaan', 'kapasitas', 'model_unit', 'nomor_seri', 'pabrik_pembuat', 'jenis', 'lokasi', 'tahun_pembuatan', 'pengguna_bangunan', 'tahun_instalasi', 'instalatir'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireAlarm->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- Spesifikasi Bangunan --}}
            <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Spesifikasi Bangunan</h3>
                 <dl class="space-y-2">
                    @foreach(['luas_lahan', 'luas_bangunan', 'tinggi_bangunan', 'luas_lantai', 'jumlah_lantai'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireAlarm->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
             {{-- Detail Perangkat --}}
             <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Detail Perangkat Fire Alarm</h3>
                 <dl class="space-y-2">
                    @foreach(['panel_control_mcfa', 'annuciator', 'detektor_panas_ror', 'jumlah_detektor_nyala_api_fix', 'detektor_asap', 'detektor_gas', 'tombol_manual_breakglass', 'combination_box'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireAlarm->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                 </dl>
            </div>

            {{-- Spesifikasi Detektor --}}
            <div>
                 <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Spesifikasi Detektor</h3>
                 <dl class="space-y-2">
                    @foreach(['jenis_detektor', 'lokasi_detektor', 'no_zone_detektor', 'hasil_detektor', 'open_circuit_test_detektor', 'keterangan_detektor'] as $field)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $field) }}</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $formKpInstalasiFireAlarm->$field ?? '-' }}</dd>
                        </div>
                    @endforeach
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Catatan Fire Alarm</dt>
                            <dd class="text-sm font-semibold text-gray-900 whitespace-pre-wrap">{{ $formKpInstalasiFireAlarm->catatan_fire_alarm ?? '-' }}</dd>
                        </div>
                 </dl>
            </div>
        </div>

        {{-- Dokumen Pendukung --}}
        <div class="pt-4">
            <h3 class="font-bold text-lg text-gray-800 border-b pb-1 mb-2">Dokumen Pendukung</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['gambar_layout_gedung_perusahaan', 'gambar_instalasi', 'dokumen_spesifikasi_peralatan', 'dokumen_pemeliharaan', 'surat_keterangan_berkala', 'laporan_pemeriksaan_berkala'] as $field)
                 <div class="p-3 border rounded bg-gray-50">
                     <span class="block text-sm font-medium text-gray-600 capitalize mb-1">{{ str_replace('_', ' ', $field) }}</span>
                     @if($formKpInstalasiFireAlarm->$field)
                        <a href="{{ asset('storage/' . $formKpInstalasiFireAlarm->$field) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Lihat Dokumen
                        </a>
                     @else
                        <span class="text-sm text-gray-400 italic">Tidak ada dokumen</span>
                     @endif
                 </div>
                 @endforeach
            </div>
        </div>
    </div>
</x-layout>