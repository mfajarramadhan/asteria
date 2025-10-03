<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>    
    <!-- Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen font-sans bg-gray-100">
    <div x-data="{ openSidebar: false }" class="flex flex-col min-h-screen md:flex-row">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <main class="flex-1 p-4 overflow-y-auto transition-all duration-300 md:p-6 md:ml-64">
            <!-- Mobile Menu Toggle -->
            <div class="flex items-start justify-between mb-4 md:hidden ">
                {{-- Hamburger Menu --}}
                <button @click="openSidebar = !openSidebar" class="p-2 rounded-full hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                {{-- Icon Profile --}}
                @auth
                <div class="flex gap-[10px] items-center">
                    <div class="flex flex-col items-end justify-center">
                        <p class="font-semibold text-black">{{ auth()->user()->nama }}</p>
                        <p class="text-sm font-light">{{ auth()->user()->jabatan }}</p>
                    </div>
                    <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0 border-2 border-blue-700">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('storage/' . (auth()->user()->avatar ?? 'avatars/default.png')) }}" 
                            class="object-cover w-full h-full" alt="photo">
                        </a>
                    </div>
                </div>
                @endauth
            </div>

            <!-- Dashboard Section -->
            <div class="space-y-6">
                <x-header>
                    <x-slot:title>{{ $title }}</x-slot:title>
                    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
                </x-header>
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>


{{-- Layout --}}
{{-- 
<div class="relative inline-block group">
    <button class="px-4 py-2 text-white transition duration-300 ease-in-out transform bg-teal-500 rounded-lg hover:bg-teal-600 hover:scale-105">Hover Me</button>
    <div
        class="absolute z-10 invisible w-48 py-2 mt-2 text-gray-800 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible">
        <p class="px-4 py-2">This is a popover component.</p>
        <p class="px-4 py-2">You can customize it with your content.</p>
    </div>
</div> --}}