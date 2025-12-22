<header class="flex items-center justify-between gap-5 mb-6">
    <!-- Title & Subtitle (Kiri) -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $title }}</h1>
        <p class="text-gray-600">{{ $subtitle }}</p>
    </div>

    <!-- User Info / Image (Kanan) -->
    <div class="gap-[10px] items-center hidden md:flex">
        <!-- Text Info -->
        <div class="flex flex-col items-end justify-center">
            <p class="font-semibold text-black">{{ auth()->user()->nama }}</p>
            <p class="text-sm font-light">{{ auth()->user()->jabatan }}</p>
        </div>
        <!-- Image -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0 border-2 border-blue-700 focus:outline-none">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->nama }}"
                class="object-cover w-full h-full"
                alt="photo">
            </button>

            <div x-show="open" 
                 @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 z-50 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                 style="display: none;">
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>
