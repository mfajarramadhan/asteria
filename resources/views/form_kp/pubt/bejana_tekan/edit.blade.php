<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.bejana_tekan.update', $formKpBejanaTekan->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
                @csrf
                @method('PUT')
                
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
                            <input id="datepicker-autohide" name="tanggal_pemeriksaan" placeholder="Tanggal Pemeriksaan" 
                                value="{{ old('tanggal_pemeriksaan', optional($formKpBejanaTekan->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpBejanaTekan->jobOrderTool->jobOrder->nama_perusahaan }}">
                </div>
                
                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpBejanaTekan->jobOrderTool->kapasitas }}">
                </div>
                
                {{-- Model/Tipe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpBejanaTekan->jobOrderTool->model }}">
                </div>
                
                {{-- No.Seri --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpBejanaTekan->jobOrderTool->no_seri }}">
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                    <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpBejanaTekan->pabrik_pembuat) }}">
                    @error('pabrik_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                <h2 class="block text-sm font-bold text-gray-700">Dimensi</h2>
                
                {{-- Shell/Badan --}}
                {{-- Foto foto_shell --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Shell/Badan</h2>
                    <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto Shell/Badan</label>

                    {{-- foto lama --}}
                    @if($formKpBejanaTekan->foto_shell)
                        @php $oldFiles = json_decode($formKpBejanaTekan->foto_shell, true); @endphp
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

                {{-- Ketidak bulatan --}}
                <div>
                    <label for="ketidakbulatan" class="block text-sm font-medium text-gray-700">Ketidak bulatan</label>
                    <input type="text" name="ketidakbulatan" placeholder="Ketidak bulatan" id="ketidakbulatan" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ketidakbulatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketidakbulatan', $formKpBejanaTekan->ketidakbulatan) }}">
                    @error('ketidakbulatan')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Ketebalan shell --}}
                <div>
                    <label for="ketebalan_shell" class="block text-sm font-medium text-gray-700">Ketebalan shell</label>
                    <input type="number" step="any" name="ketebalan_shell" placeholder="Ketebalan shell" id="ketebalan_shell" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_shell', $formKpBejanaTekan->ketebalan_shell) }}">
                    @error('ketebalan_shell')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Diameter shell --}}
                <div>
                    <label for="diameter_shell" class="block text-sm font-medium text-gray-700">Diameter shell (keliling)</label>
                    <input type="number" step="any" name="diameter_shell" placeholder="Diameter (keliling)" id="diameter_shell" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_shell', $formKpBejanaTekan->diameter_shell) }}">
                    @error('diameter_shell')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang shell --}}
                <div>
                    <label for="panjang_shell" class="block text-sm font-medium text-gray-700">Panjang shell</label>
                    <input type="number" step="any" name="panjang_shell" placeholder="Panjang shell" id="panjang_shell" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_shell') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_shell', $formKpBejanaTekan->panjang_shell) }}">
                    @error('panjang_shell')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_head --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Head/Tutup Ujung</h2>
                    <label for="foto_head" class="block mb-1 text-sm font-medium text-gray-700">Foto Head/Tutup Ujung</label>

                    {{-- foto lama --}}
                    @if($formKpBejanaTekan->foto_head)
                        @php $oldFiles = json_decode($formKpBejanaTekan->foto_head, true); @endphp
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
                    <div id="foto_head-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_head[]" 
                        id="foto_head" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_head-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_head') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_head')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Diameter head --}}
                <div>
                    <label for="diameter_head" class="block text-sm font-medium text-gray-700">Diameter head</label>
                    <input type="number" step="any" name="diameter_head" placeholder="Ketebalan head" id="diameter_head" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_head') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_head', $formKpBejanaTekan->diameter_head) }}">
                    @error('diameter_head')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Ketebalan head --}}
                <div>
                    <label for="ketebalan_head" class="block text-sm font-medium text-gray-700">Ketebalan head</label>
                    <input type="number" step="any" name="ketebalan_head" placeholder="Ketebalan head" id="ketebalan_head" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_head') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_head', $formKpBejanaTekan->ketebalan_head) }}">
                    @error('ketebalan_head')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

               {{-- Foto foto_pipa --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pipa-pipa/Channel</h2>
                    <label for="foto_pipa" class="block mb-1 text-sm font-medium text-gray-700">Foto Pipa-pipa/Channel</label>

                    {{-- foto lama --}}
                    @if($formKpBejanaTekan->foto_pipa)
                        @php $oldFiles = json_decode($formKpBejanaTekan->foto_pipa, true); @endphp
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
                    <div id="foto_pipa-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_pipa[]" 
                        id="foto_pipa" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_pipa-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_pipa')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>     

                {{-- Diameter pipa --}}
                <div>
                    <label for="diameter_pipa" class="block text-sm font-medium text-gray-700">Diameter pipa (keliling)</label>
                    <input type="number" step="any" name="diameter_pipa" placeholder="Diameter pipa (keliling)" id="diameter_pipa" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_pipa', $formKpBejanaTekan->diameter_pipa) }}">
                    @error('diameter_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Ketebalan pipa --}}
                <div>
                    <label for="ketebalan_pipa" class="block text-sm font-medium text-gray-700">Ketebalan pipa</label>
                    <input type="number" step="any" name="ketebalan_pipa" placeholder="Ketebalan pipa" id="ketebalan_pipa" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_pipa', $formKpBejanaTekan->ketebalan_pipa) }}">
                    @error('ketebalan_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang pipa --}}
                <div>
                    <label for="panjang_pipa" class="block text-sm font-medium text-gray-700">Panjang pipa</label>
                    <input type="number" step="any" name="panjang_pipa" placeholder="Panjang pipa" id="panjang_pipa" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_pipa', $formKpBejanaTekan->panjang_pipa) }}">
                    @error('panjang_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_instalasi --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Instalasi Pipa</h2>
                    <label for="foto_instalasi" class="block mb-1 text-sm font-medium text-gray-700">Foto Instalasi Pipa</label>

                    {{-- foto lama --}}
                    @if($formKpBejanaTekan->foto_instalasi)
                        @php $oldFiles = json_decode($formKpBejanaTekan->foto_instalasi, true); @endphp
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
                    <div id="foto_instalasi-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_instalasi[]" 
                        id="foto_instalasi" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_instalasi-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_instalasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_instalasi')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Diameter instalasi --}}
                <div>
                    <label for="diameter_instalasi" class="block text-sm font-medium text-gray-700">Diameter instalasi (keliling)</label>
                    <input type="number" step="any" name="diameter_instalasi" placeholder="Diameter (keliling)" id="diameter_instalasi" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_instalasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_instalasi', $formKpBejanaTekan->diameter_instalasi) }}">
                    @error('diameter_instalasi')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Ketebalan instalasi --}}
                <div>
                    <label for="ketebalan_instalasi" class="block text-sm font-medium text-gray-700">Ketebalan instalasi</label>
                    <input type="number" step="any" name="ketebalan_instalasi" placeholder="Ketebalan" id="ketebalan_instalasi" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_instalasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_instalasi', $formKpBejanaTekan->ketebalan_instalasi) }}">
                    @error('ketebalan_instalasi')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang instalasi --}}
                <div>
                    <label for="panjang_instalasi" class="block text-sm font-medium text-gray-700">Panjang instalasi</label>
                    <input type="number" step="any" name="panjang_instalasi" placeholder="Panjang" id="panjang_instalasi" 
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_instalasi') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_instalasi', $formKpBejanaTekan->panjang_instalasi) }}">
                    @error('panjang_instalasi')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Safety value cal --}}
                <div class="flex justify-center">
                    <div class="flex items-center w-full md:w-5/6">
                        <label for="safety_valv_cal" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                            • Safety Valve & Pressure Gauge apakah sudah dikalibrasi? 
                        </label>
                        <div class="w-[30%] md:w-[25%] flex items-center justify-between">
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="safety_valv_cal" value="1" 
                                    {{ old('safety_valv_cal', $formKpBejanaTekan->safety_valv_cal) == 1 ? 'checked' : '' }}
                                    class="text-black border-gray-300 focus:ring-blue-500">
                                <span class="text-sm">Ya</span>
                            </label>
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="safety_valv_cal" value="0" 
                                    {{ old('safety_valv_cal', $formKpBejanaTekan->safety_valv_cal) == 0 ? 'checked' : '' }}
                                    class="text-black border-gray-300 focus:ring-blue-500">
                                <span class="text-sm">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>
                @error('safety_valv_cal')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror

                {{-- Tekanan kerja --}}
                <div class="flex justify-center">
                    <div class="flex items-center w-full md:w-5/6">
                        <label for="tekanan_kerja" class="w-[70%] md:w-[75%] text-sm text-gray-700">
                            • Tekanan kerja
                        </label>
                        <div class="w-[30%] md:w-[25%]">
                            <input type="number" step="any" name="tekanan_kerja" id="tekanan_kerja" 
                                class="block w-full border px-3 py-1 border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('tekanan_kerja') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('tekanan_kerja', $formKpBejanaTekan->tekanan_kerja) }}">
                            @error('tekanan_kerja')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror 
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
                                class="block w-full border px-3 py-1 border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('set_safety_valv') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('set_safety_valv', $formKpBejanaTekan->set_safety_valv) }}">
                            @error('set_safety_valv')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror 
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
                                class="block w-full border px-3 py-1 border-gray-300 rounded-md shadow-md 
                                focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                @error('media_yang_diisikan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                                value="{{ old('media_yang_diisikan', $formKpBejanaTekan->media_yang_diisikan) }}">
                            @error('media_yang_diisikan')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>
                    </div>
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpBejanaTekan->catatan) }}</textarea>
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
        <script>\
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
        </script>
</x-layout>
