<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>
    
    <button class="px-5 py-3 font-bold text-white transition-transform rounded-full bg-gradient-to-r from-blue-500 to-purple-500 transform-gpu hover:-translate-y-0.5 hover:shadow-lg">
  <a href="{{ route('tools.create') }}">+ Tambah Alat</a>
</button>
    <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
                <tr>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No.</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Alat</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Dokumen & Lampiran</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tools as $tool)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">1</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->nama_alat }}</td>
                    <td class="px-4 py-3 text-sm text-green-600 whitespace-nowrap">{{ $tool->jenis_alat }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $tool->dokumen }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                    <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
