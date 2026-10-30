<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Manajer</title>

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
                    Laporan - Manajer
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

<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-[#17324D]">
            Laporan Hotel AMBATUKAM
        </h1>

        <p class="text-[#17324D] mt-2">
            Ringkasan data hotel
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Jumlah Kamar -->
        <div
            class="bg-white p-6 rounded-xl shadow-lg
                   hover:-translate-y-1 hover:shadow-xl
                   active:scale-95
                   transition-all duration-200">

            <h2 class="text-lg font-bold text-[#17324D]">
                🏨 Jumlah Kamar
            </h2>

            <p class="text-4xl font-bold text-[#17324D] mt-3">
                {{ $jumlahKamar }}
            </p>

            <p class="text-[#17324D] mt-2">
                Total kamar hotel
            </p>

        </div>

        <!-- Jumlah Tamu -->
        <div
            class="bg-white p-6 rounded-xl shadow-lg
                   hover:-translate-y-1 hover:shadow-xl
                   active:scale-95
                   transition-all duration-200">

            <h2 class="text-lg font-bold text-[#17324D]">
                👤 Jumlah Tamu
            </h2>

            <p class="text-4xl font-bold text-[#17324D] mt-3">
                {{ $jumlahTamu }}
            </p>

            <p class="text-[#17324D] mt-2">
                Total tamu hotel
            </p>

        </div>

        <!-- Jumlah Reservasi -->
        <div
            class="bg-white p-6 rounded-xl shadow-lg
                   hover:-translate-y-1 hover:shadow-xl
                   active:scale-95
                   transition-all duration-200">

            <h2 class="text-lg font-bold text-[#17324D]">
                📅 Jumlah Reservasi
            </h2>

            <p class="text-4xl font-bold text-[#17324D] mt-3">
                {{ $jumlahReservasi }}
            </p>

            <p class="text-[#17324D] mt-2">
                Total reservasi hotel
            </p>

        </div>

        <!-- Jumlah Check-in -->
<div
    class="bg-white p-6 rounded-xl shadow-lg
           hover:-translate-y-1 hover:shadow-xl
           active:scale-95
           transition-all duration-200">

    <h2 class="text-lg font-bold text-[#17324D]">
        🛎️ Jumlah Check-in
    </h2>

    <p class="text-4xl font-bold text-[#17324D] mt-3">
        {{ $jumlahCheckin }}
    </p>

    <p class="text-[#17324D] mt-2">
        Total tamu check-in
    </p>

</div>


<!-- Jumlah Check-out -->
<div
    class="bg-white p-6 rounded-xl shadow-lg
           hover:-translate-y-1 hover:shadow-xl
           active:scale-95
           transition-all duration-200">

    <h2 class="text-lg font-bold text-[#17324D]">
        🏁 Jumlah Check-out
    </h2>

    <p class="text-4xl font-bold text-[#17324D] mt-3">
        {{ $jumlahCheckout }}
    </p>

    <p class="text-[#17324D] mt-2">
        Total tamu check-out
    </p>

</div>

        <!-- Jumlah Laporan -->
        <div
            class="bg-white p-6 rounded-xl shadow-lg
                   hover:-translate-y-1 hover:shadow-xl
                   active:scale-95
                   transition-all duration-200">

            <h2 class="text-lg font-bold text-[#17324D]">
                📊 Jumlah Laporan
            </h2>

            <p class="text-4xl font-bold text-[#17324D] mt-3">
                {{ $jumlahLaporan }}
            </p>

            <p class="text-[#17324D] mt-2">
                Total laporan hotel
            </p>

        </div>

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

</body>
</html>