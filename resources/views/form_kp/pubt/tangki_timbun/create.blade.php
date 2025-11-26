<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.tangki_timbun.store', $jobOrderTool->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Simpan data?')">
                @csrf
                
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
                            <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border shadow-md border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  @error('tanggal_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tanggal_pemeriksaan') }}"> 
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
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->jobOrder->nama_perusahaan }}">
                </div>
                
                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->kapasitas }}">
                </div>
                
                {{-- Model/Tipe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->model }}">
                </div>
                
                {{-- No.Seri --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $jobOrderTool->no_seri }}">
                </div>

                {{-- Pabrik Pembuat --}}
                <div>
                    <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pabrik_pembuat') }}">
                    @error('pabrik_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Tipe Tangki --}}
                <div>
                    <input type="text" name="tipe_tangki" placeholder="Tipe Tangki" id="tipe_tangki" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tipe_tangki') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tipe_tangki') }}">
                    @error('tipe_tangki')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Tempat --}}
                <div>
                    <input type="text" name="tempat" placeholder="Tempat" id="tempat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tempat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tempat') }}">
                    @error('tempat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>
                
                {{-- Tahun Pembuat --}}
                <div>
                    <input type="text" name="tahun_pembuat" placeholder="Tahun Pembuat" id="tahun_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tahun_pembuat') }}">
                    @error('tahun_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Tekanan --}}
                <div>
                    <input type="text" name="tekanan" placeholder="Tekanan" id="tekanan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tekanan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tekanan') }}">
                    @error('tekanan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Suhu --}}
                <div>
                    <input type="text" name="suhu" placeholder="Suhu" id="suhu" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('suhu') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('suhu') }}">
                    @error('suhu')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Media yang Diisikan --}}
                <div>
                    <input type="text" name="media_yang_diisikan" placeholder="Media yang diisikan" id="media_yang_diisikan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('media_yang_diisikan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('media_yang_diisikan') }}">
                    @error('media_yang_diisikan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Lokasi Tangki --}}
                <div>
                    <input type="text" name="lokasi_tangki" placeholder="Lokasi Tangki" id="lokasi_tangki" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lokasi_tangki') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('lokasi_tangki') }}">
                    @error('lokasi_tangki')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- foto_visual --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Visual</h2>
                    <label for="foto_visual" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_visual-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_visual[]" id="foto_visual" accept="image/*" multiple onchange="previewImage(this, 'foto_visual-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_visual') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_visual')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
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
                            <tr class="relative">
                                <td class="px-3 py-2 border font-medium w-[50%]">
                                    <div class="flex items-center justify-between gap-2">
                                        {{ $data['label'] }}
                                        {{-- <button type="button"
                                            onclick="toggleTooltip('{{ $name }}')"
                                            class="font-bold text-blue-600 hover:text-blue-800">
                                            ?
                                        </button>
                                        <div id="tooltip-{{ $name }}"
                                            class="absolute z-10 hidden px-2 py-1 mb-2 text-xs text-white transform -translate-x-1/2 bg-gray-800 rounded shadow-lg bottom-full left-1/2">
                                            {{ $data['desc'] }}
                                        </div> --}}
                                    </div>
                                </td>

                                {{-- Radio Ya --}}
                                <td class="px-3 py-2 text-center border">
                                    <input type="radio" name="{{ $name }}" value="Ya"
                                        {{ old($name) == 'Ya' ? 'checked' : '' }}
                                        class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                </td>

                                {{-- Radio Tidak --}}
                                <td class="px-3 py-2 text-center border">
                                    <input type="radio" name="{{ $name }}" value="Tidak"
                                        {{ old($name) == 'Tidak' ? 'checked' : '' }}
                                        class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-3 py-2 border">
                                    <input type="text" name="{{ $name }}_keterangan"
                                        placeholder="Keterangan"
                                        value="{{ old($name . '_keterangan') }}"
                                        class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- foto_pengukuran --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran/Pengujian</h2>
                    <label for="foto_pengukuran" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_pengukuran-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_pengukuran[]" id="foto_pengukuran" accept="image/*" multiple onchange="previewImage(this, 'foto_pengukuran-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_pengukuran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_pengukuran')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Grounding 1 (Hasil) --}}
                <div>
                    <input type="text" name="grounding1_hasil" placeholder="Grounding 1 (Hasil)" id="grounding1_hasil" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding1_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('grounding1_hasil') }}">
                    @error('grounding1_hasil')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Grounding 2 (Hasil) --}}
                <div>
                    <input type="text" name="grounding2_hasil" placeholder="Grounding 1 (Hasil)" id="grounding2_hasil" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grounding2_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('grounding2_hasil') }}">
                    @error('grounding2_hasil')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- foto_komponen --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran Ketebalan</h2>
                    <label for="foto_komponen" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_komponen-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_komponen[]" id="foto_komponen" accept="image/*" multiple onchange="previewImage(this, 'foto_komponen-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_komponen') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_komponen')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
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
                        <label for="shell1" class="block text-sm text-gray-700">Shell 1</label>
                    </div>
                    <div>
                        <input type="text" name="shell1" placeholder="" id="shell1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell1') }}">
                        @error('shell1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="shell2" class="block text-sm text-gray-700">Shell 2</label>
                    </div>
                    <div>
                        <input type="text" name="shell2" placeholder="" id="shell2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell2') }}">
                        @error('shell2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label for="shell3" class="block text-sm text-gray-700">Shell 1</label>
                    </div>
                    <div>
                        <input type="text" name="shell3" placeholder="" id="shell3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell3') }}">
                        @error('shell3')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label for="shell4" class="block text-sm text-gray-700">Shell 4</label>
                    </div>
                    <div>
                        <input type="text" name="shell4" placeholder="" id="shell4" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell4') }}">
                        @error('shell4')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <label for="shell5" class="block text-sm text-gray-700">Shell 5</label>
                    </div>
                    <div>
                        <input type="text" name="shell5" placeholder="" id="shell5" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell5') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell5') }}">
                        @error('shell5')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 7 --}}
                    <div>
                        <label for="shell6" class="block text-sm text-gray-700">Shell 6</label>
                    </div>
                    <div>
                        <input type="text" name="shell6" placeholder="" id="shell6" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('shell6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('shell6') }}">
                        @error('shell6')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 8 --}}
                    <div>
                        <label for="tebal_pelat_atap1" class="block text-sm text-gray-700">Tebal Pelat Atap/Head 1</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_pelat_atap1" placeholder="" id="tebal_pelat_atap1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pelat_atap1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pelat_atap1') }}">
                        @error('tebal_pelat_atap1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 9 --}}
                    <div>
                        <label for="tebal_pelat_atap2" class="block text-sm text-gray-700">Tebal Pelat Atap/Head 2</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_pelat_atap2" placeholder="" id="tebal_pelat_atap2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pelat_atap2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pelat_atap2') }}">
                        @error('tebal_pelat_atap2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 10 --}}
                    <div>
                        <label for="tebal_pelat_bottom1" class="block text-sm text-gray-700">Tebal Pelat Bottom 1</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_pelat_bottom1" placeholder="" id="tebal_pelat_bottom1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pelat_bottom1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pelat_bottom1') }}">
                        @error('tebal_pelat_bottom1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 11 --}}
                    <div>
                        <label for="tebal_pelat_bottom2" class="block text-sm text-gray-700">Tebal Pelat Bottom 2</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_pelat_bottom2" placeholder="" id="tebal_pelat_bottom2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pelat_bottom2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pelat_bottom2') }}">
                        @error('tebal_pelat_bottom2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 12 --}}
                    <div>
                        <label for="tebal_pipa_channel" class="block text-sm text-gray-700">Tebal Pipa-pipa/Channel</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_pipa_channel" placeholder="" id="tebal_pipa_channel" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_pipa_channel') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_pipa_channel') }}">
                        @error('tebal_pipa_channel')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 13 --}}
                    <div>
                        <label for="tebal_instalasi_pipa" class="block text-sm text-gray-700">Tebal Insatalasi Pipa</label>
                    </div>
                    <div>
                        <input type="text" name="tebal_instalasi_pipa" placeholder="" id="tebal_instalasi_pipa" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tebal_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tebal_instalasi_pipa') }}">
                        @error('tebal_instalasi_pipa')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- foto_tangki --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pengukuran Dimensi</h2>
                    <label for="foto_tangki" class="block mb-1 text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <div id="foto_tangki-preview" class="flex flex-wrap gap-2"></div>
                    <input type="file" name="foto_tangki[]" id="foto_tangki" accept="image/*" multiple onchange="previewImage(this, 'foto_tangki-preview')" class="block w-full lg:w-[50%] px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('foto_tangki') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    
                    @error('foto_tangki')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Item --}}
                <div class="grid items-center grid-cols-2 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="diameter_tangki" class="block text-sm text-gray-700">Diameter Tangki (OD)</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="diameter_tangki" placeholder="" id="diameter_tangki" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('diameter_tangki') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('diameter_tangki') }}">
                        @error('diameter_tangki')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="tinggi_tangki" class="block text-sm text-gray-700">Tinggi Tangki Keseluruhan</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_tangki" placeholder="" id="tinggi_tangki" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_tangki') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_tangki') }}">
                        @error('tinggi_tangki')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 4 --}}
                    <div>
                        <label for="secondary_containtment" class="block text-sm text-gray-700">Secondary Containment (P x L x T)</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="secondary_containtment" placeholder="" id="secondary_containtment" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('secondary_containtment') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('secondary_containtment') }}">
                        @error('secondary_containtment')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 5 --}}
                    <div>
                        <label for="tinggi_pagar_atap" class="block text-sm text-gray-700">Tinggi Pagar Atap (Roof)</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_pagar_atap" placeholder="" id="tinggi_pagar_atap" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_pagar_atap') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_pagar_atap') }}">
                        @error('tinggi_pagar_atap')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 6 --}}
                    <div>
                        <label for="tinggi_panjang_pipa" class="block text-sm text-gray-700">Pipa-pipa/Channel (OD)</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_pipa" placeholder="" id="tinggi_panjang_pipa" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_pipa') }}">
                        @error('tinggi_panjang_pipa')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 7 --}}
                    <div>
                        <label for="tinggi_panjang_instalasi_pipa" class="block text-sm text-gray-700">Instalasi Pipa (OD)</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_instalasi_pipa" placeholder="" id="tinggi_panjang_instalasi_pipa" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_instalasi_pipa') }}">
                        @error('tinggi_panjang_instalasi_pipa')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 8 --}}
                    <div>
                        <label for="tinggi_panjang_shell1" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell1" placeholder="" id="tinggi_panjang_shell1" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell1') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell1') }}">
                        @error('tinggi_panjang_shell1')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 9 --}}
                    <div>
                        <label for="tinggi_panjang_shell2" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell2" placeholder="" id="tinggi_panjang_shell2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell2') }}">
                        @error('tinggi_panjang_shell2')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 10 --}}
                    <div>
                        <label for="tinggi_panjang_shell3" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell3" placeholder="" id="tinggi_panjang_shell3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell3') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell3') }}">
                        @error('tinggi_panjang_shell3')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 11 --}}
                    <div>
                        <label for="tinggi_panjang_shell4`" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell4" placeholder="" id="tinggi_panjang_shell4" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell4') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell4') }}">
                        @error('tinggi_panjang_shell4')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 12 --}}
                    <div>
                        <label for="tinggi_panjang_shell5" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell5" placeholder="" id="tinggi_panjang_shell5" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell5') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell5') }}">
                        @error('tinggi_panjang_shell5')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 13 --}}
                    <div>
                        <label for="tinggi_panjang_shell6" class="block text-sm text-gray-700">Tinggi/Panjang Shell</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="tinggi_panjang_shell6" placeholder="" id="tinggi_panjang_shell6" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tinggi_panjang_shell6') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('tinggi_panjang_shell6') }}">
                        @error('tinggi_panjang_shell6')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan --}}
                <div>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan') }}</textarea>
                    @error('catatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-md hover:scale-[103%]">
                    Simpan
                </button>
            </form>
        </div>
        <script>
            // Add preview image
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



