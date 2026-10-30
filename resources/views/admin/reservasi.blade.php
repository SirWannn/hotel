<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Reservasi - Hotel AMBATUKAM</title>

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
                Admin / Data Reservasi
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
                    📋 Data Reservasi
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola data reservasi Hotel AMBATUKAM
                </p>

            </div>


            <!-- SEARCH -->
            <form action="/admin/reservasi" method="GET" class="mb-6">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama tamu, nomor kamar, tanggal, atau status..."
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
                            href="/admin/reservasi"
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
                                Jumlah Tamu
                            </th>

                            <th class="px-4 py-4 text-left">
                                Check-in
                            </th>

                            <th class="px-4 py-4 text-left">
                                Check-out
                            </th>

                            <th class="px-4 py-4 text-left">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($reservasis as $reservasi)

                            <tr class="border-b hover:bg-[#F4EFE6]">

                                <td class="px-4 py-4">
                                    {{ $reservasis->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-[#17324D]">
                                    {{ $reservasi->tamu->nama }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $reservasi->kamar->nomor_kamar }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $reservasi->jumlah_tamu }} orang
                                </td>

                                <td class="px-4 py-4">
                                    {{ $reservasi->check_in }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $reservasi->check_out }}
                                </td>

                                <td class="px-4 py-4">

                                    @if($reservasi->status === 'menunggu')

                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                            Menunggu
                                        </span>

                                    @elseif($reservasi->status === 'disetujui')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Disetujui
                                        </span>

                                    @elseif($reservasi->status === 'ditolak')

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Ditolak
                                        </span>

                                    @elseif($reservasi->status === 'check-in')

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                            Check-in
                                        </span>

                                    @elseif($reservasi->status === 'check-out')

                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            Check-out
                                        </span>

                                    @else

                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            {{ ucfirst($reservasi->status) }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-4 py-8 text-center text-gray-500">

                                    Data reservasi tidak ditemukan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->
            <div class="mt-6">

                {{ $reservasis->links() }}

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

</body>

</html>