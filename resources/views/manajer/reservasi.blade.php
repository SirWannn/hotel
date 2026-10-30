<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi - Manajer</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4EFE6] min-h-screen">

<nav class="bg-[#17324D] text-white p-4">

    <div class="max-w-6xl mx-auto">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm">
                    Data Reservasi - Manajer
                </p>
            </div>

            <form action="/logout" method="POST">
                @csrf

                <button
                    type="submit"
                    class="bg-white text-[#17324D] px-4 py-2 rounded-lg
                           hover:bg-[#F4EFE6]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>

<div class="max-w-6xl mx-auto p-6">

    <div class="bg-white rounded-xl shadow-lg p-6
                hover:shadow-xl transition-all duration-200">

        <h2 class="text-2xl font-bold text-[#17324D] mb-5">
            📅 Data Reservasi
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>
                    <tr class="bg-[#17324D] text-white">

                        <th class="border border-[#17324D] p-3">
                            No
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Nama Tamu
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Kamar
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Check-in
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Check-out
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($reservasis as $reservasi)

                        <tr class="hover:bg-[#F4EFE6]
                                   hover:shadow-sm
                                   transition-all duration-200">

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $reservasi->tamu->nama }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $reservasi->kamar->nomor_kamar }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $reservasi->check_in }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $reservasi->check_out }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D] font-medium">
                                {{ $reservasi->status }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="border border-[#17324D] p-5 text-center text-[#17324D]">
                                Belum ada data reservasi.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-8">

        <a href="/manajer"
           class="inline-block bg-[#17324D] text-white
                  hover:bg-white hover:text-[#17324D]
                  hover:-translate-y-0.5
                  active:scale-95
                  transition-all duration-200
                  px-5 py-3 rounded-lg">
            ← Kembali
        </a>

      </div>

    </div>

</div>

</body>
</html>