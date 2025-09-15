<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    <div class="grid grid-cols-1 gap-4">
    <div class="p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-700">Total Job Order</h2>
        <p class="text-2xl font-bold text-green-600">{{ $totalJobOrder }}</p>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-700">Riksa Uji Berjalan</h2>
        <p class="text-2xl font-bold text-yellow-600">{{ $riksaBerjalan }}</p>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-700">Riksa Uji Selesai</h2>
        <p class="text-2xl font-bold text-blue-600">{{ $riksaSelesai }}</p>
    </div>
</div>

</x-layout>