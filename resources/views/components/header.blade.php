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
        <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="w-full h-full">
                    <img src="{{ asset('assets/profile/meong.jpeg') }}"
                        class="object-cover w-full h-full"
                        alt="photo">
                </button>
            </form>
        </div>

    </div>
</header>
