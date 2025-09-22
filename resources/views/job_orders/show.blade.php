<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 space-y-4 bg-white rounded-lg shadow-md">
        <h2 class="block text-sm font-bold text-gray-700">General Order</h2>
        {{-- Nama Perusahaan --}}
        <div>
            <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
            <input type="text" id="nama_perusahaan" disabled value="{{ $jobOrder->nama_perusahaan }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Alamat Perusahaan --}}
        <div>
            <label for="alamat_perusahaan" class="block text-sm font-medium text-gray-700">Alamat Perusahaan</label>
            <input type="text" id="alamat_perusahaan" disabled value="{{ $jobOrder->alamat_perusahaan }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- PIC Order --}}
        <div>
            <label for="pic_order" class="block text-sm font-medium text-gray-700">PIC Order</label>
            <input type="text" id="pic_order" disabled value="{{ $jobOrder->pic_order }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" disabled value="{{ $jobOrder->email }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Contact Person --}}
        <div>
            <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
            <input type="tel" id="contact_person" disabled value="{{ $jobOrder->contact_person }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- No Penawaran --}}
        <div>
            <label for="no_penawaran" class="block text-sm font-medium text-gray-700">No Penawaran</label>
            <input type="text" id="no_penawaran" disabled value="{{ $jobOrder->no_penawaran }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- No Purchase Order --}}
        <div>
            <label for="no_purcash_order" class="block text-sm font-medium text-gray-700">No Purchase Order</label>
            <input type="text" id="no_purcash_order" disabled value="{{ $jobOrder->no_purcash_order }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Tanggal Pemeriksaan --}}
        <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
        <div class="flex flex-wrap justify-between w-full gap-y-4">
            {{-- Tanggal Pemeriksaan 1 --}}
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-1" placeholder="(1)" value="{{ optional($jobOrder->tanggal_pemeriksaan1)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"> 
                </div>
            </div>
            {{-- Tanggal Pemeriksaan 2 --}}
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-2" placeholder="(2)" value="{{ optional($jobOrder->tanggal_pemeriksaan2)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
            {{-- Tanggal Pemeriksaan 3 --}}
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-3" placeholder="(3)" value="{{ optional($jobOrder->tanggal_pemeriksaan3)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
            {{-- Tanggal Pemeriksaan 4 --}}
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-4" placeholder="(4)" value="{{ optional($jobOrder->tanggal_pemeriksaan4)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
            {{-- Tanggal Pemeriksaan 5 --}}
            <div class="w-full md:w-[48%]">
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-5" placeholder="(5)" value="{{ optional($jobOrder->tanggal_pemeriksaan5)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
        </div>

        {{-- Jumlah Hari Pemeriksaan --}}
        <div>
            <label for="jumlah_hari_pemeriksaan" class="block text-sm font-medium text-gray-700">Jumlah Hari Pemeriksaan</label>
            <input type="text" id="jumlah_hari_pemeriksaan" disabled value="{{ $jobOrder->jumlah_hari_pemeriksaan }} Hari"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Tanggal JO Dibuat & Selesai --}}
        <div class="flex flex-wrap justify-between w-full gap-y-4">
            {{-- Tanggal JO Dibuat --}}
            <div class="w-full md:w-[48%]">
                <h2 class="block mb-4 text-sm font-bold text-gray-700">Tanggal JO Dibuat</h2>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-7" value="{{ optional($jobOrder->tanggal_dibuat)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text"  placeholder="Pilih Tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
            {{-- Tanggal Selesai Pemeriksaan --}}
            <div class="w-full md:w-[48%]">
                <h2 class="block mb-4 text-sm font-bold text-gray-700">Tanggal Selesai Pemeriksaan</h2>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input disabled id="datepicker-autohide-6" value="{{ optional($jobOrder->tanggal_selesai)->format('d-m-Y') }}" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" datepicker-buttons datepicker-autoselect-today type="text"  placeholder="Pilih Tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                </div>
            </div>
        </div>
        {{-- End Tanggal Selesai Pemeriksaan --}}

        {{-- Jam Bertemu --}}
        <div class="pb-2">
            <div class="flex justify-between gap-x-2 gap-y-4">
                <div class="inline-block w-full md:w-[48%]">
                    <label for="jam_bertemu" class="block mb-4 text-sm font-medium text-gray-900">Jam Bertemu:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input disabled type="time" value="{{ $jobOrder->jam_bertemu }}" id="jam_bertemu" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                    </div>
                </div>
                <div class="inline-block w-full md:w-[48%]">
                    <label for="end-time" class="block mb-4 text-sm font-medium text-gray-900">Jam Selesai:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input disabled type="time" value="{{ $jobOrder->jam_selesai }}" id="end-time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Jam Bertemu --}}

        {{-- PIC Ditemui --}}
        <div>
            <label for="pic_ditemui" class="block text-sm font-medium text-gray-700">PIC Ditemui</label>
            <input type="text" id="pic_ditemui" disabled value="{{ $jobOrder->pic_ditemui }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>
        {{-- End PIC Ditemui --}}

        {{-- Contact Person 2 --}}
        <div>
            <label for="contact_person2" class="block text-sm font-medium text-gray-700">Contact Person</label>
            <input type="text" id="contact_person2" disabled value="{{ $jobOrder->contact_person2 }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>
        {{-- End Contact Person 2 --}}

        {{-- ID JO --}}
        <div>
            <label for="nomor_jo" class="block text-sm font-medium text-gray-700">ID JO</label>
            <input type="text" id="nomor_jo" disabled value="{{ $jobOrder->nomor_jo }}"
                   class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        {{-- Penanggung Jawab --}}
        <div>
            <label for="responsibles" class="block text-sm font-medium text-gray-700">Penanggung Jawab</label>
            <div class="px-4 pb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="table min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jabatan</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($jobOrder->responsibles as $responsible)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $responsible->nama }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $responsible->jabatan }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Alat --}}
        <label for="responsibles" class="block text-sm font-medium text-gray-700">List Job Order</label>
        <div class="px-4 pb-4 overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="table min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alat</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Qty</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kapasitas</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Model/Tipe</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Seri</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status Pemeriksaan</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach ($jobOrder->tools as $tool)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->nama }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->jenis->jenis }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->pivot->qty }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->pivot->status }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->pivot->kapasitas }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->pivot->model }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->pivot->no_seri }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                            @if ($tool->pivot->status_tool == 'belum')
                                <span class="px-3 py-1 text-sm font-bold text-white rounded-full bg-gradient-to-t from-red-700 to-red-500">
                                    {{ ucfirst($tool->pivot->status_tool) }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm font-bold text-white rounded-full bg-gradient-to-t from-green-700 to-green-500">
                                    {{ ucfirst($tool->pivot->status_tool) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                            @if ($tool->pivot->status_tool === 'belum')
                            <a href="{{ route($tool->subJenis->routeName(), $tool->pivot->id) }}"
                                class="px-3 py-1 text-sm font-bold text-white rounded-full bg-gradient-to-t from-blue-900 to-blue-500">
                                    + Isi Form KP
                                </a>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Kelengkapan Alat --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Kelengkapan Alat
            </label>

            <div class="px-3 py-2 mt-1 space-y-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">

                {{-- Manual Book --}}
                <div class="flex items-center gap-3">
                    <label class="flex-1 cursor-pointer">Manual Book (Spesifikasi Alat)</label>
                    <input type="checkbox" disabled 
                        {{ $jobOrder->kelengkapan_manual_book ? 'checked' : '' }}
                        class="w-5 h-5">
                    <input type="number" placeholder="Qty..." disabled
                        value="{{ $jobOrder->qty_manual_book ?? 0 }}"
                        class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1">
                </div>

                {{-- Layout --}}
                <div class="flex items-center gap-3">
                    <label class="flex-1 cursor-pointer">Layout/Diagram Instalasi</label>
                    <input type="checkbox" disabled 
                        {{ $jobOrder->kelengkapan_layout ? 'checked' : '' }}
                        class="w-5 h-5">
                    <input type="number" placeholder="Qty..." disabled
                        value="{{ $jobOrder->qty_layout ?? 0 }}"
                        class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1">
                </div>

                {{-- Maintenance Report --}}
                <div class="flex items-center gap-3">
                    <label class="flex-1 cursor-pointer">Checklist Maintenance Report</label>
                    <input type="checkbox" disabled 
                        {{ $jobOrder->kelengkapan_maintenance_report ? 'checked' : '' }}
                        class="w-5 h-5">
                    <input type="number" placeholder="Qty..." disabled
                        value="{{ $jobOrder->qty_maintenance_report ?? 0 }}"
                        class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1">
                </div>

                {{-- Surat Permohonan --}}
                <div class="flex items-center gap-3">
                    <label class="flex-1 cursor-pointer">Surat Permohonan</label>
                    <input type="checkbox" disabled 
                        {{ $jobOrder->kelengkapan_surat_permohonan ? 'checked' : '' }}
                        class="w-5 h-5">
                    <input type="number" placeholder="Qty..." disabled
                        value="{{ $jobOrder->qty_surat_permohonan ?? 0 }}"
                        class="w-20 px-2 py-1 text-sm border border-gray-300 rounded-md sm:flex-1">
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
                disabled
                name="catatan" 
                id="catatan" 
                rows="4"
                placeholder="Masukkan catatan..."
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">{{  $jobOrder->catatan }}</textarea>
        @error('catatan')
        <div class="text-xs text-red-600">
            {{ $message }}
        </div>
        @enderror   
        </div>
        {{-- End Catatan --}}
    </div>
</x-layout>
