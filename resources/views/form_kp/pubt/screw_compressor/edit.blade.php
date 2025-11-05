<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('form_kp.pubt.screw_compressor.update', $formKpScrewCompressor->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data" onsubmit="return confirm('Update data?')">
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
                                value="{{ old('tanggal_pemeriksaan', optional($formKpScrewCompressor->tanggal_pemeriksaan)->format('d-m-Y')) }}"
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
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpScrewCompressor->jobOrderTool->jobOrder->nama_perusahaan }}">
                </div>
                
                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpScrewCompressor->jobOrderTool->kapasitas }}">
                </div>
                
                {{-- Model/Tipe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model/Tipe</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpScrewCompressor->jobOrderTool->model }}">
                </div>
                
                {{-- No.Seri --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri/Unit</label>
                    <input type="text" disabled class="block w-full px-3 py-2 mt-1 bg-gray-200 border border-gray-400 rounded-md shadow-md cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $formKpScrewCompressor->jobOrderTool->no_seri }}">
                </div>
                
                {{-- Pabrik Pembuat --}}
                <div>
                    <label for="pabrik_pembuat" class="block text-sm font-medium text-gray-700">Pabrik Pembuat</label>
                    <input type="text" name="pabrik_pembuat" placeholder="Pabrik Pembuat" id="pabrik_pembuat" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pabrik_pembuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $formKpScrewCompressor->pabrik_pembuat) }}">
                    @error('pabrik_pembuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                <h2 class="block text-sm font-bold text-gray-700">Dimensi</h2>
                
                {{-- Shell/Badan --}}
                {{-- Foto foto_shell_separator --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Shell/Badan Saparator Tank</h2>
                    <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_shell_separator)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_shell_separator, true); @endphp
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
                    <div id="foto_shell_separator-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_shell_separator[]" 
                        id="foto_shell_separator" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_shell_separator-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_shell_separator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_shell_separator')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Ketebalan --}}
                <div>
                    <label for="ketebalan_shell_separator" class="block text-sm font-medium text-gray-700">Ketebalan Shell Separator</label>
                    <input type="number" step="any" name="ketebalan_shell_separator" placeholder="Ketebalan Shell Separator" id="ketebalan_shell_separator" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_shell_separator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_shell_separator', $formKpScrewCompressor->ketebalan_shell_separator) }}">
                    @error('ketebalan_shell_separator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Diameter --}}
                <div>
                    <label for="diameter_shell_separator" class="block text-sm font-medium text-gray-700">Diameter Shell Separator</label>
                    <input type="number" step="any" name="diameter_shell_separator" placeholder="Diameter (Keliling) Shell Separator" id="diameter_shell_separator" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_shell_separator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_shell_separator', $formKpScrewCompressor->diameter_shell_separator) }}">
                    @error('diameter_shell_separator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang --}}
                <div>
                    <label for="panjang_shell_separator" class="block text-sm font-medium text-gray-700">Panjang Shell Separator</label>
                    <input type="number" step="any" name="panjang_shell_separator" placeholder="Panjang Shell Separator" id="panjang_shell_separator" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_shell_separator') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_shell_separator', $formKpScrewCompressor->panjang_shell_separator) }}">
                    @error('panjang_shell_separator')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_instalasi_pipa --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Instalasi Pipa</h2>
                    <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_instalasi_pipa)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_instalasi_pipa, true); @endphp
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
                    <div id="foto_instalasi_pipa-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_instalasi_pipa[]" 
                        id="foto_instalasi_pipa" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_instalasi_pipa-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_instalasi_pipa')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Diameter --}}
                <div>
                    <label for="diameter_instalasi_pipa" class="block text-sm font-medium text-gray-700">Diameter Instalasi Pipa</label>
                    <input type="number" step="any" name="diameter_instalasi_pipa" placeholder="Diameter Instalasi Pipa" id="diameter_instalasi_pipa" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('diameter_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('diameter_instalasi_pipa', $formKpScrewCompressor->diameter_instalasi_pipa) }}">
                    @error('diameter_instalasi_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Ketebalan --}}
                <div>
                    <label for="ketebalan_instalasi_pipa" class="block text-sm font-medium text-gray-700">Ketebalan Instalasi Pipa</label>
                    <input type="number" step="any" name="ketebalan_instalasi_pipa" placeholder="Ketebalan Instalasi Pipa" id="ketebalan_instalasi_pipa" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('ketebalan_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('ketebalan_instalasi_pipa', $formKpScrewCompressor->ketebalan_instalasi_pipa) }}">
                    @error('ketebalan_instalasi_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Panjang --}}
                <div>
                    <label for="panjang_instalasi_pipa" class="block text-sm font-medium text-gray-700">Panjang Instalasi Pipa</label>
                    <input type="number" step="any" name="panjang_instalasi_pipa" placeholder="Panjang Instalasi Pipa" id="panjang_instalasi_pipa" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_instalasi_pipa') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_instalasi_pipa', $formKpScrewCompressor->panjang_instalasi_pipa) }}">
                    @error('panjang_instalasi_pipa')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_casing_screw --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Casing/Cover Screw Compressor</h2>
                    <label for="foto_casing_screw" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_casing_screw)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_casing_screw, true); @endphp
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
                    <div id="foto_casing_screw-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_casing_screw[]" 
                        id="foto_casing_screw" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_casing_screw-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_casing_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_casing_screw')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Panjang --}}
                <div>
                    <label for="panjang_casing_screw" class="block text-sm font-medium text-gray-700">Panjang Casing Screw</label>
                    <input type="number" step="any" name="panjang_casing_screw" placeholder="Panjang Casing Screw" id="panjang_casing_screw" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_casing_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_casing_screw', $formKpScrewCompressor->panjang_casing_screw) }}">
                    @error('panjang_casing_screw')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Lebar --}}
                <div>
                    <label for="lebar_casing_screw" class="block text-sm font-medium text-gray-700">Lebar Casing Screw</label>
                    <input type="number" step="any" name="lebar_casing_screw" placeholder="Lebar Casing Screw" id="lebar_casing_screw" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('lebar_casing_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('lebar_casing_screw', $formKpScrewCompressor->lebar_casing_screw) }}">
                    @error('lebar_casing_screw')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Tinggi --}}
                <div>
                    <label for="tinggi_casing_screw" class="block text-sm font-medium text-gray-700">Tinggi Casing Screw</label>
                    <input type="number" step="any" name="tinggi_casing_screw" placeholder="Tinggi Casing Screw" id="tinggi_casing_screw" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('tinggi_casing_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('tinggi_casing_screw', $formKpScrewCompressor->tinggi_casing_screw) }}">
                    @error('tinggi_casing_screw')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_pondasi_screw --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Pondasi Screw Compressor</h2>
                    <label for="foto_pondasi_screw" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_pondasi_screw)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_pondasi_screw, true); @endphp
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
                    <div id="foto_pondasi_screw-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_pondasi_screw[]" 
                        id="foto_pondasi_screw" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_pondasi_screw-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pondasi_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_pondasi_screw')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Panjang --}}
                <div>
                    <label for="panjang_pondasi_screw" class="block text-sm font-medium text-gray-700">Panjang Pondasi Screw</label>
                    <input type="number" step="any" name="panjang_pondasi_screw" placeholder="Panjang Pondasi Screw" id="panjang_pondasi_screw" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('panjang_pondasi_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('panjang_pondasi_screw', $formKpScrewCompressor->panjang_pondasi_screw) }}">
                    @error('panjang_pondasi_screw')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Lebar --}}
                <div>
                    <label for="lebar_pondasi_screw" class="block text-sm font-medium text-gray-700">Lebar Pondasi Screw</label>
                    <input type="number" step="any" name="lebar_pondasi_screw" placeholder="Lebar Pondasi Screw" id="lebar_pondasi_screw" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('lebar_pondasi_screw') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                        value="{{ old('lebar_pondasi_screw', $formKpScrewCompressor->lebar_pondasi_screw) }}">
                    @error('lebar_pondasi_screw')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

                {{-- Foto foto_safety_device --}}
                <div>
                    <h2 class="block mb-1 text-sm font-bold text-gray-700">Safety Device</h2>
                    <label for="foto_safety_device" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_safety_device)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_safety_device, true); @endphp
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
                    <div id="foto_safety_device-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_safety_device[]" 
                        id="foto_safety_device" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_safety_device-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_safety_device') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_safety_device')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Safety Valve Separator Tank --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Item</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Membuka</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Menutup</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="safety_valve_separator_membuka" class="block text-sm text-gray-700">Safety Valve Separator Tank</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="safety_valve_separator_membuka" placeholder="" id="safety_valve_separator_membuka" 
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('safety_valve_separator_membuka') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                            value="{{ old('safety_valve_separator_membuka', $formKpScrewCompressor->safety_valve_separator_membuka) }}">
                        @error('safety_valve_separator_membuka')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="safety_valve_separator_menutup" placeholder="" id="safety_valve_separator_menutup" 
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('safety_valve_separator_menutup') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" 
                            value="{{ old('safety_valve_separator_menutup', $formKpScrewCompressor->safety_valve_separator_menutup) }}">
                        @error('safety_valve_separator_menutup')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Safety Valve --}}
                <div>
                    <label for="catatan_safety_valve" class="block text-sm font-medium text-gray-700">Catatan Safety Valve Separator Tank</label>
                    <textarea name="catatan_safety_valve" id="catatan_safety_valve" placeholder="Catatan Safety Valve Separator Tank" rows="2" 
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('catatan_safety_valve') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_safety_valve', $formKpScrewCompressor->catatan_safety_valve) }}</textarea>
                    @error('catatan_safety_valve')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Foto foto_pressure_switch --}}
                <div>
                    <label for="foto_shell" class="block mb-1 text-sm font-medium text-gray-700">Foto</label>

                    {{-- foto lama --}}
                    @if($formKpScrewCompressor->foto_pressure_switch)
                        @php $oldFiles = json_decode($formKpScrewCompressor->foto_pressure_switch, true); @endphp
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
                    <div id="foto_pressure_switch-preview" class="flex flex-wrap gap-2 mb-2"></div>

                    <input 
                        type="file" 
                        name="foto_pressure_switch[]" 
                        id="foto_pressure_switch" 
                        accept="image/*" 
                        multiple
                        onchange="previewImageDynamic(this, 'foto_pressure_switch-preview')"
                        class="block w-full px-3 py-2 mt-1 lg:w-[50%] border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('foto_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">

                    @error('foto_pressure_switch')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                    @enderror   
                </div>

                {{-- Pressure Switch --}}
                <div class="grid items-center grid-cols-3 gap-4">
                    {{-- Baris 1 --}}
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Deskripsi</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Tekanan Setting</label>
                    </div>
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700">Hasil</label>
                    </div>

                    {{-- Baris 2 --}}
                    <div>
                        <label for="pressure_switch_on_set" class="block text-sm text-gray-700">Pressure Switch On</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_on_set" placeholder="" id="pressure_switch_on_set"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_on_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_on_set', $formKpScrewCompressor->pressure_switch_on_set) }}">
                        @error('pressure_switch_on_set')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_on_hasil" placeholder="" id="pressure_switch_on_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_on_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_on_hasil', $formKpScrewCompressor->pressure_switch_on_hasil) }}">
                        @error('pressure_switch_on_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Baris 3 --}}
                    <div>
                        <label for="pressure_switch_off_set" class="block text-sm text-gray-700">Pressure Switch Off</label>
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_off_set" placeholder="" id="pressure_switch_off_set"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_off_set') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_off_set', $formKpScrewCompressor->pressure_switch_off_set) }}">
                        @error('pressure_switch_off_set')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <input type="number" step="any" name="pressure_switch_off_hasil" placeholder="" id="pressure_switch_off_hasil"
                            class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('pressure_switch_off_hasil') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror"
                            value="{{ old('pressure_switch_off_hasil', $formKpScrewCompressor->pressure_switch_off_hasil) }}">
                        @error('pressure_switch_off_hasil')
                        <div class="text-xs text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Catatan Pressure Switch --}}
                <div>
                    <label for="catatan_pressure_switch" class="block text-sm font-medium text-gray-700">Catatan Pressure Switch</label>
                    <textarea name="catatan_pressure_switch" id="catatan_pressure_switch" placeholder="Catatan Pressure Switch" rows="2"
                        class="block w-full shadow-md px-3 py-2 mt-1 border border-gray-300 rounded-md 
                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                        @error('catatan_pressure_switch') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan_pressure_switch', $formKpScrewCompressor->catatan_pressure_switch) }}</textarea>
                    @error('catatan_pressure_switch')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Catatan" rows="4"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                            @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $formKpScrewCompressor->catatan) }}</textarea>
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
        </script>
</x-layout>
