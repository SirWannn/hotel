<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu - Manajer</title>

    <script src="https://cdn.tailwindcss.com"></script>
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
                    Data Tamu - Manajer
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
            👤 Data Tamu
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-[#17324D] text-white">

                        <th class="border border-[#17324D] p-3">
                            No
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Nama
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Nomor Identitas
                        </th>

                        <th class="border border-[#17324D] p-3">
                            No. Telepon
                        </th>

                        <th class="border border-[#17324D] p-3">
                            Alamat
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($tamus as $tamu)

                        <tr class="hover:bg-[#F4EFE6]
                                   transition-all duration-200">

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $tamu->nama }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $tamu->nomor_identitas }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $tamu->no_telepon }}
                            </td>

                            <td class="border border-[#17324D] p-3 text-[#17324D]">
                                {{ $tamu->alamat }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="border border-[#17324D]
                                       p-5 text-center
                                       text-[#17324D]">
                                Belum ada data tamu.
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