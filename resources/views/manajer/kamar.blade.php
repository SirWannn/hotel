<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar - Manajer</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4EFE6] min-h-screen">

<nav class="bg-[#17324D] text-white px-8 py-4">

    <div class="max-w-6xl mx-auto">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm">
                    Data Kamar - Manajer
                </p>
            </div>

            <form action="/logout" method="POST">
                @csrf

                <button
                    type="submit"
                    class="bg-white text-[#17324D]
                           hover:bg-[#F4EFE6]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200
                           px-4 py-2 rounded-lg">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>

<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="bg-white rounded-2xl shadow-lg p-6
                transition-all duration-200
                hover:shadow-xl">

        <h2 class="text-2xl font-bold text-[#17324D] mb-5">
            🏨 Data Kamar
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-[#17324D] text-white">

                        <th class="border border-[#17324D] p-3">
                            No
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Nomor Kamar
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Tipe Kamar
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Harga
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Fasilitas
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($kamars as $kamar)

                        <tr class="hover:bg-[#F4EFE6]
                                   transition-all duration-200">

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $kamar->nomor_kamar }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $kamar->tipe_kamar }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $kamar->fasilitas }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $kamar->status }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="border border-[#17324D]
                                       p-5 text-center
                                       text-[#17324D]">
                                Belum ada data kamar.
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