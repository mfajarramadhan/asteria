{{-- class md:static dihilangkan aga fixed --}}
<aside class="fixed inset-y-0 left-0 z-50 w-20 transition-all duration-300 ease-in-out bg-white shadow-lg md:w-64"
        :class="{ 'w-64': openSidebar, 'hidden md:block': !openSidebar }">
    <div class="flex items-center justify-between h-16 p-4 border-b">
        <div class="flex items-center gap-2">
            <!-- Logo -->
            <img 
                src="{{ asset('assets/logo/logo-asteria.png') }}" 
                alt="PT Asteria" 
                class="object-contain w-14 h-14"
            >
            <!-- Text -->
            <h1 
                :class="{ 'opacity-100': openSidebar || window.innerWidth >= 768, 'opacity-0 hidden': !openSidebar && window.innerWidth < 768 }" 
                class="text-xl italic font-bold text-black transition-opacity duration-300"
            >
                PT. Asteria
            </h1>
        </div>

        <!-- Tombol toggle sidebar -->
        <button @click="openSidebar = !openSidebar" class="p-2 rounded-full md:hidden hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <nav class="py-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-blue-300
                    {{ request()->routeIs('dashboard') ? 'bg-blue-300' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0l-2-2m2 2V4a1 1 0 00-1-1h-3a1 1 0 00-1 1z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                            class="text-gray-700 transition-opacity duration-300">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('job_orders.index') }}" 
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-blue-300 
                    {{ request()->routeIs('job_orders.*') ? 'bg-blue-300' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                            class="text-gray-700 transition-opacity duration-300">Job Order</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tools.index') }}" 
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-blue-300 
                    {{ request()->routeIs('tools.*') ? 'bg-blue-300' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                            class="text-gray-700 transition-opacity duration-300">Daftar Alat</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>