<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2">
        <a href="{{ route('form_kp.ptp.pesawat_tenaga_produksi.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-green-700 to-green-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/ptp/airport.png') }}" alt="Pesawat Tenaga Produksi" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Pesawat Tenaga Produksi</h2>
        </a>

        <a href="{{ route('form_kp.ptp.pesawat_tenaga_produksi.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-red-700 to-red-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/ptp/gears.png') }}" alt="Motor Diesel" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Motor Diesel</h2>
        </a>

        <a href="{{ route('form_kp.ptp.pesawat_tenaga_produksi.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-yellow-700 to-yellow-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/ptp/cooker.png') }}" alt="Heat Treatment/Oven" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Heat Treatment/Oven</h2>
        </a>
    </div>
</x-layout>
