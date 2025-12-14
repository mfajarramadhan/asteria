<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2">
        <a href="{{ route('form_kp.listrik.instalasi_listrik.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-green-700 to-green-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/listrik/conflict.png') }}" alt="Instalasi Listrik" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Instalasi Listrik</h2>
        </a>

        <a href="{{ route('form_kp.listrik.instalasi_penyalur_petir.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-red-700 to-red-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/listrik/lightning.png') }}" alt="Instalasi Penyalur Petir" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Instalasi Penyalur Petir</h2>
        </a>
    </div>
</x-layout>
