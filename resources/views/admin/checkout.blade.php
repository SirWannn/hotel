<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Check-out - Hotel AMBATUKAM</title>

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
                Admin / Data Check-out
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
                    🚪 Data Check-out
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola tamu yang sedang melakukan check-out
                </p>

            </div>


            <!-- SEARCH -->
            <form action="/admin/checkout" method="GET" class="mb-6">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama tamu, nomor kamar, atau tanggal..."
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
                            href="/admin/checkout"
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

                            <th class="px-4 py-4 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($reservasis as $reservasi)

                            <tr class="border-b hover:bg-[#F4EFE6]">

                                <!-- NO -->
                                <td class="px-4 py-4">
                                    {{ $reservasis->firstItem() + $loop->index }}
                                </td>


                                <!-- NAMA TAMU -->
                                <td class="px-4 py-4 font-semibold text-[#17324D]">
                                    {{ $reservasi->tamu->nama }}
                                </td>


                                <!-- KAMAR -->
                                <td class="px-4 py-4">

                                    <div class="font-semibold text-[#17324D]">
                                        Kamar {{ $reservasi->kamar->nomor_kamar }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $reservasi->kamar->tipe_kamar }}
                                    </div>

                                </td>


                                <!-- JUMLAH TAMU -->
                                <td class="px-4 py-4">
                                    {{ $reservasi->jumlah_tamu }} orang
                                </td>


                                <!-- CHECK IN -->
                                <td class="px-4 py-4">
                                    {{ $reservasi->check_in }}
                                </td>


                                <!-- CHECK OUT -->
                                <td class="px-4 py-4">
                                    {{ $reservasi->check_out }}
                                </td>


                                <!-- STATUS -->
                                <td class="px-4 py-4">

                                    <span
                                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        Check-in
                                    </span>

                                </td>


                                <!-- AKSI -->
                                <td class="px-4 py-4">

                                    <form
                                        action="/admin/checkout/{{ $reservasi->id }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin tamu ini sudah check-out?');">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-[#17324D] text-white px-4 py-2 rounded-lg text-sm
                                                   hover:bg-white
                                                   hover:text-[#17324D]
                                                   hover:-translate-y-0.5
                                                   active:scale-95
                                                   transition-all duration-200
                                                   border border-[#17324D]">
                                            Check-out
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="px-4 py-8 text-center text-gray-500">

                                    Tidak ada tamu yang sedang check-in.

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