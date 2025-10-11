<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('form_kp.eskalator.eskalator.update', $formKpEskalator->id) }}"
            method="POST"
            class="space-y-4"
            enctype="multipart/form-data"
            onsubmit="return confirm('Perbarui data ini?')">

            @csrf
            @method('PUT')

            {{-- Tanggal Pemeriksaan --}}
            <h2 class="block text-sm font-bold text-gray-700">Tanggal Pemeriksaan</h2>
            <div class="flex flex-wrap justify-between w-full gap-y-4">
                <div class="w-full md:w-[50%]">
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                                <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Z" />
                            </svg>
                        </div>
                        <input
                            name="tanggal_pemeriksaan"
                            value="{{ old('tanggal_pemeriksaan', $formKpEskalator->tanggal_pemeriksaan) }}"
                            placeholder="Tanggal Pemeriksaan"
                            datepicker datepicker-format="dd-mm-yyyy" datepicker-autohide
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('tanggal_pemeriksaan')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan"
                    value="{{ old('nama_perusahaan', $formKpEskalator->nama_perusahaan) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Jenis Eskalator --}}
            <div>
                <input type="text" name="jenis_eskalator" placeholder="Jenis Eskalator"
                    value="{{ old('jenis_eskalator', $formKpEskalator->jenis_eskalator) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Merk Eskalator --}}
            <div>
                <input type="text" name="merk_eskalator" placeholder="Merk Eskalator"
                    value="{{ old('merk_eskalator', $formKpEskalator->merk_eskalator) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Nomor Seri --}}
            <div>
                <input type="text" name="nomor_seri" placeholder="Nomor Seri"
                    value="{{ old('nomor_seri', $formKpEskalator->nomor_seri) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Asal Negara Pembuat --}}
            <div>
                <input type="text" name="asal_negara_pembuat" placeholder="Asal Negara Pembuat"
                    value="{{ old('asal_negara_pembuat', $formKpEskalator->asal_negara_pembuat) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Tahun Pembuatan --}}
            <div>
                <input type="text" name="tahun_pembuatan" placeholder="Tahun Pembuatan"
                    value="{{ old('tahun_pembuatan', $formKpEskalator->tahun_pembuatan) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Kapasitas --}}
            <div>
                <input type="text" name="kapasitas" placeholder="Kapasitas"
                    value="{{ old('kapasitas', $formKpEskalator->kapasitas) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Melayani --}}
            <div>
                <input type="text" name="melayani" placeholder="Melayani"
                    value="{{ old('melayani', $formKpEskalator->melayani) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Lokasi Eskalator --}}
            <div>
                <input type="text" name="lokasi_eskalator" placeholder="Lokasi Eskalator"
                    value="{{ old('lokasi_eskalator', $formKpEskalator->lokasi_eskalator) }}"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Gambar (preview lama) --}}
            <div>
                <h2 class="block mb-1 text-sm font-bold text-gray-700">Foto Pagar Pelindung (Opsional)</h2>
                @if($formKpEskalator->pagar_pelindung)
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach(json_decode($formKpEskalator->pagar_pelindung, true) as $foto)
                    <img src="{{ asset('storage/'.$foto) }}" class="max-h-32 rounded border">
                    @endforeach
                </div>
                @endif
                <input type="file" name="pagar_pelindung[]" multiple accept="image/*"
                    onchange="previewImage(this, 'pagar_pelindung-preview')"
                    class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm">
                <div id="pagar_pelindung-preview" class="flex flex-wrap gap-2"></div>
            </div>

            {{-- ... (Bagian tabel pemeriksaan sama seperti show, cukup ganti old() dengan nilai dari model) --}}
            {{-- Contoh satu baris saja --}}
            <h2 class="block mb-2 text-sm font-bold text-gray-700">Pemeriksaan Dimensi dan Keamanan</h2>
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-2 border">Komponen</th>
                        <th class="px-3 py-2 text-center border">Memenuhi</th>
                        <th class="px-3 py-2 text-center border">Tidak Memenuhi</th>
                        <th class="px-3 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items = [
                    'tinggi' => 'Tinggi',
                    'tekanan_samping' => 'Tekanan Samping',
                    'tekanan_vertikal' => 'Tekanan Vertikal',
                    ];
                    @endphp
                    @foreach ($items as $name => $label)
                    <tr>
                        <td class="px-3 py-2 border">{{ $label }}</td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" name="{{ $name }}" value="Memenuhi"
                                {{ old($name, $formKpEskalator->$name) == 'Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 text-center border">
                            <input type="radio" name="{{ $name }}" value="Tidak Memenuhi"
                                {{ old($name, $formKpEskalator->$name) == 'Tidak Memenuhi' ? 'checked' : '' }}>
                        </td>
                        <td class="px-3 py-2 border">
                            <input type="text" name="{{ $name }}_keterangan"
                                value="{{ old($name.'_keterangan', $formKpEskalator->{$name.'_keterangan'}) }}"
                                class="w-full border px-2 py-1 rounded">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Tombol Simpan --}}
            <button
                class="px-3 py-2 font-bold text-white transition-transform rounded-lg bg-gradient-to-t from-green-900 to-green-500 transform-gpu hover:shadow-md hover:scale-[103%] mt-3">
                Perbarui
            </button>
        </form>
    </div>

    <script>
        function previewImage(inputElement, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = "";
            Array.from(inputElement.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add("max-h-32", "rounded", "border", "m-1");
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</x-layout>