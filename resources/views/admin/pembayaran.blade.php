<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pembayaran - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4EFE6]">

    <!-- NAVBAR -->
    <nav class="bg-[#17324D] text-white px-8 py-5 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                HOTEL AMBATUKAM
            </h1>

            <p class="text-sm text-gray-300">
                Admin / Data Pembayaran
            </p>
        </div>

        <a
            href="/admin"
            class="bg-white text-[#17324D] px-5 py-2 rounded-lg font-semibold
                   hover:bg-[#F4EFE6]
                   hover:-translate-y-0.5
                   active:scale-95
                   transition-all duration-200">
            Dashboard
        </a>

    </nav>


    <!-- CONTENT -->
    <main class="p-8">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <!-- JUDUL -->
            <div class="mb-6">

                <h2 class="text-2xl font-bold text-[#17324D]">
                    💳 Data Pembayaran
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola pembayaran dan verifikasi bukti pembayaran tamu
                </p>

            </div>


            <!-- SEARCH -->
            <form action="/admin/pembayaran" method="GET" class="mb-6">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama tamu, nomor kamar, metode, atau status..."
                        class="flex-1 border border-[#17324D] rounded-lg px-4 py-3
                               text-[#17324D]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#17324D]">

                    <button
                        type="submit"
                        class="bg-[#17324D] text-white px-6 py-3 rounded-lg
                               hover:bg-white
                               hover:text-[#17324D]
                               hover:-translate-y-0.5
                               active:scale-95
                               transition-all duration-200
                               border border-[#17324D]">
                        Cari
                    </button>

                    @if(!empty($search))

                        <a
                            href="/admin/pembayaran"
                            class="bg-white text-[#17324D] px-6 py-3 rounded-lg
                                   border border-[#17324D]
                                   hover:bg-[#F4EFE6]
                                   hover:-translate-y-0.5
                                   active:scale-95
                                   transition-all duration-200">
                            Reset
                        </a>

                    @endif

                </div>

            </form>


            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="mb-6 bg-green-100 text-green-800 px-5 py-4 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROR MESSAGE -->
            @if($errors->any())

                <div class="mb-6 bg-red-100 text-red-800 px-5 py-4 rounded-lg">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full border-collapse">

                    <thead>

                        <tr class="bg-[#17324D] text-white">

                            <th class="px-4 py-4 text-left">
                                No
                            </th>

                            <th class="px-4 py-4 text-left">
                                Nama Tamu
                            </th>

                            <th class="px-4 py-4 text-left">
                                Kamar
                            </th>

                            <th class="px-4 py-4 text-left">
                                Check-in
                            </th>

                            <th class="px-4 py-4 text-left">
                                Check-out
                            </th>

                            <th class="px-4 py-4 text-left">
                                Jumlah
                            </th>

                            <th class="px-4 py-4 text-left">
                                Metode
                            </th>

                            <th class="px-4 py-4 text-left">
                                Bukti
                            </th>

                            <th class="px-4 py-4 text-left">
                                Status
                            </th>

                            <th class="px-4 py-4 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pembayarans as $pembayaran)

                            <tr class="border-b hover:bg-[#F4EFE6]">

                                <!-- NO -->
                                <td class="px-4 py-4">
                                    {{ $pembayarans->firstItem() + $loop->index }}
                                </td>


                                <!-- NAMA -->
                                <td class="px-4 py-4 font-semibold text-[#17324D]">
                                    {{ $pembayaran->reservasi->tamu->nama ?? '-' }}
                                </td>


                                <!-- KAMAR -->
                                <td class="px-4 py-4">
                                    {{ $pembayaran->reservasi->kamar->nomor_kamar ?? '-' }}
                                </td>


                                <!-- CHECK IN -->
                                <td class="px-4 py-4">
                                    {{ $pembayaran->reservasi->check_in ?? '-' }}
                                </td>


                                <!-- CHECK OUT -->
                                <td class="px-4 py-4">
                                    {{ $pembayaran->reservasi->check_out ?? '-' }}
                                </td>


                                <!-- JUMLAH -->
                                <td class="px-4 py-4">

                                    Rp
                                    {{ number_format($pembayaran->jumlah, 0, ',', '.') }}

                                </td>


                                <!-- METODE -->
                                <td class="px-4 py-4">
                                    {{ $pembayaran->metode }}
                                </td>


                                <!-- BUKTI -->
                                <td class="px-4 py-4">

                                    @if($pembayaran->bukti_pembayaran)

                                        <button
                                            type="button"
                                            onclick="bukaModal('{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}')"
                                            class="bg-[#17324D] text-white px-4 py-2 rounded-lg text-sm
                                                   hover:bg-white
                                                   hover:text-[#17324D]
                                                   active:scale-95
                                                   transition-all duration-200
                                                   border border-[#17324D]">
                                            Lihat Bukti
                                        </button>

                                    @else

                                        <span class="text-[#17324D]">
                                            Tidak ada
                                        </span>

                                    @endif

                                </td>


                                <!-- STATUS -->
                                <td class="px-4 py-4">

                                    @if($pembayaran->status === 'disetujui')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Disetujui
                                        </span>

                                    @elseif($pembayaran->status === 'ditolak')

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                            Menunggu
                                        </span>

                                    @endif

                                </td>


                                <!-- AKSI -->
                                <td class="px-4 py-4">

                                    @if($pembayaran->status === 'menunggu')

                                        <div class="flex flex-col gap-2">

                                            <!-- SETUJUI -->
                                            <form
                                                action="/admin/pembayaran/{{ $pembayaran->id }}/setuju"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="w-full bg-green-600 text-white px-4 py-2 rounded-lg text-sm
                                                           hover:bg-green-700
                                                           active:scale-95
                                                           transition-all duration-200">
                                                    Setujui
                                                </button>

                                            </form>


                                            <!-- TOLAK -->
                                            <form
                                                action="/admin/pembayaran/{{ $pembayaran->id }}/tolak"
                                                method="POST">

                                                @csrf

                                                <textarea
                                                    name="alasan_penolakan"
                                                    rows="2"
                                                    required
                                                    placeholder="Alasan penolakan..."
                                                    class="w-full border border-red-300 rounded-lg px-3 py-2 text-sm
                                                           focus:outline-none
                                                           focus:ring-2
                                                           focus:ring-red-400"></textarea>

                                                <button
                                                    type="submit"
                                                    class="w-full mt-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm
                                                           hover:bg-red-700
                                                           active:scale-95
                                                           transition-all duration-200">
                                                    Tolak
                                                </button>

                                            </form>

                                        </div>

                                    @elseif($pembayaran->status === 'ditolak')

                                        <div class="text-sm text-red-700">

                                            <p class="font-semibold">
                                                Alasan:
                                            </p>

                                            <p class="mt-1">
                                                {{ $pembayaran->alasan_penolakan ?? '-' }}
                                            </p>

                                        </div>

                                    @else

                                        <span class="text-green-700 text-sm font-semibold">
                                            Pembayaran telah disetujui
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="10"
                                    class="px-4 py-8 text-center text-gray-500">

                                    Data pembayaran tidak ditemukan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->
            <div class="mt-6">

                {{ $pembayarans->links() }}

            </div>


            <!-- KEMBALI -->
            <div class="mt-6">

                <a
                    href="/admin"
                    class="text-[#17324D] font-semibold hover:underline">
                    ← Kembali ke Dashboard
                </a>

            </div>

        </div>

    </main>


    <!-- MODAL BUKTI PEMBAYARAN -->
    <div
        id="modalBukti"
        class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50 p-6">

        <div
            class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden">


            <!-- HEADER MODAL -->
            <div
                class="bg-[#17324D] text-white px-5 py-4 flex justify-between items-center">

                <h2 class="text-xl font-bold">
                    Bukti Pembayaran
                </h2>

                <button
                    type="button"
                    onclick="tutupModal()"
                    class="text-white text-2xl font-bold hover:text-gray-300">
                    &times;
                </button>

            </div>


            <!-- GAMBAR -->
            <div
                class="p-6 flex justify-center bg-[#F4EFE6]">

                <img
                    id="gambarBukti"
                    src=""
                    alt="Bukti Pembayaran"
                    class="max-w-full max-h-[65vh] object-contain rounded-lg shadow">

            </div>


            <!-- FOOTER -->
            <div
                class="px-5 py-4 flex justify-end">

                <button
                    type="button"
                    onclick="tutupModal()"
                    class="bg-[#17324D] text-white px-5 py-2 rounded-lg
                           hover:bg-[#F4EFE6]
                           hover:text-[#17324D]
                           active:scale-95
                           transition-all duration-200">
                    Tutup
                </button>

            </div>

        </div>

    </div>


    <!-- JAVASCRIPT MODAL -->
    <script>

        function bukaModal(gambar)
        {
            document.getElementById('gambarBukti').src = gambar;

            const modal = document.getElementById('modalBukti');

            modal.classList.remove('hidden');

            modal.classList.add('flex');
        }


        function tutupModal()
        {
            const modal = document.getElementById('modalBukti');

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.getElementById('gambarBukti').src = '';
        }


        document
            .getElementById('modalBukti')
            .addEventListener('click', function(event)
            {
                if (event.target === this)
                {
                    tutupModal();
                }
            });

    </script>

</body>

</html>