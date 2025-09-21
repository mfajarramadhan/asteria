<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.pubt.bejana_tekan.store', $jobOrderTool->id) }}" method="POST" class="space-y-4">
            @csrf

            {{-- Info dari relasi (readonly) --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor JO</label>
                    <input type="text" readonly value="{{ $jobOrderTool->jobOrder->nomor_jo }}"
                        class="w-full p-2 bg-gray-100 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Perusahaan</label>
                    <input type="text" readonly value="{{ $jobOrderTool->jobOrder->nama_perusahaan }}"
                        class="w-full p-2 bg-gray-100 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alat</label>
                    <input type="text" readonly value="{{ $jobOrderTool->tool->nama }}"
                        class="w-full p-2 bg-gray-100 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Seri</label>
                    <input type="text" readonly value="{{ $jobOrderTool->no_seri }}"
                        class="w-full p-2 bg-gray-100 border rounded-md">
                </div>
            </div>

            {{-- Field input pemeriksaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" required
                    class="w-full p-2 border rounded-md @error('tanggal_pemeriksaan') border-red-600 @enderror">
                @error('tanggal_pemeriksaan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pemeriksa</label>
                <input type="text" name="pemeriksa" required placeholder="Nama petugas"
                    class="w-full p-2 border rounded-md @error('pemeriksa') border-red-600 @enderror">
                @error('pemeriksa')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="pagar_pelindung" value="1" class="rounded">
                    Pagar Pelindung
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="ban_pegangan" value="1" class="rounded">
                    Ban Pegangan
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="peralatan_pengaman" value="1" class="rounded">
                    Peralatan Pengaman
                </label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" rows="3" class="w-full p-2 border rounded-md"></textarea>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="px-4 py-2 font-bold text-white rounded-lg bg-gradient-to-t from-blue-900 to-blue-500">
                Simpan Form
            </button>
        </form>
    </div>
</x-layout>
