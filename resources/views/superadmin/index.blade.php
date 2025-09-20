<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

   {{-- Alert Success --}}
    @if (session()->has('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            @click.outside="show = false"
            class="flex items-center p-2 mb-2 text-white rounded-lg shadow bg-gradient-to-t from-blue-900 to-blue-500" 
            role="alert" 
            x-transition
        >
            <div class="text-sm font-semibold ms-2">
                {{ session('success') }}
            </div>

            <button type="button" 
                @click="show = false"
                class="flex items-center justify-center w-8 h-8 text-black bg-gray-200 rounded-md ms-auto focus:ring-2 focus:ring-blue-300 hover:bg-blue-300" 
                aria-label="Close">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Success --}}

    {{-- Alert Error --}}
    @if (session()->has('error')) 
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            @click.outside="show = false"
            class="flex items-center p-2 mb-2 text-white rounded-lg shadow bg-gradient-to-t from-red-700 to-red-500" 
            role="alert" 
            x-transition
        >
            <div class="text-sm font-medium ms-2">
                {{ session('error') }}
            </div>

            <button type="button" 
                @click="show = false"
                class="flex items-center justify-center w-8 h-8 text-white bg-gray-200 rounded-md ms-auto focus:ring-2 focus:ring-red-300 hover:bg-red-300" 
                aria-label="Close">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- End Alert Error --}}
    
    {{-- Table User --}}
    <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No.</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID Karyawan</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Role</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $user->nama }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $user->id_user }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                        <form action="{{ route('superadmin.updateRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="role"
                                class="px-2 py-1 border rounded"
                                onchange="this.form.submit()">
                                @foreach (['admin', 'petugas', 'penyusunLHP'] as $role)
                                    <option value="{{ $role }}"
                                        {{ $user->hasRole($role) ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                         <form action="{{ route('superadmin.destroyUser', $user->id) }}" method="POST" onsubmit='return confirm("Yakin menghapus pengguna dengan nama \"{{ $user->nama }}\"?");'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm font-bold text-white rounded-full bg-gradient-to-t from-red-700 to-red-500">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- End Table User --}}
</x-layout>


