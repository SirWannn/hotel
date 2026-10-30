<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Tamu - Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#F4EFE6]">

    <!-- NAVBAR -->
    <nav class="bg-[#17324D] text-white px-8 py-5 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                HOTEL AMBATUKAM
            </h1>

            <p class="text-sm text-gray-300">
                Admin / Data Tamu
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
                    👤 Data Tamu
                </h2>

                <p class="text-gray-500 mt-1">
                    Data tamu yang terdaftar di Hotel AMBATUKAM
                </p>

            </div>


            <!-- SEARCH -->
            <form action="/admin/tamu" method="GET" class="mb-6">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama, nomor identitas, no. telepon, atau alamat..."
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
                            href="/admin/tamu"
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
                                Nomor Identitas
                            </th>

                            <th class="px-4 py-4 text-left">
                                No. Telepon
                            </th>

                            <th class="px-4 py-4 text-left">
                                Alamat
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($tamus as $tamu)

                            <tr class="border-b hover:bg-[#F4EFE6]">

                                <td class="px-4 py-4">
                                    {{ $tamus->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-[#17324D]">
                                    {{ $tamu->nama }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $tamu->nomor_identitas }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $tamu->no_telepon }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $tamu->alamat }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-4 py-8 text-center text-gray-500">

                                    Data tamu tidak ditemukan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->
            <div class="mt-6">

                {{ $tamus->links() }}

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