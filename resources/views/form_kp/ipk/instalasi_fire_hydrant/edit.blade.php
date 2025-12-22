<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.ipk.instalasi_fire_hydrant.update', $formKpInstalasiFireHydrant->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Perbarui data?')">
            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Informasi Pemeriksaan</h2>
            <div class="w-full md:w-[50%]">
                <label class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" value="{{ old('tanggal_pemeriksaan', $formKpInstalasiFireHydrant->tanggal_pemeriksaan ? \Carbon\Carbon::parse($formKpInstalasiFireHydrant->tanggal_pemeriksaan)->format('d-m-Y') : '') }}">
                </div>
            </div>

             {{-- Foto Informasi Umum --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Informasi Umum</label>
                @if($formKpInstalasiFireHydrant->foto_informasi_umum)
                    <div class="flex flex-wrap gap-2 mb-2">
                        @foreach(json_decode($formKpInstalasiFireHydrant->foto_informasi_umum) as $foto)
                            <img src="{{ asset('storage/' . $foto) }}" class="max-h-32 rounded border m-1">
                        @endforeach
                    </div>
                @endif
                <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2 mb-2"></div>
                <input type="file" name="foto_informasi_umum[]" multiple onchange="previewImage(this, 'foto_informasi_umum-preview')" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="text-xs text-gray-500">Upload baru akan menggantikan foto lama.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                     <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                     <input type="text" name="nama_perusahaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('nama_perusahaan', $formKpInstalasiFireHydrant->nama_perusahaan) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                     <input type="text" name="kapasitas" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('kapasitas', $formKpInstalasiFireHydrant->kapasitas) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Model Unit</label>
                     <input type="text" name="model_unit" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('model_unit', $formKpInstalasiFireHydrant->model_unit) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
                     <input type="text" name="nomor_seri" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('nomor_seri', $formKpInstalasiFireHydrant->nomor_seri) }}">
                </div>
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                     <input type="text" name="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('pabrik_pembuat', $formKpInstalasiFireHydrant->pabrik_pembuat) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Jenis</label>
                     <input type="text" name="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('jenis', $formKpInstalasiFireHydrant->jenis) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                     <input type="text" name="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('lokasi', $formKpInstalasiFireHydrant->lokasi) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                     <input type="text" name="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('tahun_pembuatan', $formKpInstalasiFireHydrant->tahun_pembuatan) }}">
                </div>
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Fisik & Bangunan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['luas_lahan', 'total_luas_bangunan', 'struktur_utama', 'struktur_lantai', 'dinding_luar', 'dinding_dalam', 'rangka_plafond', 'penutup_plafond', 'rangka_atap', 'penutup_atap', 'tinggi_bangunan', 'jumlah_lantai', 'jumlah_luas_lantai'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Instalasi & Sumber Air</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['tahun_pemasangan', 'instalatir', 'sumber_air_baku', 'kapasitas_ground_tank', 'siamese_connection', 'priming_tank'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Teknis Bejana & Valve</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['bejana_liter', 'bejana_tk_kg', 'bejana_tk_uji', 'pressure_relief_valve', 'test_valve'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Komponen Hydrant</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['jumlah_hydrant_gedung', 'jumlah_hydrant_halaman', 'jumlah_hydrant_pillar', 'jumlah_landing_valve'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Pompa (Jockey, Utama, Diesel)</h2>
             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['merk_model_pompa_jockey', 'merk_model_pompa_utama', 'merk_model_pompa_diesel', 'nomor_seri_pompa_jockey', 'nomor_seri_pompa_utama', 'nomor_seri_pompa_diesel', 'kapasitas_pompa_jockey', 'kapasitas_pompa_utama', 'kapasitas_pompa_diesel', 'daya_pompa_jockey', 'daya_pompa_utama', 'daya_pompa_diesel'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Pipa & Tekanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['pipa_header_diameter', 'pipa_hisap_diameter', 'pipa_penyalur_utama_diameter', 'pipa_tegak_diameter', 'catatan_diameter_pipa', 'tekanan_titik1', 'tekanan_titik2', 'tekanan_titik3', 'keterangan_tekanan'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field, $formKpInstalasiFireHydrant->$field) }}">
                 </div>
                 @endforeach
                 <div class="col-span-2">
                     <label class="block text-sm font-medium text-gray-700">Catatan</label>
                     <textarea name="catatan" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">{{ old('catatan', $formKpInstalasiFireHydrant->catatan) }}</textarea>
                </div>
            </div>


            <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Perbarui
            </button>
        </form>
    </div>

    <script>
        function previewImage(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = "";
            Array.from(inputElement.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("max-h-32", "rounded", "border", "m-1");
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
</x-layout>