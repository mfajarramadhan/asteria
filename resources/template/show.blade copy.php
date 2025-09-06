<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
<!-- Photo Gallery Section -->
<section class="py-20 bg-white">
  <div class="container px-6 mx-auto">
    <div class="mb-16 text-center">
      <h2 class="mt-4 text-4xl font-bold text-gray-900 md:text-5xl">{{ $tool->nama_alat }}</h2>
      <p class="max-w-2xl mx-auto mt-6 text-lg text-gray-600">A visual journey through our most memorable events and projects</p>
    </div>

    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
    @php
      $lampiranList = $tool->lampiran ? json_decode($tool->lampiran, true) : [];
    @endphp

    @if ($lampiranList && count($lampiranList) > 0)
      @foreach ($lampiranList as $lampiran)
        <!-- Gallery Item -->
        <div class="relative overflow-hidden rounded-lg group aspect-square">
          <img 
            src="{{ asset('storage/' . $lampiran) }}" 
            alt="{{ $tool->nama_alat }}" 
            class="object-cover w-full h-full transition-transform duration-500 transform group-hover:scale-110"
          >
          <div class="absolute inset-0 flex items-end p-6 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 to-transparent group-hover:opacity-100">
            <div class="transition-transform duration-300 translate-y-4 group-hover:translate-y-0">
              <h3 class="text-xl font-bold text-white">{{ $tool->nama_alat }}</h3>
              <p class="mt-1 text-white/80">Lampiran</p>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <p class="text-gray-500">Belum ada lampiran untuk alat ini.</p>
    @endif
  </div>
</section>
</x-layout>