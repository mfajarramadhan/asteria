<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('job_orders.update', $jobOrder->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- General Order --}}
            <h2 class="block text-sm font-bold text-gray-700">General Order</h2>

            {{-- Nama Perusahaan --}}
            <div>
                <input type="text" required name="nama_perusahaan" placeholder="Nama Perusahaan" id="nama_perusahaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_perusahaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nama_perusahaan', $jobOrder->nama_perusahaan) }}">
                @error('nama_perusahaan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat Perusahaan --}}
            <div>
                <input type="text" required name="alamat_perusahaan" placeholder="Alamat Perusahaan" id="alamat_perusahaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('alamat_perusahaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('alamat_perusahaan', $jobOrder->alamat_perusahaan) }}">
                @error('alamat_perusahaan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- PIC Order --}}
            <div>
                <input type="text" required name="pic_order" placeholder="PIC Order" id="pic_order" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pic_order') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pic_order', $jobOrder->pic_order) }}">
                @error('pic_order')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <input type="email" name="email" placeholder="Email" id="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('email', $jobOrder->email) }}">
                @error('email')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contact Person --}}
            <div>
                <input type="tel" name="contact_person" placeholder="Contact Person" id="contact_person" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('contact_person') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('contact_person', $jobOrder->contact_person) }}">
                @error('contact_person')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- No Penawaran --}}
            <div>
                <input type="text" name="no_penawaran" placeholder="No. Penawaran" id="no_penawaran" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('no_penawaran') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('no_penawaran', $jobOrder->no_penawaran) }}">
                @error('no_penawaran')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- No Purcash Order --}}
            <div>
                <input type="text" name="no_purcash_order" placeholder="No. Purcash Order" id="no_purcash_order" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('no_purcash_order') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('no_purcash_order', $jobOrder->no_purcash_order) }}">
                @error('no_purcash_order')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                @for ($i = 1; $i <= 5; $i++)
                <div class="w-full md:w-[48%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-autohide-{{ $i }}" name="tanggal_pemeriksaan{{ $i }}" placeholder="({{ $i }})" value="{{ old('tanggal_pemeriksaan'.$i, optional($jobOrder->{'tanggal_pemeriksaan'.$i})->format('d-m-Y')) }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 @error('tanggal_pemeriksaan'.$i) valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    </div>
                    @error('tanggal_pemeriksaan'.$i)
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                @endfor
            </div>

            {{-- Jumlah Hari Pemeriksaan --}}
            <div>
                <select required name="jumlah_hari_pemeriksaan" id="jumlah_hari_pemeriksaan" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_hari_pemeriksaan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    <option value="" class="text-center">--- Jumlah Hari Pemeriksaan ---</option>
                    @foreach([1,2,3,4,5] as $hari)
                        <option value="{{ $hari }}" {{ old('jumlah_hari_pemeriksaan', $jobOrder->jumlah_hari_pemeriksaan) == $hari ? 'selected' : '' }}>
                            {{ $hari.' Hari' }}
                        </option>
                    @endforeach
                </select>
                @error('jumlah_hari_pemeriksaan')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal JO Dibuat & Selesai --}}
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                {{-- Tanggal JO Dibuat --}}
                <div class="w-full md:w-[48%]">
                    <h2 class="block mb-4 text-sm font-bold text-gray-700">Tanggal JO Dibuat</h2>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-autohide-7" name="tanggal_dibuat" value="{{ old('tanggal_dibuat', optional($jobOrder->tanggal_dibuat)->format('d-m-Y')) }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text"  placeholder="Pilih Tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('tanggal_dibuat') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    </div>
                    @error('tanggal_dibuat')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- Tanggal Selesai Pemeriksaan --}}
                <div class="w-full md:w-[48%]">
                    <h2 class="block mb-4 text-sm font-bold text-gray-700">Tanggal Selesai Pemeriksaan</h2>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-autohide-6" name="tanggal_selesai" value="{{ old('tanggal_selesai', optional($jobOrder->tanggal_selesai)->format('d-m-Y')) }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text"  placeholder="Pilih Tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('tanggal_selesai') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                    </div>
                    @error('tanggal_selesai')
                    <div class="text-xs text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            {{-- Jam Bertemu --}}
            <div class="pb-2">
                <div class="flex justify-between gap-x-2 gap-y-4">
                    <div class="inline-block w-full md:w-[48%]">
                        <label for="jam_bertemu" class="block mb-4 text-sm font-medium text-gray-900">Jam Bertemu:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="time" name="jam_bertemu" value="{{ old('jam_bertemu', $jobOrder->jam_bertemu) }}" id="jam_bertemu" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>
                    <div class="inline-block w-full md:w-[48%]">
                        <label for="end-time" class="block mb-4 text-sm font-medium text-gray-900">Jam Selesai:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jobOrder->jam_selesai) }}" id="end-time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Jam Bertemu --}}

             {{-- PIC Ditemui --}}
            <div>
                <input type="text" name="pic_ditemui" placeholder="PIC Ditemui" id="pic_ditemui" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pic_ditemui') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('pic_ditemui', $jobOrder->pic_ditemui) }}">
                @error('pic_ditemui')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contact Person 2 --}}
            <div>
                <input type="text" name="contact_person2" placeholder="Contact Person" id="contact_person2" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('contact_person2') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('contact_person2', $jobOrder->contact_person2) }}">
                @error('contact_person2')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- ID JO --}}
            <div>
                <input type="text" name="nomor_jo" placeholder="ID JO" id="nomor_jo" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nomor_jo') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" value="{{ old('nomor_jo', $jobOrder->nomor_jo) }}">
                @error('nomor_jo')
                <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pilih Penanggung Jawab --}}
            <div>
                <label for="responsibles" class="block text-sm font-medium text-gray-700">Penanggung Jawab <span class="text-red-600">*</span></label>
                <select id="responsibles" name="responsibles[]" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('responsibles') border-red-600 focus:border-red-600 focus:ring-red-200 @enderror">
                    @foreach ($petugas as $user)
                        <option value="{{ $user->id }}" {{ in_array($user->id, old('responsibles', $jobOrder->responsibles->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
                @error('responsibles')
                <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pilih alat --}}
            <label for="responsibles" class="block text-sm font-medium text-gray-700">List Job Order <span class="text-red-600">*</span></label>
            <div class="px-4 pb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="table min-w-full divide-y divide-gray-200" id="tools-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alat</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Qty</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kapasitas</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Model/Tipe</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Seri/Unit</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tools-table-body" class="divide-y divide-gray-200">
                    {{-- Render row dari old input kalau validasi gagal --}}
                    @if(old('tools'))
                        @foreach (old('tools') as $i => $tool)
                            <tr>
                                <td class="w-full sm:w-[30%] min-w-[200px] px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <select name="tools[{{ $i }}][tool_id]" id="tool-select-{{ $i }}" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach($tools as $t)
                                            <option value="{{ $t->id }}" {{ old("tools.$i.tool_id") == $t->id ? 'selected' : '' }}>
                                                {{ $t->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="number" name="tools[{{ $i }}][qty]" class="bg-gray-100 rounded-md form-control" min="1" required value="{{ old("tools.$i.qty") }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <select name="tools[{{ $i }}][status]" class="form-control" required>
                                        <option value="pertama" {{ old("tools.$i.status") == 'pertama' ? 'selected' : '' }}>Pertama</option>
                                        <option value="resertifikasi" {{ old("tools.$i.status") == 'resertifikasi' ? 'selected' : '' }}>Resertifikasi</option>
                                    </select>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][kapasitas]" class="bg-gray-100 rounded-md form-control" value="{{ old("tools.$i.kapasitas") }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][model]" class="bg-gray-100 rounded-md form-control" value="{{ old("tools.$i.model") }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][no_seri]" class="bg-gray-100 rounded-md form-control" value="{{ old("tools.$i.no_seri") }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <button type="button" class="flex p-2 transition-all duration-500 rounded-full remove-row group item-center">
                                        <!-- SVG hapus -->
                                    </button>                                    
                                </td>
                            </tr>
                        @endforeach
                    @elseif($jobOrder->tools->count())
                        @foreach ($jobOrder->tools as $i => $tool)
                            <tr>
                                <td class="w-full sm:w-[30%] min-w-[200px] px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <select name="tools[{{ $i }}][tool_id]" id="tool-select-{{ $i }}" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach($tools as $t)
                                            <option value="{{ $t->id }}" {{ $tool->id == $t->id ? 'selected' : '' }}>
                                                {{ $t->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="number" name="tools[{{ $i }}][qty]" class="bg-gray-100 rounded-md form-control" min="1" required value="{{ $tool->pivot->qty }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <select name="tools[{{ $i }}][status]" class="form-control" required>
                                        <option value="pertama" {{ $tool->pivot->status == 'pertama' ? 'selected' : '' }}>Pertama</option>
                                        <option value="resertifikasi" {{ $tool->pivot->status == 'resertifikasi' ? 'selected' : '' }}>Resertifikasi</option>
                                    </select>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][kapasitas]" class="bg-gray-100 rounded-md form-control" value="{{ $tool->pivot->kapasitas }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][model]" class="bg-gray-100 rounded-md form-control" value="{{ $tool->pivot->model }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <input type="text" name="tools[{{ $i }}][no_seri]" class="bg-gray-100 rounded-md form-control" value="{{ $tool->pivot->no_seri }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                                    <button type="button" class="flex p-2 transition-all duration-500 rounded-full remove-row group item-center">
                                        <!-- SVG hapus -->
                                    </button>                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
                <button type="button" id="add-tool" class="px-3 py-1 font-semibold text-white transition-transform rounded-md bg-gradient-to-r from-blue-500 to-purple-500 transform-gpu hover:-translate-y-0.5 hover:shadow-lg">+ Tambah Alat</button>
            </div>
            {{-- End Pilih alat --}}

            {{-- Kelengkapan Alat --}}
            <div>
                <label for="kelengkapan" class="block text-sm font-medium text-gray-700">
                    Kelengkapan Alat
                </label>
                    <div class="px-3 py-2 mt-1 space-y-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    {{-- Manual Book --}}
                    <div class="flex items-center gap-3">
                        <label for="kelengkapan_manual_book" class="flex-1 cursor-pointer">
                            Manual Book (Spesifikasi Alat)
                        </label>
                        <input type="checkbox" id="kelengkapan_manual_book" name="kelengkapan_manual_book" value="1"
                            {{ old('kelengkapan_manual_book', $jobOrder->kelengkapan_manual_book  ?? false) ? 'checked' : '' }}
                            class="w-5 h-5">
                        <input type="number" placeholder="Qty..." name="qty_manual_book" value="{{ old('qty_manual_book', $jobOrder->qty_manual_book ?? '') }}"
                            class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1 @error('qty_manual_book') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                        @error('qty_manual_book')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    {{-- Layout --}}
                    <div class="flex items-center gap-3">
                        <label for="kelengkapan_layout" class="flex-1 cursor-pointer">
                            Layout/Diagram Instalasi
                        </label>
                        <input type="checkbox" id="kelengkapan_layout" name="kelengkapan_layout" value="1"
                            {{ old('kelengkapan_layout', $jobOrder->kelengkapan_layout  ?? false) ? 'checked' : '' }}
                            class="w-5 h-5">
                        <input type="number" placeholder="Qty..." name="qty_layout" value="{{ old('qty_layout', $jobOrder->qty_layout ?? '') }}"
                            class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1 @error('qty_layout') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                        @error('qty_layout')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    {{-- Maintenance Report --}}
                    <div class="flex items-center gap-3">
                        <label for="kelengkapan_maintenance_report" class="flex-1 cursor-pointer">
                            Checklist Maintenance Report
                        </label>
                        <input type="checkbox" id="kelengkapan_maintenance_report" name="kelengkapan_maintenance_report" value="1"
                            {{ old('kelengkapan_maintenance_report', $jobOrder->kelengkapan_maintenance_report  ?? false) ? 'checked' : '' }}
                            class="w-5 h-5">
                        <input type="number" placeholder="Qty..." name="qty_maintenance_report" value="{{ old('qty_maintenance_report', $jobOrder->qty_maintenance_report ?? '') }}"
                            class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1 @error('qty_maintenance_report') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                        @error('qty_maintenance_report')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    {{-- Surat Permohonan --}}
                    <div class="flex items-center gap-3">
                        <label for="kelengkapan_surat_permohonan" class="flex-1 cursor-pointer">
                            Surat Permohonan
                        </label>
                        <input type="checkbox" id="kelengkapan_surat_permohonan" name="kelengkapan_surat_permohonan" value="1"
                            {{ old('kelengkapan_surat_permohonan', $jobOrder->kelengkapan_surat_permohonan  ?? false) ? 'checked' : '' }}
                            class="w-5 h-5">
                        <input type="number" placeholder="Qty..." name="qty_surat_permohonan" value="{{ old('qty_surat_permohonan', $jobOrder->qty_surat_permohonan ?? '') }}"
                            class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1 @error('qty_surat_permohonan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">
                        @error('qty_surat_permohonan')
                            <div class="text-xs text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- End Kelengkapan Alat --}}

            {{-- Catatan --}}
                <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">
                    Catatan
                </label>
                <textarea 
                    name="catatan" 
                    id="catatan" 
                    rows="4"
                    placeholder="Masukkan catatan..."
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('catatan') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror">{{ old('catatan', $jobOrder->catatan) }}</textarea>
                @error('catatan')
                <div class="text-xs text-red-600">
                    {{ $message }}
                </div>
                @enderror   
                </div>
                {{-- End Catatan --}}
            
            {{-- Tombol Submit --}}
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700">Update Job Order</button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
        const style = document.createElement("style");
            style.innerHTML = `
            .ts-wrapper {
                width: 100% !important;
                max-width: 100% !important;
            }
            .ts-control {
                width: 100% !important;
                min-width: 100% !important;
                box-sizing: border-box;
                display: flex !important;
                flex-wrap: nowrap !important;   /* cegah melar */
                align-items: center;
            }
            .ts-control .item {
                max-width: 100%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .ts-control input {
                flex: 1 1 auto !important;
                min-width: 0 !important;  /* penting: biar tidak dorong kolom */
                width: auto !important;
            }
            `;
            document.head.appendChild(style);



            // Tom Select untuk responsibles
            new TomSelect("#responsibles", {
                plugins: ['remove_button'],   // tombol hapus di setiap pilihan
                persist: false,
                create: false,
                placeholder: "Pilih penanggung jawab..."
            });

            // Dynamic Button Input
            // Row count/Jumlah baris data dimulai dari jumlah old data, kalau tidak ada baris data baru maka gunakan data dari database
            // Hitung rowCount dari old data
            let rowCount = {{ old('tools') ? count(old('tools')) : $jobOrder->tools->count() }};

            // Init TomSelect untuk select lama (old)
            for (let i = 0; i < rowCount; i++) {
                new TomSelect(`#tool-select-${i}`, {
                    create: false,
                    placeholder: "-- Pilih alat --",
                });
            }

            // Tambah baris baru
            document.getElementById('add-tool').addEventListener('click', function() {
                let row = `
                <tr>
                    <td class="w-full sm:w-[30%] min-w-[200px] px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <select id="tool-select-${rowCount}" name="tools[${rowCount}][tool_id]" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($tools as $tool)
                                <option value="{{ $tool->id }}">{{ $tool->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <input type="number" name="tools[${rowCount}][qty]" class="bg-gray-100 rounded-md form-control" min="1" required>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <select name="tools[${rowCount}][status]" class="form-control" required>
                            <option value="pertama">Pertama</option>
                            <option value="resertifikasi">Resertifikasi</option>
                        </select>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <input type="text" name="tools[${rowCount}][kapasitas]" class="bg-gray-100 rounded-md form-control">
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <input type="text" name="tools[${rowCount}][model]" class="bg-gray-100 rounded-md form-control">
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <input type="text" name="tools[${rowCount}][no_seri]" class="bg-gray-100 rounded-md form-control">
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <button type="button" class="flex p-2 transition-all duration-500 rounded-full remove-row group item-center">
                            <!-- SVG hapus -->
                                <svg class="pointer-events-none" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="pointer-events-none fill-red-600" d="M4.00031 5.49999V4.69999H3.20031V5.49999H4.00031ZM16.0003 5.49999H16.8003V4.69999H16.0003V5.49999ZM17.5003 5.49999L17.5003 6.29999C17.9421 6.29999 18.3003 5.94183 18.3003 5.5C18.3003 5.05817 17.9421 4.7 17.5003 4.69999L17.5003 5.49999ZM9.30029 9.24997C9.30029 8.80814 8.94212 8.44997 8.50029 8.44997C8.05847 8.44997 7.70029 8.80814 7.70029 9.24997H9.30029ZM7.70029 13.75C7.70029 14.1918 8.05847 14.55 8.50029 14.55C8.94212 14.55 9.30029 14.1918 9.30029 13.75H7.70029ZM12.3004 9.24997C12.3004 8.80814 11.9422 8.44997 11.5004 8.44997C11.0585 8.44997 10.7004 8.80814 10.7004 9.24997H12.3004ZM10.7004 13.75C10.7004 14.1918 11.0585 14.55 11.5004 14.55C11.9422 14.55 12.3004 14.1918 12.3004 13.75H10.7004ZM4.00031 6.29999H16.0003V4.69999H4.00031V6.29999ZM15.2003 5.49999V12.5H16.8003V5.49999H15.2003ZM11.0003 16.7H9.00031V18.3H11.0003V16.7ZM4.80031 12.5V5.49999H3.20031V12.5H4.80031ZM9.00031 16.7C7.79918 16.7 6.97882 16.6983 6.36373 16.6156C5.77165 16.536 5.49093 16.3948 5.29823 16.2021L4.16686 17.3334C4.70639 17.873 5.38104 18.0979 6.15053 18.2013C6.89702 18.3017 7.84442 18.3 9.00031 18.3V16.7ZM3.20031 12.5C3.20031 13.6559 3.19861 14.6033 3.29897 15.3498C3.40243 16.1193 3.62733 16.7939 4.16686 17.3334L5.29823 16.2021C5.10553 16.0094 4.96431 15.7286 4.88471 15.1366C4.80201 14.5215 4.80031 13.7011 4.80031 12.5H3.20031ZM15.2003 12.5C15.2003 13.7011 15.1986 14.5215 15.1159 15.1366C15.0363 15.7286 14.8951 16.0094 14.7024 16.2021L15.8338 17.3334C16.3733 16.7939 16.5982 16.1193 16.7016 15.3498C16.802 14.6033 16.8003 13.6559 16.8003 12.5H15.2003ZM11.0003 18.3C12.1562 18.3 13.1036 18.3017 13.8501 18.2013C14.6196 18.0979 15.2942 17.873 15.8338 17.3334L14.7024 16.2021C14.5097 16.3948 14.229 16.536 13.6369 16.6156C13.0218 16.6983 12.2014 16.7 11.0003 16.7V18.3ZM2.50031 4.69999C2.22572 4.7 2.04405 4.7 1.94475 4.7C1.89511 4.7 1.86604 4.7 1.85624 4.7C1.85471 4.7 1.85206 4.7 1.851 4.7C1.05253 5.50059 1.85233 6.3 1.85256 6.3C1.85273 6.3 1.85297 6.3 1.85327 6.3C1.85385 6.3 1.85472 6.3 1.85587 6.3C1.86047 6.3 1.86972 6.3 1.88345 6.3C1.99328 6.3 2.39045 6.3 2.9906 6.3C4.19091 6.3 6.2032 6.3 8.35279 6.3C10.5024 6.3 12.7893 6.3 14.5387 6.3C15.4135 6.3 16.1539 6.3 16.6756 6.3C16.9364 6.3 17.1426 6.29999 17.2836 6.29999C17.3541 6.29999 17.4083 6.29999 17.4448 6.29999C17.4631 6.29999 17.477 6.29999 17.4863 6.29999C17.4909 6.29999 17.4944 6.29999 17.4968 6.29999C17.498 6.29999 17.4988 6.29999 17.4994 6.29999C17.4997 6.29999 17.4999 6.29999 17.5001 6.29999C17.5002 6.29999 17.5003 6.29999 17.5003 5.49999C17.5003 4.69999 17.5002 4.69999 17.5001 4.69999C17.4999 4.69999 17.4997 4.69999 17.4994 4.69999C17.4988 4.69999 17.498 4.69999 17.4968 4.69999C17.4944 4.69999 17.4909 4.69999 17.4863 4.69999C17.477 4.69999 17.4631 4.69999 17.4448 4.69999C17.4083 4.69999 17.3541 4.69999 17.2836 4.69999C17.1426 4.7 16.9364 4.7 16.6756 4.7C16.1539 4.7 15.4135 4.7 14.5387 4.7C12.7893 4.7 10.5024 4.7 8.35279 4.7C6.2032 4.7 4.19091 4.7 2.9906 4.7C2.39044 4.7 1.99329 4.7 1.88347 4.7C1.86974 4.7 1.86051 4.7 1.85594 4.7C1.8548 4.7 1.85396 4.7 1.85342 4.7C1.85315 4.7 1.85298 4.7 1.85288 4.7C1.85284 4.7 2.65253 5.49941 1.85408 6.3C1.85314 6.3 1.85296 6.3 1.85632 6.3C1.86608 6.3 1.89511 6.3 1.94477 6.3C2.04406 6.3 2.22573 6.3 2.50031 6.29999L2.50031 4.69999ZM7.05028 5.49994V4.16661H5.45028V5.49994H7.05028ZM7.91695 3.29994H12.0836V1.69994H7.91695V3.29994ZM12.9503 4.16661V5.49994H14.5503V4.16661H12.9503ZM12.0836 3.29994C12.5623 3.29994 12.9503 3.68796 12.9503 4.16661H14.5503C14.5503 2.8043 13.4459 1.69994 12.0836 1.69994V3.29994ZM7.05028 4.16661C7.05028 3.68796 7.4383 3.29994 7.91695 3.29994V1.69994C6.55465 1.69994 5.45028 2.8043 5.45028 4.16661H7.05028ZM2.50031 6.29999C4.70481 6.29998 6.40335 6.29998 8.1253 6.29997C9.84725 6.29996 11.5458 6.29995 13.7503 6.29994L13.7503 4.69994C11.5458 4.69995 9.84724 4.69996 8.12529 4.69997C6.40335 4.69998 4.7048 4.69998 2.50031 4.69999L2.50031 6.29999ZM13.7503 6.29994L17.5003 6.29999L17.5003 4.69999L13.7503 4.69994L13.7503 6.29994ZM7.70029 9.24997V13.75H9.30029V9.24997H7.70029ZM10.7004 9.24997V13.75H12.3004V9.24997H10.7004Z" fill="#F87171"></path>
                                </svg>
                        </button>
                    </td>
                </tr>`;

                document.querySelector('#tools-table tbody').insertAdjacentHTML('beforeend', row);

                // Init TomSelect pada row baru
                new TomSelect(`#tool-select-${rowCount}`, {
                    create: false,
                    placeholder: "-- Pilih alat --",
                });

                rowCount++;
            });

            // Event delegation untuk hapus row (lama & baru)
            document.querySelector('#tools-table tbody').addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    e.target.closest('tr').remove();
                }
            });

            // Remove Button Dynamic Input
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                }
            });
        </script>
        @endpush
</x-layout>
