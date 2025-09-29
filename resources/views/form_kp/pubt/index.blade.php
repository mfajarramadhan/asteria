<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2">
        <a href="{{ route('form_kp.pubt.bejana_tekan.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-green-700 to-green-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/pubt/bejana-tekan.png') }}" alt="Bejana Tekan" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Bejana Tekan</h2>
        </a>

        <a href="{{ route('form_kp.pubt.katel_uap.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/pubt/katel-uap.png') }}" alt="Katel Uap" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Katel Uap</h2>
        </a>

        <a href="{{ route('form_kp.pubt.screw_compressor.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-yellow-700 to-yellow-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/pubt/screw-compressor.png') }}" alt="Screw Compressor" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Screw Compressor</h2>
        </a>

        <a href="{{ route('form_kp.pubt.tangki_timbun.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-red-700 to-red-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/pubt/tangki-timbun.png') }}" alt="Tangki Timbun" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Tangki Timbun</h2>
        </a>
    </div>
</x-layout>
