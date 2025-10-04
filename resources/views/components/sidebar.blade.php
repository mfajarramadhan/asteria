{{-- class md:static dihilangkan aga fixed --}}
<aside class="fixed inset-y-0 left-0 z-50 w-20 transition-all duration-300 ease-in-out bg-white shadow-lg md:w-64"
    :class="{ 'w-64': openSidebar, 'hidden md:block': !openSidebar }">
    <div class="flex items-center justify-between h-16 p-4 border-b">
        <div class="flex items-center gap-2">
            <!-- Logo -->
            <img
                src="{{ asset('assets/logo/logo-asteria.png') }}"
                alt="PT Asteria"
                class="object-contain w-14 h-14 transition-transform transform-gpu hover:scale-[105%]">
            <!-- Text -->
            <h1
                :class="{ 'opacity-100': openSidebar || window.innerWidth >= 768, 'opacity-0 hidden': !openSidebar && window.innerWidth < 768 }"
                class="text-xl italic font-bold text-black transition-opacity duration-300 cursor-default">
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
            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('dashboard') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0l-2-2m2 2V4a1 1 0 00-1-1h-3a1 1 0 00-1 1z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Dashboard
                    </span>
                </a>
            </li>

            {{-- Daftar Alat --}}
            @role('superAdmin|admin')
            <li>
                <a href="{{ route('tools.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('tools.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('tools.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('tools.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Daftar Alat
                    </span>
                </a>
            </li>
            @endrole

            {{-- Job Order --}}
            <li>
                <a href="{{ route('job_orders.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('job_orders.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('job_orders.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('job_orders.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Job Order
                    </span>
                </a>
            </li>

            {{-- Riksa Uji --}}
            <li>
                <a href="{{ route('riksa_uji.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('riksa_uji.index') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('riksa_uji.index') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('riksa_uji.index') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Riksa Uji
                    </span>
                </a>
            </li>

            {{-- PUBT --}}
            <li>
                <a href="{{ route('form_kp.pubt.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.pubt.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('form_kp.pubt.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.pubt.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        PUBT
                    </span>
                </a>
            </li>

            {{-- PAPA --}}
            <li>
                <a href="{{ route('form_kp.papa.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.papa.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('form_kp.papa.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.papa.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        PAPA
                    </span>
                </a>
            </li>

            {{-- Eskalator --}}
            <li>
                <a href="{{ route('form_kp.eskalator.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.eskalator.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('form_kp.eskalator.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.eskalator.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        ESKALATOR
                    </span>
                </a>
            </li>

            {{-- Kelola Pengguna --}}
            @role('superAdmin')
            <li>
                <a href="{{ route('superadmin.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('superadmin.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors {{ request()->routeIs('superadmin.*') ? 'text-white' : 'text-gray-600 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('superadmin.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Kelola Pengguna
                    </span>
                </a>
            </li>
            @endrole
        </ul>
    </nav>
</aside>