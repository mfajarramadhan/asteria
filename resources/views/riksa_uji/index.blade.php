<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

   {{-- Alert Success --}}
    @if (session()->has('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            @click.outside="show = false"
            class="flex items-center p-2 mb-2 text-white rounded-lg shadow bg-gradient-to-t from-blue-900 to-blue-500" 
            role="alert" 
            x-transition
        >
            <div class="text-sm font-semibold ms-2">
                {{ session('success') }}
            </div>

            <button type="button" 
                @click="show = false"
                class="flex items-center justify-center w-8 h-8 text-black bg-gray-200 rounded-md ms-auto focus:ring-2 focus:ring-blue-300 hover:bg-blue-300" 
                aria-label="Close">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Success --}}

    {{-- Alert Error --}}
    @if (session()->has('error')) 
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            @click.outside="show = false"
            class="flex items-center p-2 mb-2 text-white rounded-lg shadow bg-gradient-to-t from-red-700 to-red-500" 
            role="alert" 
            x-transition
        >
            <div class="text-sm font-medium ms-2">
                {{ session('error') }}
            </div>

            <button type="button" 
                @click="show = false"
                class="flex items-center justify-center w-8 h-8 text-white bg-gray-200 rounded-md ms-auto focus:ring-2 focus:ring-red-300 hover:bg-red-300" 
                aria-label="Close">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Error --}}
    
    {{-- Table Alat --}}
    <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No.</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal Diperiksa</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID JO</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alat</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kapasitas</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Model</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Seri</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tools as $tool)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->finished_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->jobOrder->nomor_jo }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->tool->nama }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->tool->jenis->jenis }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->status }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->kapasitas }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->model }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->no_seri }}</td>
                </tr>
                {{-- Read --}}
                {{-- <button class="flex p-2 transition-all duration-500 rounded-full group item-center">
                    <a href="{{ route($tool->tool->subJenis->routeName(), ['job_order_tool_id' => $tool->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                </button> --}}
                {{-- End Read --}}
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- End Table Alat --}}
</x-layout>
