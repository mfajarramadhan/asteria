<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2">
        <a href="{{ route('form_kp.ipk.instalasi_fire_hydrant.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-green-700 to-green-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/ipk/fire-hydrant.png') }}" alt="Scissor Lift" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Instalasi Fire Hydrant</h2>
        </a>

        <a href="{{ route('form_kp.ipk.instalasi_fire_alarm.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/ipk/fire-alarm.png') }}" alt="Katel Uap" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Instalasi Fire Alarm</h2>
        </a>
    </div>
</x-layout>