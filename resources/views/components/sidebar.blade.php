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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="m12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81zM12 3L2 12h3v8h6v-6h2v6h6v-8h3" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        Dashboard
                    </span>
                </a>
            </li>

            {{-- Daftar Alat --}}
            @role('Super Admin|Admin Riksa Uji')
            <li>
                <a href="{{ route('tools.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('tools.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('tools.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="m21.71 20.29l-1.42 1.42a1 1 0 0 1-1.41 0L7 9.85A3.8 3.8 0 0 1 6 10a4 4 0 0 1-3.78-5.3l2.54 2.54l.53-.53l1.42-1.42l.53-.53L4.7 2.22A4 4 0 0 1 10 6a3.8 3.8 0 0 1-.15 1l11.86 11.88a1 1 0 0 1 0 1.41M2.29 18.88a1 1 0 0 0 0 1.41l1.42 1.42a1 1 0 0 0 1.41 0l5.47-5.46l-2.83-2.83M20 2l-4 2v2l-2.17 2.17l2 2L18 8h2l2-4Z" />
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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('job_orders.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="m18.13 12l1.26-1.26c.44-.44 1-.68 1.61-.74V9l-6-6H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h6v-1.87l.13-.13H5V5h7v7zM14 4.5l5.5 5.5H14zm5.13 9.33l2.04 2.04L15.04 22H13v-2.04zm3.72.36l-.98.98l-2.04-2.04l.98-.98c.19-.2.52-.2.72 0l1.32 1.32c.2.2.2.53 0 .72" />
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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('riksa_uji.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('form_kp.pubt.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.pubt.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        PUBT
                    </span>
                </a>
            </li>

            {{-- PTP --}}
            <li>
                <a href="{{ route('form_kp.ptp.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.ptp.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('form_kp.ptp.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.ptp.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        PTP
                    </span>
                </a>
            </li>
            
            {{-- PAPA --}}
            {{-- <li>
                <a href="{{ route('form_kp.papa.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.papa.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('form_kp.papa.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.papa.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        PAPA
                    </span>
                </a>
            </li> --}}

            {{-- Eskalator --}}
            <li>
                <a href="{{ route('form_kp.eskalator.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.eskalator.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('form_kp.eskalator.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.eskalator.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        ESKALATOR
                    </span>
                </a>
            </li>

            {{-- IPK --}}
            <li>
                <a href="{{ route('form_kp.ipk.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('form_kp.ipk.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('form_kp.ipk.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V9h14zM5 7V5h14v2zm5.56 10.46l5.94-5.93l-1.07-1.06l-4.87 4.87l-2.11-2.11l-1.06 1.06z" />
                    </svg>
                    <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }"
                        class="transition-opacity duration-300 {{ request()->routeIs('form_kp.ipk.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        IPK
                    </span>
                </a>
            </li>

            {{-- Kelola Pengguna --}}
            @role('Super Admin')
            <li>
                <a href="{{ route('superadmin.index') }}"
                    class="flex items-center px-4 py-2 space-x-3 font-semibold transition-colors rounded-lg hover:bg-gradient-to-t hover:from-blue-900 hover:to-blue-500 group
                    {{ request()->routeIs('superadmin.*') ? 'bg-gradient-to-t from-blue-900 to-blue-500' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24"
                        class="w-6 h-6 transition-colors {{ request()->routeIs('superadmin.*') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}">
                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
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