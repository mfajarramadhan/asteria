<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <!-- Photo Gallery Section -->
    <section class="py-6 bg-white">
        <div class="container px-6 mx-auto">
            <button class="px-5 py-3 font-bold text-white transition-transform rounded-full bg-gradient-to-r from-red-600 to-red-500 transform-gpu hover:-translate-y-0.5 hover:shadow-lg">
                <a href="{{ route('tools.index') }}">< Kembali</a>
            </button>
            <div class="mb-16 text-center">
                <h2 class="mt-4 text-4xl font-bold text-gray-900 md:text-5xl">
                    {{ $tool->nama }}
                </h2>
                <p class="max-w-2xl mx-auto mt-6 text-lg text-gray-600">
                    {{ $tool->deskripsi }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $lampiranList = $tool->lampiran ? json_decode($tool->lampiran, true) : [];
                @endphp

                @if ($lampiranList && count($lampiranList) > 0)
                    @foreach ($lampiranList as $lampiran)
                        <!-- Gallery Item -->
                        <div class="flex justify-center p-2 border rounded-lg bg-gray-50">
                            <img 
                                src="{{ asset('storage/' . $lampiran) }}" 
                                alt="{{ $tool->nama }}" 
                                class="h-auto max-w-full rounded-md"
                            >
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">Belum ada lampiran untuk alat ini.</p>
                @endif
            </div>
        </div>
    </section>
</x-layout>
