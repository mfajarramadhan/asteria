<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen font-sans bg-gray-100">
    <div x-data="{ openSidebar: false }" class="flex flex-col min-h-screen md:flex-row">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <main class="flex-1 p-4 overflow-y-auto md:p-6">
            <!-- Mobile Menu Toggle -->
            <div class="flex items-center justify-between mb-4 md:hidden">
                <h1 class="text-xl font-bold text-blue-600">PT. Asteria</h1>
                <button @click="openSidebar = !openSidebar" class="p-2 rounded-full hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Dashboard Section -->
            <div class="space-y-6">
                {{-- Header --}}
                <x-header>
                    <x-slot:title>{{ $title }}</x-slot:title>
                    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
                </x-header>
                {{-- Main Content --}}
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>