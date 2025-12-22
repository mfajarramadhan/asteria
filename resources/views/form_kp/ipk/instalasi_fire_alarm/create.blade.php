<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.ipk.instalasi_fire_alarm.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
            @csrf

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Informasi Umum</h2>
            <div class="w-full md:w-[50%]">
                <label class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" value="{{ old('tanggal_pemeriksaan') }}">
                </div>
            </div>

            {{-- Foto Informasi Umum --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Informasi Umum</label>
                <div id="foto_informasi_umum-preview" class="flex flex-wrap gap-2 mb-2"></div>
                <input type="file" name="foto_informasi_umum[]" multiple onchange="previewImage(this, 'foto_informasi_umum-preview')" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                     <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                     <input type="text" name="nama_perusahaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('nama_perusahaan', $jobOrderTool->jobOrder->nama_perusahaan) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                     <input type="text" name="kapasitas" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('kapasitas', $jobOrderTool->tool->kapasitas) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Model Unit</label>
                     <input type="text" name="model_unit" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('model_unit', $jobOrderTool->tool->merk_tipe) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Nomor Seri</label>
                     <input type="text" name="nomor_seri" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('nomor_seri', $jobOrderTool->tool->no_seri) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                     <input type="text" name="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('pabrik_pembuat', $jobOrderTool->tool->pabrik_pembuat) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Jenis</label>
                     <input type="text" name="jenis" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('jenis') }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                     <input type="text" name="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('lokasi') }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
                     <input type="text" name="tahun_pembuatan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('tahun_pembuatan', $jobOrderTool->tool->tahun_pembuatan) }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Pengguna Bangunan</label>
                     <input type="text" name="pengguna_bangunan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('pengguna_bangunan') }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Tahun Instalasi</label>
                     <input type="text" name="tahun_instalasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('tahun_instalasi') }}">
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Instalatir</label>
                     <input type="text" name="instalatir" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('instalatir') }}">
                </div>
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Bangunan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Luas Lahan</label>
                     <input type="number" step="0.0001" name="luas_lahan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('luas_lahan') }}">
                </div>
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Luas Bangunan</label>
                     <input type="number" step="0.0001" name="luas_bangunan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('luas_bangunan') }}">
                </div>
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Tinggi Bangunan</label>
                     <input type="number" step="0.0001" name="tinggi_bangunan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('tinggi_bangunan') }}">
                </div>
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Luas Lantai</label>
                     <input type="number" step="0.0001" name="luas_lantai" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('luas_lantai') }}">
                </div>
                 <div>
                     <label class="block text-sm font-medium text-gray-700">Jumlah Lantai</label>
                     <input type="number" step="0.0001" name="jumlah_lantai" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old('jumlah_lantai') }}">
                </div>
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Detail Perangkat Fire Alarm</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['panel_control_mcfa', 'annuciator', 'detektor_panas_ror', 'jumlah_detektor_nyala_api_fix', 'detektor_asap', 'detektor_gas', 'tombol_manual_breakglass', 'combination_box'] as $field)
                <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field) }}">
                </div>
                @endforeach
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Spesifikasi Detektor</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['jenis_detektor', 'lokasi_detektor', 'no_zone_detektor', 'hasil_detektor', 'open_circuit_test_detektor', 'keterangan_detektor'] as $field)
                <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="text" name="{{ $field }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm" value="{{ old($field) }}">
                </div>
                @endforeach
                 <div class="col-span-2">
                     <label class="block text-sm font-medium text-gray-700">Catatan Fire Alarm</label>
                     <textarea name="catatan_fire_alarm" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">{{ old('catatan_fire_alarm') }}</textarea>
                </div>
            </div>

            <h2 class="block text-sm font-bold text-gray-700 mt-4">Dokumen Pendukung</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @foreach(['gambar_layout_gedung_perusahaan', 'gambar_instalasi', 'dokumen_spesifikasi_peralatan', 'dokumen_pemeliharaan', 'surat_keterangan_berkala', 'laporan_pemeriksaan_berkala'] as $field)
                 <div>
                     <label class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                     <input type="file" name="{{ $field }}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                 </div>
                 @endforeach
            </div>

            <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Simpan
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