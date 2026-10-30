<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ketersediaan Kamar - Hotel AMBATUKAM</title>

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
                    Cek Ketersediaan Kamar - Tamu
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

<main class="max-w-6xl mx-auto px-6 py-8">

    <h2 class="text-3xl font-bold text-[#17324D] mb-2">
        🔍 Cek Ketersediaan Kamar
    </h2>

    <p class="text-[#17324D] mb-6">
        Berikut kamar yang saat ini tersedia.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @forelse ($kamars as $kamar)

            <div class="bg-white rounded-2xl shadow p-6
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-xl
                        active:scale-95">

                <h3 class="text-xl font-bold text-[#17324D]">
                    Kamar {{ $kamar->nomor_kamar }}
                </h3>

                <p class="text-[#17324D] mt-2">
                    Tipe: {{ $kamar->tipe_kamar }}
                </p>

                <p class="text-[#17324D] font-bold mt-3">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </p>

                <p class="text-[#17324D] mt-2">
                    {{ $kamar->fasilitas ?? 'Fasilitas belum tersedia' }}
                </p>

                <div class="mt-4">

                    <span class="bg-[#F4EFE6] text-[#17324D]
                                 px-3 py-1 rounded-full text-sm font-bold">
                        Tersedia
                    </span>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow p-6
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-xl">

                <p class="text-[#17324D]">
                    Tidak ada kamar yang tersedia.
                </p>

            </div>

        @endforelse

    </div>

</main>

</body>
</html>