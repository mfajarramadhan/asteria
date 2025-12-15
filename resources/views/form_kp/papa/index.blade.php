<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-3">
        <a href="{{ route('form_kp.papa.scissor_lift.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-cyan-700 to-cyan-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/scissor-lift.png') }}" alt="Scissor Lift" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Scissor Lift</h2>
        </a>
        
        <a href="{{ route('form_kp.papa.wheel_loader.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-red-700 to-red-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/loader.png') }}" alt="Wheel Loader" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Wheel Loader</h2>
        </a>
        
        <a href="{{ route('form_kp.papa.dump_trailer.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-blue-900 to-blue-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/trailer.png') }}" alt="Dump Trailer" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Dump Trailer</h2>
        </a>
        
        <a href="{{ route('form_kp.papa.crane.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-yellow-700 to-yellow-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/crane.png') }}" alt="Crane" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Crane</h2>
        </a>
        
        <a href="{{ route('form_kp.papa.forklift.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-green-700 to-green-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/forklift.png') }}" alt="Forklift" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Forklift</h2>
        </a>
        
        <a href="{{ route('form_kp.papa.cargo_lift.index') }}" class="flex flex-col items-center p-4 transition-transform rounded-lg shadow-md bg-gradient-to-t from-gray-700 to-gray-500 transform-gpu hover:shadow-lg hover:scale-[103%]">
            <img src="{{ asset('assets/icon/papa/elevator.png') }}" alt="Cargo Lift" class="w-16 h-16 mb-2">
            <h2 class="text-lg font-semibold text-white">Cargo Lift</h2>
        </a>
    </div>
</x-layout>