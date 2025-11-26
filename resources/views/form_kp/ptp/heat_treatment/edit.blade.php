<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.ptp.heat_treatment.update', $formKpHeatTreatment->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                <div class="w-full md:w-[48%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan"
                            value="{{ old('tanggal_pemeriksaan', optional($formKpHeatTreatment->tanggal_pemeriksaan)->format('d-m-Y')) }}"
                            datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
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
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpHeatTreatment->jobOrderTool->jobOrder->nama_perusahaan }}">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpHeatTreatment->jobOrderTool->kapasitas }}">
            </div>

            {{-- Model/Tipe --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpHeatTreatment->jobOrderTool->model }}">
            </div>

            {{-- No.Seri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpHeatTreatment->jobOrderTool->no_seri }}">
            </div>

            {{-- Pabrik Pembuat --}}
            <div>
                <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpHeatTreatment->pabrik_pembuat) }}">
                @error('pabrik_pembuat')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" placeholder="Lokasi" id="lokasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi', $formKpHeatTreatment->lokasi) }}">
                @error('lokasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis/Tipe --}}
            <div>
                <label for="jenis_tipe" class="block text-sm font-medium text-gray-700">Jenis/Tipe</label>
                <input type="text" name="jenis_tipe" placeholder="Jenis/Tipe" id="jenis_tipe" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_tipe') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_tipe', $formKpHeatTreatment->jenis_tipe) }}">
                @error('jenis_tipe')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- foto_billet --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Jenis Billet</h2>
                <label for="foto_billet" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                {{-- foto lama --}}
                @if($formKpHeatTreatment->foto_billet)
                @php $oldFiles = json_decode($formKpHeatTreatment->foto_billet, true); @endphp
                @if(is_array($oldFiles))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($oldFiles as $oldFile)
                    <img src="{{ asset('storage/' . $oldFile) }}"
                        alt="Foto Shell Lama"
                        class="object-contain w-32 border rounded">
                    @endforeach
                </div>
                @endif
                @endif

                {{-- preview baru --}}
                <div id="foto_billet-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_billet[]"
                    id="foto_billet"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_billet-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_billet') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_billet')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Dimensi Billet Maksimum --}}
            <div>
                <label for="dimensi_billet_maks" class="block text-sm font-medium text-gray-700">Dimensi Billet Maksimum</label>
                <input type="number" step="any" name="dimensi_billet_maks" placeholder="Dimensi Billet Maksimum" id="dimensi_billet_maks" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('dimensi_billet_maks') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('dimensi_billet_maks', $formKpHeatTreatment->dimensi_billet_maks) }}">
                @error('dimensi_billet_maks')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Berat Billet Maksimum --}}
            <div>
                <label for="berat_billet_maks" class="block text-sm font-medium text-gray-700">Berat Billet Maksimum</label>
                <input type="number" step="any" name="berat_billet_maks" placeholder="Berat Billet Maksimum" id="berat_billet_maks" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('berat_billet_maks') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('berat_billet_maks', $formKpHeatTreatment->berat_billet_maks) }}">
                @error('berat_billet_maks')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kapasitas Maksimum --}}
            <div>
                <label for="kapasitas_maks" class="block text-sm font-medium text-gray-700">Kapasitas Maksimum</label>
                <input type="number" step="any" name="kapasitas_maks" placeholder="Kapasitas Maksimum" id="kapasitas_maks" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_maks') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_maks', $formKpHeatTreatment->kapasitas_maks) }}">
                @error('kapasitas_maks')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kapasitas Efektif --}}
            <div>
                <label for="kapasitas_efektif" class="block text-sm font-medium text-gray-700">Kapasitas Efektif</label>
                <input type="number" step="any" name="kapasitas_efektif" placeholder="Kapasitas Efektif" id="kapasitas_efektif" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_efektif') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_efektif', $formKpHeatTreatment->kapasitas_efektif) }}">
                @error('kapasitas_efektif')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- foto_shell --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Shell</h2>
                <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                {{-- foto lama --}}
                @if($formKpHeatTreatment->foto_shell)
                @php $oldFiles = json_decode($formKpHeatTreatment->foto_shell, true); @endphp
                @if(is_array($oldFiles))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($oldFiles as $oldFile)
                    <img src="{{ asset('storage/' . $oldFile) }}"
                        alt="Foto Shell Lama"
                        class="object-contain w-32 border rounded">
                    @endforeach
                </div>
                @endif
                @endif

                {{-- preview baru --}}
                <div id="foto_shell-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_shell[]"
                    id="foto_shell"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_shell-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_shell')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tebal Dinding Shell --}}
            <div>
                <label for="tebal_dinding_shell" class="block text-sm font-medium text-gray-700">Tebal Dinding/Stell Shell</label>
                <input type="number" step="any" name="tebal_dinding_shell" placeholder="Tebal Dinding/Stell Shell" id="tebal_dinding_shell" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_dinding_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_dinding_shell', $formKpHeatTreatment->tebal_dinding_shell) }}">
                @error('tebal_dinding_shell')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Material Shell --}}
            <div>
                <label for="material_shell" class="block text-sm font-medium text-gray-700">Material Shell</label>
                <input type="text" name="material_shell" placeholder="Material Shell" id="material_shell" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('material_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('material_shell', $formKpHeatTreatment->material_shell) }}">
                @error('material_shell')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tebal Refractory Shaped --}}
            <div>
                <label for="tebal_refractory_shaped" class="block text-sm font-medium text-gray-700">Tebal Refractory (Shaped/Cetak)</label>
                <input type="number" step="any" name="tebal_refractory_shaped" placeholder="Tebal Refractory (Shaped/Cetak)" id="tebal_refractory_shaped" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_refractory_shaped') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_refractory_shaped', $formKpHeatTreatment->tebal_refractory_shaped) }}">
                @error('tebal_refractory_shaped')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tebal Refractory Unshaped --}}
            <div>
                <label for="tebal_refractory_unshaped" class="block text-sm font-medium text-gray-700">Tebal Refractory (Unshaped/Monolithic)</label>
                <input type="number" step="any" name="tebal_refractory_unshaped" placeholder="Tebal Refractory (Unshaped/Monolithic)" id="tebal_refractory_unshaped" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_refractory_unshaped') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_refractory_unshaped', $formKpHeatTreatment->tebal_refractory_unshaped) }}">
                @error('tebal_refractory_unshaped')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jarak Antar Refractory --}}
            <div>
                <label for="jarak_antar_refractory" class="block text-sm font-medium text-gray-700">Jarak Antar Refractory</label>
                <input type="number" step="any" name="jarak_antar_refractory" placeholder="Jarak Antar Refractory" id="jarak_antar_refractory" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jarak_antar_refractory') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jarak_antar_refractory', $formKpHeatTreatment->jarak_antar_refractory) }}">
                @error('jarak_antar_refractory')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- foto_jalur_furnace --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Jalur Operasi Furnace</h2>
                <label for="foto_jalur_furnace" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                {{-- foto lama --}}
                @if($formKpHeatTreatment->foto_jalur_furnace)
                @php $oldFiles = json_decode($formKpHeatTreatment->foto_jalur_furnace, true); @endphp
                @if(is_array($oldFiles))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($oldFiles as $oldFile)
                    <img src="{{ asset('storage/' . $oldFile) }}"
                        alt="Foto Shell Lama"
                        class="object-contain w-32 border rounded">
                    @endforeach
                </div>
                @endif
                @endif

                {{-- preview baru --}}
                <div id="foto_jalur_furnace-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_jalur_furnace[]"
                    id="foto_jalur_furnace"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_jalur_furnace-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_jalur_furnace') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_jalur_furnace')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jumlah Jalur Operasi --}}
            <div>
                <label for="jumlah_jalur_operasi" class="block text-sm font-medium text-gray-700">Jumlah Jalur Operasi</label>
                <input type="number" step="any" name="jumlah_jalur_operasi" placeholder="Jumlah Jalur Operasi" id="jumlah_jalur_operasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_jalur_operasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jumlah_jalur_operasi', $formKpHeatTreatment->jumlah_jalur_operasi) }}">
                @error('jumlah_jalur_operasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Panjang Jalur Operasi --}}
            <div>
                <label for="panjang_jalur_operasi" class="block text-sm font-medium text-gray-700">Panjang Jalur Operasi</label>
                <input type="number" step="any" name="panjang_jalur_operasi" placeholder="Panjang Jalur Operasi" id="panjang_jalur_operasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('panjang_jalur_operasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('panjang_jalur_operasi', $formKpHeatTreatment->panjang_jalur_operasi) }}">
                @error('panjang_jalur_operasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Dimensi Total Furnace --}}
            <div>
                <label for="dimensi_total_furnace" class="block text-sm font-medium text-gray-700">Dimensi Total Furnace</label>
                <input type="text" name="dimensi_total_furnace" placeholder="Dimensi Total Furnace" id="dimensi_total_furnace" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('dimensi_total_furnace') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('dimensi_total_furnace', $formKpHeatTreatment->dimensi_total_furnace) }}">
                @error('dimensi_total_furnace')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Dimensi Efektif Furnace --}}
            <div>
                <label for="dimensi_efektif_furnace" class="block text-sm font-medium text-gray-700">Dimensi Efektif Furnace</label>
                <input type="text" name="dimensi_efektif_furnace" placeholder="Dimensi Efektif Furnace" id="dimensi_efektif_furnace" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('dimensi_efektif_furnace') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('dimensi_efektif_furnace', $formKpHeatTreatment->dimensi_efektif_furnace) }}">
                @error('dimensi_efektif_furnace')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- foto_pembakaran --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Proses Pembakaran</h2>
                <label for="foto_pembakaran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpHeatTreatment->foto_pembakaran)
                @php $oldFiles = json_decode($formKpHeatTreatment->foto_pembakaran, true); @endphp
                @if(is_array($oldFiles))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($oldFiles as $oldFile)
                    <img src="{{ asset('storage/' . $oldFile) }}"
                        alt="Foto Shell Lama"
                        class="object-contain w-32 border rounded">
                    @endforeach
                </div>
                @endif
                @endif

                {{-- preview baru --}}
                <div id="foto_pembakaran-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_pembakaran[]"
                    id="foto_pembakaran"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pembakaran-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pembakaran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pembakaran')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Bahan Bakar --}}
            <div>
                <label for="bahan_bakar" class="block text-sm font-medium text-gray-700">Bahan Bakar</label>
                <input type="text" name="bahan_bakar" placeholder="Bahan Bakar" id="bahan_bakar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('bahan_bakar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('bahan_bakar', $formKpHeatTreatment->bahan_bakar) }}">
                @error('bahan_bakar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Temp Awal --}}
            <div>
                <label for="temp_awal" class="block text-sm font-medium text-gray-700">Temp. Kerja Pemanasan Awal</label>
                <input type="number" step="any" name="temp_awal" placeholder="Temp. Kerja Pemanasan Awal" id="temp_awal" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('temp_awal') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('temp_awal', $formKpHeatTreatment->temp_awal) }}">
                @error('temp_awal')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Temp Akhir --}}
            <div>
                <label for="temp_akhir" class="block text-sm font-medium text-gray-700">Temp. Kerja Pemanasan Akhir</label>
                <input type="number" step="any" name="temp_akhir" placeholder="Temp. Kerja Pemanasan Akhir" id="temp_akhir" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('temp_akhir') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('temp_akhir', $formKpHeatTreatment->temp_akhir) }}">
                @error('temp_akhir')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tekanan Nozel NG --}}
            <div>
                <label for="tekanan_nozel_ng" class="block text-sm font-medium text-gray-700">Tekanan Nosel NG/LNG</label>
                <input type="number" step="any" name="tekanan_nozel_ng" placeholder="Tekanan Nosel NG/LNG" id="tekanan_nozel_ng" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_nozel_ng') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_nozel_ng', $formKpHeatTreatment->tekanan_nozel_ng) }}">
                @error('tekanan_nozel_ng')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kapasitas Nozel NG --}}
            <div>
                <label for="kapasitas_nozel_ng" class="block text-sm font-medium text-gray-700">Kapasitas Nozel NG/LNG</label>
                <input type="number" step="any" name="kapasitas_nozel_ng" placeholder="Kapasitas Nozel NG/LNG" id="kapasitas_nozel_ng" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_nozel_ng') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_nozel_ng', $formKpHeatTreatment->kapasitas_nozel_ng) }}">
                @error('kapasitas_nozel_ng')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tekanan Nozel Oksigen --}}
            <div>
                <label for="tekanan_nozel_oksigen" class="block text-sm font-medium text-gray-700">Tekanan Nozel Oksigen</label>
                <input type="number" step="any" name="tekanan_nozel_oksigen" placeholder="Tekanan Nozel Oksigen" id="tekanan_nozel_oksigen" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_nozel_oksigen') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_nozel_oksigen', $formKpHeatTreatment->tekanan_nozel_oksigen) }}">
                @error('tekanan_nozel_oksigen')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kapasitas Nozel Oksigen --}}
            <div>
                <label for="kapasitas_nozel_oksigen" class="block text-sm font-medium text-gray-700">Kapasitas Nozel Oksigen</label>
                <input type="number" step="any" name="kapasitas_nozel_oksigen" placeholder="Kapasitas Nozel Oksigen" id="kapasitas_nozel_oksigen" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_nozel_oksigen') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_nozel_oksigen', $formKpHeatTreatment->kapasitas_nozel_oksigen) }}">
                @error('kapasitas_nozel_oksigen')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tekanan Nozel N2 --}}
            <div>
                <label for="tekanan_nozel_n2" class="block text-sm font-medium text-gray-700">Tekanan Nozel N₂</label>
                <input type="number" step="any" name="tekanan_nozel_n2" placeholder="Tekanan Nozel N₂" id="tekanan_nozel_n2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_nozel_n2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_nozel_n2', $formKpHeatTreatment->tekanan_nozel_n2) }}">
                @error('tekanan_nozel_n2')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Kapasitas Nozel N2 --}}
            <div>
                <label for="kapasitas_nozel_n2" class="block text-sm font-medium text-gray-700">Kapasitas Nozel N₂</label>
                <input type="number" step="any" name="kapasitas_nozel_n2" placeholder="Kapasitas Nozel N₂" id="kapasitas_nozel_n2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kapasitas_nozel_n2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('kapasitas_nozel_n2', $formKpHeatTreatment->kapasitas_nozel_n2) }}">
                @error('kapasitas_nozel_n2')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tebal Pipa Bakar --}}
            <div>
                <label for="tebal_pipa_bakar" class="block text-sm font-medium text-gray-700">Tebal Pipa Bahan Bakar</label>
                <input type="number" step="any" name="tebal_pipa_bakar" placeholder="Tebal Pipa Bahan Bakar" id="tebal_pipa_bakar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pipa_bakar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pipa_bakar', $formKpHeatTreatment->tebal_pipa_bakar) }}">
                @error('tebal_pipa_bakar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Diameter Pipa Bakar --}}
            <div>
                <label for="diameter_pipa_bakar" class="block text-sm font-medium text-gray-700">Diameter Pipa Bahan Bakar</label>
                <input type="number" step="any" name="diameter_pipa_bakar" placeholder="Diameter Pipa Bahan Bakar" id="diameter_pipa_bakar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('diameter_pipa_bakar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('diameter_pipa_bakar', $formKpHeatTreatment->diameter_pipa_bakar) }}">
                @error('diameter_pipa_bakar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Jenis Pipa --}}
            <div>
                <label for="jenis_pipa" class="block text-sm font-medium text-gray-700">Jenis Pipa</label>
                <input type="text" name="jenis_pipa" placeholder="Jenis Pipa" id="jenis_pipa" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jenis_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('jenis_pipa', $formKpHeatTreatment->jenis_pipa) }}">
                @error('jenis_pipa')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Dimensi Pondasi --}}
            <div>
                <label for="dimensi_pondasi" class="block text-sm font-medium text-gray-700">Dimensi Pondasi</label>
                <input type="text" name="dimensi_pondasi" placeholder="Dimensi Pondasi" id="dimensi_pondasi" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('dimensi_pondasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('dimensi_pondasi', $formKpHeatTreatment->dimensi_pondasi) }}">
                @error('dimensi_pondasi')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- foto_pendingin --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Sistem Pendingin</h2>
                <label for="foto_pendingin" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>

                {{-- foto lama --}}
                @if($formKpHeatTreatment->foto_pendingin)
                @php $oldFiles = json_decode($formKpHeatTreatment->foto_pendingin, true); @endphp
                @if(is_array($oldFiles))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($oldFiles as $oldFile)
                    <img src="{{ asset('storage/' . $oldFile) }}"
                        alt="Foto Shell Lama"
                        class="object-contain w-32 border rounded">
                    @endforeach
                </div>
                @endif
                @endif

                {{-- preview baru --}}
                <div id="foto_pendingin-preview" class="flex flex-wrap gap-2 mb-2"></div>

                <input
                    type="file"
                    name="foto_pendingin[]"
                    id="foto_pendingin"
                    accept="image/*"
                    multiple
                    onchange="previewImageDynamic(this, 'foto_pendingin-preview')"
                    class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pendingin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                @error('foto_pendingin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Temp Air Masuk --}}
            <div>
                <label for="temp_air_masuk" class="block text-sm font-medium text-gray-700">Temp Air Pendingin Masuk</label>
                <input type="number" step="any" name="temp_air_masuk" placeholder="Temp Air Pendingin Masuk" id="temp_air_masuk" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('temp_air_masuk') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('temp_air_masuk', $formKpHeatTreatment->temp_air_masuk) }}">
                @error('temp_air_masuk')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Temp Air Keluar --}}
            <div>
                <label for="temp_air_keluar" class="block text-sm font-medium text-gray-700">Temp Air Pendingin Kembali</label>
                <input type="number" step="any" name="temp_air_keluar" placeholder="Temp Air Pendingin Kembali" id="temp_air_keluar" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('temp_air_keluar') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('temp_air_keluar', $formKpHeatTreatment->temp_air_keluar) }}">
                @error('temp_air_keluar')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tekanan Air --}}
            <div>
                <label for="tekanan_air" class="block text-sm font-medium text-gray-700">Tekanan Air Pendingin</label>
                <input type="number" step="any" name="tekanan_air" placeholder="Tekanan Air Pendingin" id="tekanan_air" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan_air') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan_air', $formKpHeatTreatment->tekanan_air) }}">
                @error('tekanan_air')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Laju Aliran Air --}}
            <div>
                <label for="laju_aliran_air" class="block text-sm font-medium text-gray-700">Laju Aliran Air Pendingin</label>
                <input type="number" step="any" name="laju_aliran_air" placeholder="Laju Aliran Air Pendingin" id="laju_aliran_air" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('laju_aliran_air') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('laju_aliran_air', $formKpHeatTreatment->laju_aliran_air) }}">
                @error('laju_aliran_air')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Diameter Pipa Pendingin --}}
            <div>
                <label for="diameter_pipa_pendingin" class="block text-sm font-medium text-gray-700">Diameter Pipa Pendingin</label>
                <input type="number" step="any" name="diameter_pipa_pendingin" placeholder="Diameter Pipa Pendingin" id="diameter_pipa_pendingin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('diameter_pipa_pendingin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('diameter_pipa_pendingin', $formKpHeatTreatment->diameter_pipa_pendingin) }}">
                @error('diameter_pipa_pendingin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Tebal Pipa Pendingin --}}
            <div>
                <label for="tebal_pipa_pendingin" class="block text-sm font-medium text-gray-700">Tebal Pipa Pendingin</label>
                <input type="number" step="any" name="tebal_pipa_pendingin" placeholder="Tebal Pipa Pendingin" id="tebal_pipa_pendingin" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pipa_pendingin') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pipa_pendingin', $formKpHeatTreatment->tebal_pipa_pendingin) }}">
                @error('tebal_pipa_pendingin')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300">
                    <thead class="text-gray-700 bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-center border">Bagian - Bagian</th>
                            <th class="px-3 py-2 text-center border">Memenuhi Syarat</th>
                            <th class="px-3 py-2 text-center border">Tidak Memenuhi Syarat</th>
                            <th class="px-3 py-2 text-center border">Keterangan</th>
                            <th class="px-3 py-2 text-center border">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = [
                            'konstruksi_pondasi_furnace' => ['label' => 'Konstruksi Pondasi Furnace'],
                                'furnace_shell' => ['label' => 'Furnace Shell'],
                                'sambungan_las' => ['label' => 'Sambungan Las Steel Shell'],
                                'tutup_furnace' => ['label' => 'Tutup Furnace (Roof/Cover Vessel)'],
                                'refractory' => ['label' => 'Refractory'],
                                'furnace_roof' => ['label' => 'Furnace Roof/Tutup Refractory'],
                                'furnace_sidewalls_refractory' => ['label' => 'Furnace Sidewalls Refractory'],
                                'furnace_hearth_refractory' => ['label' => 'Furnace Hearth Refractory'],
                                'clamping_hydraulic' => ['label' => 'Clamping Hydraulic'],
                                'charging_table' => ['label' => 'Heating Table/Charging Table'],
                                'furnace_top_igniter' => ['label' => 'Furnace Top Igniter'],
                                'burner' => ['label' => 'Burner'],
                                'conveyor' => ['label' => 'Conveyor'],
                                'control_room' => ['label' => 'Control Room'],
                                'pipa_nosel' => ['label' => 'Pipa & Nosel'],
                                'nosel_ng' => ['label' => 'Nosel NG/LNG'],
                                'pipa_ng' => ['label' => 'Pipa NG/LNG'],
                                'nosel_oksigen' => ['label' => 'Nosel Oksigen'],
                                'pipa_oksigen' => ['label' => 'Pipa Oksigen'],
                                'nosel_n2' => ['label' => 'Nosel N₂'],
                                'pipa_n2' => ['label' => 'Pipa N₂'],
                                'safety_valve' => ['label' => 'Safety Valve'],
                                'holder_cap' => ['label' => 'Holder Cap'],
                                'sistem_pendingin' => ['label' => 'Sistem Pendingin'],
                                'sistem_pendingin_tutup' => ['label' => 'Sistem Pendingin Tutup/Roof'],
                                'sistem_pendingin_shell' => ['label' => 'Sistem Pendingin Shell'],
                                'pipa_air_pendingin_shell' => ['label' => 'Pipa Air Pendingin Shell'],
                                'sistem_pendingin_kejut' => ['label' => 'Sistem Pendingin Kejut/Emergency'],
                                'sistem_kelistrikan' => ['label' => 'Sistem Kelistrikan'],
                                'mcb' => ['label' => 'MCB'],
                                'sambungan_bracket' => ['label' => 'Sambungan & Bracket'],
                                'tahanan_isolasi' => ['label' => 'Tahanan Isolasi'],
                                'safety_device' => ['label' => 'Safety Device'],
                                'pressure_gauge' => ['label' => 'Pressure Gauge'],
                                'temp_idicator' => ['label' => 'Temp Indicator'],
                                'sensor_bahan_bakar' => ['label' => 'Sensor-Sensor Bahan Bakar'],
                                'thermocouple' => ['label' => 'Thermocouple'],
                                'sistem_pembumian' => ['label' => 'Sistem Pembumian (Grounding)'],
                                'furnace_top_bleeding' => ['label' => 'Furnace Top Bleeding Valve'],
                                'safety_valve_nitrogen_supply' => ['label' => 'Safety Valve Nitrogen Supply'],
                                'safety_valve_ng_cng' => ['label' => 'Safety Valve NG / CNG'],
                                'safety_valve_oksigen' => ['label' => 'Safety Valve Oksigen'],
                                'safety_valve_n2' => ['label' => 'Safety Valve N₂'],
                                'dust_collector' => ['label' => 'Dust Collector'],
                                'gas_stop_valve' => ['label' => 'Gas Stop Valve'],
                                'dust_remover' => ['label' => 'Dust Remover Bleeding Valve'],
                                'electrostatis_precipitator_bag' => ['label' => 'Electrostatic Precipitator Bag Filter'],
                                'emergency_stop' => ['label' => 'Emergency Stop'],
                                'pagar_pengaman_lantai' => ['label' => 'Pagar Pengaman Lantai'],
                                'lantai_dapur' => ['label' => 'Lantai Dapur'],
                                'pagar_pengaman_tangga' => ['label' => 'Pagar Pengaman Tangga'],
                            ];
                        @endphp

                        @foreach ($items as $name => $data)
                        @php
                            $value = old($name, $formKpHeatTreatment->$name ?? null);
                            $ket   = old("keterangan_$name", $formKpHeatTreatment->{"keterangan_$name"} ?? null);

                            // FIX: Foto harus selalu array
                            $fotoRaw = $formKpHeatTreatment->{"foto_$name"} ?? null;

                            if (is_string($fotoRaw)) {
                                $decoded = json_decode($fotoRaw, true);
                                $foto = is_array($decoded) ? $decoded : [];
                            } elseif (is_array($fotoRaw)) {
                                $foto = $fotoRaw;
                            } else {
                                $foto = [];
                            }
                        @endphp

                        <tr class="relative">
                            <td class="px-3 py-2 border font-medium w-[50%]">
                                <div class="flex items-center justify-between gap-2">
                                    {{ $data['label'] }}
                                </div>
                            </td>

                            {{-- Radio Ya --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio"
                                    name="{{ $name }}"
                                    value="Ya"
                                    {{ $value == 'Ya' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Radio Tidak --}}
                            <td class="px-3 py-2 text-center border">
                                <input type="radio"
                                    name="{{ $name }}"
                                    value="Tidak"
                                    {{ $value == 'Tidak' ? 'checked' : '' }}
                                    class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-2 border">
                                <input type="text"
                                    name="keterangan_{{ $name }}"
                                    value="{{ $ket }}"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </td>

                            {{-- Foto --}}
                            <td class="px-3 py-2 border">
                                <div class="flex items-center justify-between w-full gap-3">
                                    
                                    {{-- Input File --}}
                                    <input type="file" name="foto_{{ $name }}[]" id="foto_{{ $name }}" 
                                    accept="image/*" multiple
                                    class="block px-3 py-2 border border-gray-300 rounded-md shadow-md w-max focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    
                                    {{-- Tombol Lihat Foto --}}
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
                                    @endif
                                </div>

                                {{-- Modal tetap di bawah, tidak berubah --}}
                                @if (!empty($foto))
                                    <div id="modal_{{ $name }}" 
                                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">

                                        <div class="bg-white p-5 rounded shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">

                                            <h2 class="mb-3 text-lg font-bold">Foto — {{ $data['label'] }}</h2>

                                            <div class="grid grid-cols-2 gap-3">
                                                @foreach ($foto as $file)
                                                    <img src="{{ asset('storage/' . $file) }}" 
                                                        class="w-full border rounded">
                                                @endforeach
                                            </div>

                                            <button type="button" onclick="closeModal('{{ $name }}')"
                                                class="px-4 py-2 mt-4 text-white bg-red-500 rounded">
                                                Tutup
                                            </button>

                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            {{-- Catatan --}}
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpHeatTreatment->catatan) }}</textarea>
                @error('catatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Submit --}}
            <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%]">
                Update
            </button>
        </form>
    </div>
    <script>
        // Add preview image upload
        function previewImageDynamic(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = ''; // Kosongkan preview sebelumnya

            if (inputElement.files && inputElement.files.length > 0) {
                Array.from(inputElement.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.classList = "relative inline-block";

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList = "object-contain w-32 h-32 border rounded";

                        const btn = document.createElement('button');
                        btn.type = "button";
                        btn.innerHTML = "✕";
                        btn.classList = "absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-700";
                        btn.onclick = function() {
                            wrapper.remove();
                            // Jika semua preview dihapus, kosongkan input
                            if (previewContainer.children.length === 0) {
                                inputElement.value = "";
                            }
                        };

                        wrapper.appendChild(img);
                        wrapper.appendChild(btn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

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